<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use App\Models\UserModel;
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

    public function userLogin()
    {

        return view('userlogin');
    }
    public function logincheck()
    {
        // helper(['form']);
        if ($this->request->getMethod() == 'POST') {
            $phone = $this->request->getVar('phone');
            $password = $this->request->getVar('password');
            $userModel = new UserModel();
            $user  = $userModel->getUserByphone($phone);
            if ($user && ($password == $user['password'])) {
                session()->set([
                    'user_id'         => $user['id'],
                    'user_name'   => $user['username'],
                    'user_email'      => $user['email'],
                    'role_id'    => $user['role_id'],
                    'hub'    => $user['hub'],
                    'isuserLoggedIn' => true
                ]);
                return redirect()->to(base_url('/sitedashboard'));
            } else {
                session()->setFlashdata('error', 'Invalid username or password.');
                return redirect()->to(base_url('/userlogin'));
            }
        } else {
            session()->setFlashdata('error', 'Invalid attempt.');
            return redirect()->to(base_url('/userlogin'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/userlogin'));
    }
    public function dashboard()
    {
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }
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
        $memberModel = new \App\Models\FamilyMemberModel();

        // Get search input
        $phone = $this->request->getGet('phone');

        if ($phone) {
            // Filter families by phone number
            $families = $familyModel->like('contact_number', $phone)->findAll();
        } else {
            $families = $familyModel->findAll();
        }

        $data = [
            'totalFamilies' => $familyModel->countAll(),
            'totalMembers'  => $memberModel->countAllResults(),
            'families'      => $families,
            'request'       => $this->request, // needed for keeping search value in input
        ];

        return view('directory', $data);
    }


    public function group()
    {
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }
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
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }
        $familyModel = new \App\Models\FamilyModel();
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        $purposeModel = new \App\Models\DonationPurposeModel();
        $purposes = $purposeModel->where('is_active', 1)->findAll();
        return view('donate', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'purposes' => $purposes
        ]);
    }
    public function saveDonation()
    {
        $donationModel = new \App\Models\DonationModel();

        $data = [
            'family_id'     => $this->request->getPost('family_id'),
            'purpose_id'    => $this->request->getPost('purpose_id'),
            'amount'        => $this->request->getPost('amount'),
            'donation_date' => $this->request->getPost('donation_date'),
            'notes'         => $this->request->getPost('notes'),
        ];

        $donationModel->insert($data);

        return redirect()->back()->with('success', 'Donation Saved Successfully');
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
