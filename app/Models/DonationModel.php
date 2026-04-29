<?php

namespace App\Models;

use CodeIgniter\Model;

class DonationModel extends Model
{
    protected $table = 'donations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'family_id',
        'purpose_id',
        'amount',
        'donation_date',
        'notes',
        'status',
        'payment_response'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function getDonationsWithPurpose($familyId = null)
    {
        $builder = $this->select('donations.*, donation_purposes.title as purpose_title')
            ->join('donation_purposes', 'donations.purpose_id = donation_purposes.id');

        if ($familyId) {
            $builder->where('family_id', $familyId);
        }

        return $builder->findAll();
    }
    // public function getReminderReport($month = null, $year = null)
    // {
    //     $month = $month ?? date('m');
    //     $year  = $year ?? date('Y');

    //     $db = \Config\Database::connect();

    //     return $db->query("
    //     SELECT 
    //         f.family_id,
    //         f.family_name,
    //         f.head_of_family,

    //         -- expected (avg of last 3 donations)
    //         (
    //             SELECT AVG(d2.amount)
    //             FROM donations d2
    //             WHERE d2.family_id = f.family_id
    //             ORDER BY d2.donation_date DESC
    //             LIMIT 3
    //         ) AS expected_amount,

    //         IFNULL(SUM(d.amount), 0) AS paid_amount,

    //         (
    //             (
    //                 SELECT AVG(d2.amount)
    //                 FROM donations d2
    //                 WHERE d2.family_id = f.family_id
    //                 ORDER BY d2.donation_date DESC
    //                 LIMIT 3
    //             ) - IFNULL(SUM(d.amount), 0)
    //         ) AS pending_amount,

    //         -- STATUS 👇
    //         CASE
    //             WHEN IFNULL(SUM(d.amount), 0) = 0 THEN 'Pending'
    //             WHEN IFNULL(SUM(d.amount), 0) < (
    //                 SELECT AVG(d2.amount)
    //                 FROM donations d2
    //                 WHERE d2.family_id = f.family_id
    //                 ORDER BY d2.donation_date DESC
    //                 LIMIT 3
    //             ) THEN 'Partial'
    //             ELSE 'Paid'
    //         END AS status

    //     FROM families f

    //     LEFT JOIN donations d 
    //         ON d.family_id = f.family_id
    //         AND MONTH(d.donation_date) = ?
    //         AND YEAR(d.donation_date) = ?

    //     GROUP BY f.family_id
    // ", [$month, $year])->getResultArray();
    // }
    public function getReminderReport($month = null, $year = null)
    {
        $month = $month ?? date('m');
        $year  = $year ?? date('Y');

        $db = \Config\Database::connect();

        return $db->query("
        SELECT 
            f.family_id,
            f.family_name,
            f.head_of_family,

            IFNULL(fd.expected_amount, 0) AS expected_amount,

            IFNULL(SUM(d.amount), 0) AS paid_amount,

            (IFNULL(fd.expected_amount, 0) - IFNULL(SUM(d.amount), 0)) AS pending_amount,

            CASE
                WHEN IFNULL(SUM(d.amount), 0) = 0 THEN 'Pending'
                WHEN IFNULL(SUM(d.amount), 0) < IFNULL(fd.expected_amount, 0) THEN 'Partial'
                ELSE 'Paid'
            END AS status

        FROM families f

        -- 👇 First donation (fixed expected amount)
        LEFT JOIN (
            SELECT d1.family_id, d1.amount AS expected_amount
            FROM donations d1
            WHERE d1.donation_date = (
                SELECT MIN(d2.donation_date)
                FROM donations d2
                WHERE d2.family_id = d1.family_id
            )
        ) fd ON fd.family_id = f.family_id

        -- 👇 Current month payments
        LEFT JOIN donations d 
            ON d.family_id = f.family_id
            AND MONTH(d.donation_date) = ?
            AND YEAR(d.donation_date) = ?

        GROUP BY f.family_id
    ", [$month, $year])->getResultArray();
    }
}
