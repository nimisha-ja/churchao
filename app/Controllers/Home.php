<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\FamilyModel;
use App\Models\FamilyMemberModel;
use App\Models\GroupMemberModel;
use App\Models\GroupPostModel;


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
        $groupModel    = new \App\Models\GroupModel();
        $groupsList = $groupModel
            ->select('groups.*, COUNT(group_members.member_id) as member_count')
            ->join('group_members', 'group_members.group_id = groups.group_id', 'left')
            ->groupBy('groups.group_id')
            ->findAll();
        //dd($groupsList);exit;
        $announcementModel = new \App\Models\AnnouncementModel();

        $announcements = $announcementModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $currentMonth = date('m');

        $thisMonthBirthdays = $memberModel
            ->select('family_members.*, families.family_name')
            ->join('families', 'families.family_id = family_members.family_id', 'left')
            ->where("MONTH(date_of_birth)", $currentMonth)
            ->orderBy("DAY(date_of_birth)", "ASC")
            ->findAll();
        return view('welcome_message', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'groupsList'       => $groupsList,
            'announcements' => $announcements,
            'thisMonthBirthdays' => $thisMonthBirthdays,
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
            ->amount ?? 0;;
        $groupModel    = new \App\Models\GroupModel();
        $groupsList = $groupModel
            ->select('groups.*, COUNT(group_members.member_id) as member_count')
            ->join('group_members', 'group_members.group_id = groups.group_id', 'left')
            ->groupBy('groups.group_id')
            ->findAll();
        return view('dashboard', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations' => $totalDonations,
            'groupsList'       => $groupsList
        ]);
    }
    public function directory()
    {
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();

        // Get search input
        $family_name = $this->request->getGet('family_name');

        if ($family_name) {
            // Filter families by phone number
            $families = $familyModel->like('family_name', $family_name)->findAll();
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

        $familyModel   = new \App\Models\FamilyModel();
        $memberModel   = new \App\Models\FamilyMemberModel();
        $donationModel = new \App\Models\DonationModel();
        $groupModel    = new \App\Models\GroupModel();

        $families = $familyModel->findAll();

        $totalFamilies = $familyModel->countAll();
        $totalMembers  = $memberModel->countAllResults();

        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();

        $totalDonations = $donationModel
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;

        // 🔥 Get groups WITH member count
        $groupsList = $groupModel
            ->select('groups.*, COUNT(group_members.member_id) as member_count')
            ->join('group_members', 'group_members.group_id = groups.group_id', 'left')
            ->groupBy('groups.group_id')
            ->findAll();

        return view('group', [
            'totalFamilies'    => $totalFamilies,
            'totalMembers'     => $totalMembers,
            'families'         => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations'   => $totalDonations,
            'groupsList'       => $groupsList
        ]);
    }

    // public function group()
    // {
    //     if (!session()->get('isuserLoggedIn')) {
    //         return redirect()->to(base_url('/userlogin'));
    //     }
    //     $familyModel = new \App\Models\FamilyModel();
    //     $families = $familyModel->findAll();
    //     $totalFamilies = $familyModel->countAll();
    //     $memberModel = new \App\Models\FamilyMemberModel();
    //     $totalMembers = $memberModel->countAllResults();
    //     $today = date('m-d');
    //     $birthdayCount = $memberModel
    //         ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
    //         ->countAllResults();
    //     $donationModel = new \App\Models\DonationModel();            // Total donations for all users (admin view)
    //     $totalDonations = $donationModel
    //         ->selectSum('amount')
    //         ->get()
    //         ->getRow()
    //         ->amount ?? 0;
    //     $groupModel = new GroupModel();        // 1️⃣ Total count of groups
    //     $totalGroups = $groupModel->countAllResults();        // 2️⃣ List of all groups
    //     $groupsList = $groupModel->findAll();
    //     return view('group', [
    //         'totalFamilies' => $totalFamilies,
    //         'totalMembers' => $totalMembers,
    //         'families' => $families,
    //         'hasBirthdayToday' => $birthdayCount > 0,
    //         'birthdayCount'    => $birthdayCount,
    //         'totalDonations' => $totalDonations,
    //         'groupsList' => $groupsList
    //     ]);
    // }
    public function viewGroup($group_id)
    {
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }

        $familyModel       = new \App\Models\FamilyModel();
        $memberModel       = new \App\Models\FamilyMemberModel();
        $donationModel     = new \App\Models\DonationModel();
        $groupModel        = new \App\Models\GroupModel();
        $groupMemberModel  = new \App\Models\GroupMemberModel();

        // Dashboard counts (keep if needed for layout)
        $families = $familyModel->findAll();
        $totalFamilies = $familyModel->countAll();
        $totalMembers  = $memberModel->countAllResults();

        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();

        $totalDonations = $donationModel
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;

        // ✅ Get selected group
        $group = $groupModel->find($group_id);

        if (!$group) {
            return redirect()->back()->with('error', 'Group not found');
        }

        // ✅ Get members of this group
        $members = $groupMemberModel
            ->select('family_members.member_id,
                  family_members.full_name,
                  family_members.phonenumber,
                  family_members.relation_to_head,
                  family_members.gender')
            ->join('family_members', 'family_members.member_id = group_members.member_id')
            ->where('group_members.group_id', $group_id)
            ->findAll();

        return view('viewgroup', [
            'totalFamilies'    => $totalFamilies,
            'totalMembers'     => $totalMembers,
            'families'         => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations'   => $totalDonations,
            'group'            => $group,
            'members'          => $members
        ]);
    }
    public function creategroup()
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
        return view('creategroup', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations' => $totalDonations,
            'groupsList' => $groupsList
        ]);
    }

    public function addGroup()
    {
        helper(['form']);

        $groupName    = $this->request->getPost('group_name');
        $description  = $this->request->getPost('group_desc');
        $memberPhones = $this->request->getPost('group_members');

        if (empty($groupName)) {
            return redirect()->back()->with('error', 'Group name is required.');
        }

        $groupModel = new \App\Models\GroupModel();
        $groupId = $groupModel->insert([
            'group_name'  => $groupName,
            'description' => $description
        ], true);

        if (!empty($memberPhones)) {
            $phones = array_map('trim', explode(',', $memberPhones));
            $familyModel = new \App\Models\FamilyMemberModel();
            $groupMemberModel = new \App\Models\GroupMemberModel();

            $notFoundNumbers = [];

            foreach ($phones as $phone) {
                $phoneClean = preg_replace('/\D/', '', $phone);
                $member = $familyModel->where('phonenumber', $phoneClean)->first();

                if ($member) {
                    $groupMemberModel->insert([
                        'group_id'  => $groupId,
                        'member_id' => $member['family_id'],
                        'joined_on' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $notFoundNumbers[] = $phone;
                }
            }

            $msg = 'Group created successfully!';
            if (!empty($notFoundNumbers)) {
                $msg .= ' Numbers not added: ' . implode(', ', $notFoundNumbers);
            }

            //  echo $msg;exit;
            return redirect()->back()->with('success', $msg);
        }

        return redirect()->back()->with('success', 'Group created successfully!');
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
