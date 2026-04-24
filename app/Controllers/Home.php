<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\FamilyModel;
use App\Models\FamilyMemberModel;
use App\Models\GroupMemberModel;
use App\Models\GroupPostModel;
use App\Models\CertificateRequestModel;

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
                    'user_phone'      => $phone,
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

        // Fetch families with only the needed fields: name, head, photo
        $families = $familyModel
            ->select('family_name, head_of_family, photo')
            ->findAll();

        // Total families count
        $totalFamilies = $familyModel->countAll();

        // Members
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();

        // Birthdays today
        $today = date('m-d');
        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();

        // Total donations (admin view)
        $donationModel = new \App\Models\DonationModel();
        $totalDonations = $donationModel
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;

        // Groups
        $groupModel = new \App\Models\GroupModel();
        $groupsList = $groupModel
            ->select('groups.*, COUNT(group_members.member_id) as member_count')
            ->join('group_members', 'group_members.group_id = groups.group_id', 'left')
            ->groupBy('groups.group_id')
            ->findAll();

        // Announcements
        $announcementModel = new \App\Models\AnnouncementModel();
        $announcements = $announcementModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // This month's birthdays
        $currentMonth = date('m');
        $thisMonthBirthdays = $memberModel
            ->select('family_members.*, families.family_name')
            ->join('families', 'families.family_id = family_members.family_id', 'left')
            ->where("MONTH(date_of_birth)", $currentMonth)
            ->orderBy("DAY(date_of_birth)", "ASC")
            ->findAll();
        // $userEmail = session()->get('user_email'); // get logged-in user's email

        // $userFamilies = $familyModel
        //     ->select('family_id, family_name, head_of_family, photo')
        //     ->where('family_email', $userEmail)
        //     ->first();;

        $userPhone = session()->get('user_phone');
        $userFamilies = null;
        if (!empty($userPhone)) {
            $userFamilies = $familyModel
                ->select('family_id, family_name, head_of_family, photo')
                ->where('contact_number', $userPhone)
                ->first();
        }

        return view('dashboard', [
            'totalFamilies'      => $totalFamilies,
            'totalMembers'       => $totalMembers,
            'families'           => $families,          // now includes name, head, photo
            'hasBirthdayToday'   => $birthdayCount > 0,
            'birthdayCount'      => $birthdayCount,
            'totalDonations'     => $totalDonations,
            'groupsList'         => $groupsList,
            'announcements'      => $announcements,
            'thisMonthBirthdays' => $thisMonthBirthdays,
            'userFamilies'       => $userFamilies,
        ]);
    }

    public function terms()
    {

        return view('terms');
    }
    public function privacy()
    {

        return view('privacy');
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
        $userEmail = session()->get('user_email'); //
        $userPhone = session()->get('user_phone');
        $userFamilies = null;
        if (!empty($userPhone)) {
            $userFamilies = $familyModel
                ->select('family_id, family_name, head_of_family, photo')
                ->where('contact_number', $userPhone)
                ->first();
        }

        $data = [
            'totalFamilies' => $familyModel->countAll(),
            'totalMembers'  => $memberModel->countAllResults(),
            'families'      => $families,
            'request'       => $this->request, // needed for keeping search value in input

            'userFamilies'       => $userFamilies,
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
        $userEmail = session()->get('user_email'); // get logged-in user's email
        $userPhone = session()->get('user_phone');
        $userFamilies = null;
        if (!empty($userPhone)) {
            $userFamilies = $familyModel
                ->select('family_id, family_name, head_of_family, photo')
                ->where('contact_number', $userPhone)
                ->first();
        }
        return view('group', [
            'totalFamilies'    => $totalFamilies,
            'totalMembers'     => $totalMembers,
            'families'         => $families,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount,
            'totalDonations'   => $totalDonations,
            'groupsList'       => $groupsList,
            'userFamilies'       => $userFamilies,
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
    // public function saveDonation()
    // {
    //     $donationModel = new \App\Models\DonationModel();

    //     $data = [
    //         'family_id'     => $this->request->getPost('family_id'),
    //         'purpose_id'    => $this->request->getPost('purpose_id'),
    //         'amount'        => $this->request->getPost('amount'),
    //         'donation_date' => $this->request->getPost('donation_date'),
    //         'notes'         => $this->request->getPost('notes'),
    //     ];

    //     $donationModel->insert($data);

    //     return redirect()->back()->with('success', 'Donation Saved Successfully');
    // }


    public function history()
    {
        return view('history');
    }
    public function certificate()
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
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        $certificateModel = new CertificateRequestModel();

        $certificates = $certificateModel
            ->select('certificate_requests.*, families.family_name')
            ->join('families', 'families.family_id = certificate_requests.family_id')
            ->where('families.family_email', $user['email'])
            ->findAll();
        $userEmail = session()->get('user_email'); //
        $userPhone = session()->get('user_phone');
        $userFamilies = null;
        if (!empty($userPhone)) {
            $userFamilies = $familyModel
                ->select('family_id, family_name, head_of_family, photo')
                ->where('contact_number', $userPhone)
                ->first();
        }
        return view('certificate', [
            'totalFamilies'    => $totalFamilies,
            'certificates' => $certificates,
            'userFamilies'       => $userFamilies
        ]);
    }
    public function requestCertificate()
    {
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }

        $userEmail = session()->get('user_email'); // logged-in user's email
        $familyModel = new \App\Models\FamilyModel();

        // Get only families belonging to logged-in user
        $families = $familyModel->where('family_email', $userEmail)->findAll();

        $totalFamilies = $familyModel->countAll();
        $memberModel = new \App\Models\FamilyMemberModel();
        $totalMembers = $memberModel->countAllResults();
        $purposeModel = new \App\Models\DonationPurposeModel();
        $purposes = $purposeModel->where('is_active', 1)->findAll();

        return view('certificates_request_form', [
            'totalFamilies' => $totalFamilies,
            'totalMembers' => $totalMembers,
            'families' => $families,
            'purposes' => $purposes
        ]);
    }

    public function saveCertificate()
    {
        // Ensure user is logged in
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }

        $certificateModel = new \App\Models\CertificateRequestModel();

        $data = [
            'family_id'        => $this->request->getPost('family_id'),
            'certificate_type' => $this->request->getPost('certificate_type'),
            'details'          => $this->request->getPost('details'),
            'status'           => 'Pending',
            'created_at'       => date('Y-m-d H:i:s'),
        ];

        // Insert into database
        $certificateModel->insert($data);

        // Redirect back to certificate list with success message
        return redirect()->to(base_url('certificate'))
            ->with('success', 'Certificate request submitted successfully!');
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
    public function editFamily()
    {
        // Check if user is logged in
        if (!session()->get('isuserLoggedIn')) {
            return redirect()->to(base_url('/userlogin'));
        }

        // Get logged-in user's phone number from session
        $userPhone = session()->get('user_phone');

        $familyModel = new \App\Models\FamilyModel();

        // Get the family by phone number
        $family = $familyModel->where('contact_number', $userPhone)->first();

        if (!$family) {
            return redirect()->back()->with('error', 'Family not found.');
        }

        // Get family members (assuming FamilyMemberModel has family_id foreign key)
        $memberModel = new \App\Models\FamilyMemberModel();
        $members = $memberModel->where('family_id', $family['family_id'])->findAll();

        // Pass data to the view
        return view('edit_family', [
            'family' => $family,
            'members' => $members
        ]);
    }

    public function updateFamily($id)
    {
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        $userModel = new \App\Models\UserModel();

        $data = $this->request->getPost();

        // Use placeholder email if empty
        $email = !empty($data['family_email']) ? $data['family_email'] : 'user_' . $id . '@placeholder.local';
        $contact = $data['contact_number'];

        // Check if contact number exists for another user
        $existingUser = $userModel
            ->where('phone', $contact)
            ->where('username !=', $familyModel->find($id)['family_code'])
            ->first();

        if ($existingUser) {
            session()->setFlashdata('error', 'User already exists with this contact number.');
            return redirect()->back()->withInput();
        }

        $familyData = [
            'family_name'     => $data['family_name'],
            'head_of_family'  => $data['head_of_family'],
            'members_count'   => $data['members_count'],
            'address'         => $data['address'],
            'ward'            => $data['ward'],
            'contact_number'  => $contact,
            'family_email'    => $email,
            'password'        => $data['password'], // consider hashing
            'registered_on'   => $data['registered_on']
        ];

        // Handle photo upload
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/family', $newName);
            $familyData['photo'] = $newName;
        }

        // Update family
        try {
            $familyModel->update($id, $familyData);
            $family = $familyModel->find($id);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false || strpos($e->getMessage(), "Column 'family_email' cannot be null") !== false) {
                session()->setFlashdata('error', 'Email is invalid or already in use.');
                return redirect()->back()->withInput();
            } else {
                throw $e;
            }
        }

        // Update or insert user account
        if ($family) {
            $userUpdateData = [
                'email'      => $email,
                'phone'      => $contact,
                'password'   => $data['password'], // consider hashing
                'updated_at' => date('Y-m-d H:i:s')
            ];

            try {
                $existingUser = $userModel->where('username', $family['family_code'])->first();
                if ($existingUser) {
                    $userModel->where('username', $family['family_code'])->set($userUpdateData)->update();
                } else {
                    $userModel->insert([
                        'username'   => $family['family_code'],
                        'email'      => $email,
                        'phone'      => $contact,
                        'password'   => $data['password'], // consider hashing
                        'role_id'    => 4,
                        'is_active'  => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    log_message('error', 'Duplicate user email skipped: ' . $email);
                } else {
                    throw $e;
                }
            }
        }

        // Update family members
        $memberModel->where('family_id', $id)->delete();
        if (!empty($data['members']) && is_array($data['members'])) {
            foreach ($data['members'] as $member) {
                $member['family_id'] = $id;
                $memberModel->insert($member);
            }
        }

        session()->setFlashdata('success', 'Family details updated successfully.');
        return redirect()->to('/edit-family');
    }


    public function saveDonation()
    {
        $data = [
            'family_id'     => $this->request->getPost('family_id'),
            'purpose_id'    => $this->request->getPost('purpose_id'),
            'amount'        => $this->request->getPost('amount'),
            'donation_date' => $this->request->getPost('donation_date'),
            'notes'         => $this->request->getPost('notes'),
        ];

        // Validate
        if ($data['amount'] <= 0) {
            return redirect()->back()->with('error', 'Invalid amount');
        }

        // Store temporarily
        session()->set('donation_form', $data);

        // Redirect to payment
        return redirect()->to(base_url('donation/pay'));
    }

    public function payDonation()
    {
        $formData = session()->get('donation_form');
        $order_id = uniqid('ORD_');

        // store form data using order_id
        $paymentModel = new \App\Models\PaymentTempModel();

        $paymentModel->insert([
            'order_id' => $order_id,
            'data' => json_encode($formData)
        ]);
        if (!$formData) {
            return redirect()->to('/');
        }

        $familyModel = new \App\Models\FamilyModel();
        $family = $familyModel->find($formData['family_id']);

        if (!$family) {
            return redirect()->to('/')->with('error', 'Family not found');
        }

        $api_key = "fb6bca86-b429-4abf-a42f-824bdd29022e";
        $salt    = "80c67bfdf027da08de88ab5ba903fecafaab8f6d";

       
        // ✅ FORMAT VALUES PROPERLY
        $amount   = number_format($formData['amount'], 2, '.', '');
        $currency = "INR";

        $city     = "Kozhikode";
        $state    = "Kerala";
        $country  = "India";
        $zip_code = "673580";

        // ✅ FAMILY DATA (trim to avoid hash mismatch)
        $name  = trim($family['head_of_family']);
        $email = trim($family['family_email'] ?? '');
        $phone = trim($family['contact_number'] ?? '');

        // fallback (optional)
        if (empty($email)) $email = "test@email.com";
        if (empty($phone)) $phone = "9999999999";

        $description = "Donation - " . $family['family_name'];

        $return_url = base_url('payment/success');

        /**
         * ⚠️ SPLIT INFO
         * If vendor NOT approved → keep empty string
         */
        $split_info_json = "";

    /*
    // ✅ USE THIS ONLY AFTER VENDOR APPROVED
    $split_info = [
        "vendors" => [
            [
                "vendor_code" => "VD1234561",
                "split_amount_fixed" => "2.00"
            ]
        ]
    ];
    $split_info_json = json_encode($split_info, JSON_UNESCAPED_SLASHES);
    */

        /**
         * ✅ CORRECT HASH STRING (FULL FORMAT)
         */
        $hashString =
            $salt . "|" .
            $amount . "|" .
            $api_key . "|" .
            $city . "|" .
            $country . "|" .
            $currency . "|" .
            $description . "|" .
            $email . "|" .
            $name . "|" .
            $order_id . "|" .
            $phone . "|" .
            $return_url . "|" .
            $zip_code;
        // 🔐 FINAL HASH
        $hash = strtoupper(hash('sha512', $hashString));

        /**
         * ✅ REQUEST DATA (MUST MATCH HASH)
         */
        $data = [
            'action' => "https://pgbiz.Omniware.in/v2/paymentrequest",

            'api_key' => $api_key,
            'order_id' => $order_id,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'return_url' => $return_url,

            'city' => $city,
            'state' => $state,
            'country' => $country,
            'zip_code' => $zip_code,

            'split_info' => $split_info_json,

            'hash' => $hash,
        ];

        // ✅ DEBUG (VERY IMPORTANT)
        log_message('error', 'HASH STRING: ' . $hashString);
        log_message('error', 'HASH: ' . $hash);

        return view('payment_form', $data);
    }

    public function pay()
    {
        $api_key = "fb6bca86-b429-4abf-a42f-824bdd29022e";
        $salt    = "80c67bfdf027da08de88ab5ba903fecafaab8f6d";
        // $api_key = "YOUR_API_KEY";
        // $salt    = "YOUR_SALT";

        $order_id = uniqid('ORD_');
        $amount = "100.00";
        $currency = "INR";

        $description = "Test Product";
        $name = "Rohith Test";
        $email = "rsn7rohith@gmail.com";
        $phone = "9999999999";

        $return_url = "http://localhost/churchapp/payment/success";

        $city = "Alleppey";
        $country = "India";
        $state = "Kerala";
        $zip_code = "685608";

        $payment_options = "cc,nb,upi,dp";

        /**
         * ✅ SPLIT INFO (DO NOT escape manually)
         */
        $split_info = [
            "vendors" => [
                [
                    "vendor_code" => "VD1234561",
                    "split_amount_fixed" => "2"
                ]
            ]
        ];

        $split_info_json = json_encode($split_info, JSON_UNESCAPED_SLASHES);

        /**
         * ❗ IMPORTANT:
         * For PAYMENT REQUEST API, keep ONLY fields required by gateway spec.
         * (Do NOT include amount/city/name unless docs explicitly say so)
         *
         * If your gateway REALLY uses full-payment hash, use exact order they provide.
         */
        $hashString =
            $salt . "|" .
            $amount . "|" .
            $api_key . "|" .
            $city . "|" .
            $country . "|" .
            $currency . "|" .
            $description . "|" .
            $email . "|" .
            $name . "|" .
            $order_id . "|" .
            $phone . "|" .
            $return_url . "|" .
            $split_info_json . "|" .
            $zip_code;

        /**
         * ✅ FINAL HASH
         */
        $hash = hash('sha512', $hashString);

        /**
         * REQUEST DATA
         */
        $data = [
            'action' => "https://pgbiz.Omniware.in/v2/paymentrequest",

            'api_key' => $api_key,
            'order_id' => $order_id,
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'return_url' => $return_url,

            'city' => $city,
            'state' => $state,
            'country' => $country,
            'zip_code' => $zip_code,

            'split_info' => $split_info_json,
            'payment_options' => $payment_options,

            'hash' => strtoupper($hash),
        ];
        return view('payment_form', $data);
    }


    public function success()
    {
        $response = $this->request->getPost();
        print_r($response);
        //exit;
        // 🔍 LOG FULL RESPONSE (VERY IMPORTANT)
        log_message('error', 'PAYMENT RESPONSE: ' . json_encode($response));

        // ✅ Try all possible keys
        $order_id =
            $response['order_id'] ??
            $response['orderId'] ??
            $response['orderid'] ??
            $response['txnid'] ??   // ⚠️ VERY COMMON
            null;
        $order_id = $response['order_id'] ?? null;

        log_message('error', 'ORDER_ID RECEIVED: ' . $order_id);
        if (!$order_id) {
            return "Order ID not received from gateway";
        }

        $paymentModel = new \App\Models\PaymentTempModel();

        $payment = $paymentModel
            ->where('order_id', $order_id)
            ->first();

        if (!$payment) {
            return "Payment data not found for Order ID: " . $order_id;
        }

        $formData = json_decode($payment['data'], true);

        $donationModel = new \App\Models\DonationModel();

        $status = $response['response_message'] ;

        $donationModel->insert([
            'family_id'     => $formData['family_id'],
            'purpose_id'    => $formData['purpose_id'],
            'amount'        => number_format($formData['amount'], 2, '.', ''),
            'donation_date' => $formData['donation_date'],
            'notes'         => $formData['notes'] ?? null,
            'status'        => $status,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        // 🧹 cleanup
        $paymentModel->where('order_id', $order_id)->delete();

       // print_r($response);
    }
    // public function success()
    // {
    //     $post = $this->request->getPost();

    //     echo "<h2>SUCCESS</h2><pre>";
    //     print_r($post);

    //     // 🔐 You MUST verify hash here (next step)
    // }

    public function failure()
    {
        $post = $this->request->getPost();

        echo "<h2>FAILED</h2><pre>";
        print_r($post);
    }
}
