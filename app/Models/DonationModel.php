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
        'notes'
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
}
