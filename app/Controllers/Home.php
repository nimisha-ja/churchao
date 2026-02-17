<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use App\Models\GroupModel;

class Home extends BaseController
{
    public function index(): string
    {
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();
        return view('welcome_message', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount
        ]);
    }
    public function dashboard()
    {
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();
        $donationModel = new \App\Models\DonationModel();            // Total donations for all users (admin view)
        $totalDonations = $donationModel
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;
        return view('dashboard', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations' => $totalDonations
        ]);
    }
    public function directory()
    {
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        return view('directory', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
        ]);
    }

    public function group()
    {
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();
        $donationModel = new \App\Models\DonationModel();            // Total donations for all users (admin view)
        $totalDonations = $donationModel
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;
        $groupModel = new GroupModel();        // 1️⃣ Total count of groups
        $totalGroups = $groupModel->countAllResults();        // 2️⃣ List of all groups
        $groupsList = $groupModel->findAll();
        return view('group', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations' => $totalDonations,
            'groupsList' => $groupsList
        ]);
    }
    public function donate()
    {
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        return view('donate', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
        ]);
    }

    public function history()
    {
        return view('history');
    }

    public function test()
    {
        return view('test');
        // return 'This is a test route!';
    }
    public function sendEmail()
    {
        // Get email configuration
        $config = config('Email');

        $email = \Config\Services::email();
        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($config->recipients);
        $email->setSubject('Test Email');
        $email->setMessage('This is a test email sent from CodeIgniter 4!');

        // Try sending the email
        if ($email->send()) {
            echo 'Email sent successfully';
        } else {
            $data = $email->printDebugger(['headers']);
            echo 'Email failed to send. Debugger info: ' . $data;
        }
    }
}
