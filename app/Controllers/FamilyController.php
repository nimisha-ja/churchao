<?php

namespace App\Controllers;

use App\Models\FamilyModel;
use App\Models\FamilyMemberModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use TCPDF;
use App\Models\MenuModel;
use App\Models\MenuRoleModel;
use App\Controllers\CustomPDF;
use App\Models\CertificateRequestModel;
use App\Models\AnnouncementModel;
use App\Models\DonationPurposeModel;
use App\Models\DonationModel;
use CodeIgniter\Email\Email;
use App\Models\GroupModel;
use App\Models\GroupMemberModel;
use App\Models\GroupPostModel;

class FamilyController extends Controller
{

    protected $db;
    protected $menuModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->menuModel = new MenuModel();
    }
    protected function getMenus()
    {
        $role_id = session()->get('role_id');
        return $this->menuModel->getMenus($role_id);
    }
    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $familyModel = new FamilyModel();
        $families = $familyModel->findAll();
        $menus = $this->getMenus();
        return view('family/create', ['menus' => $menus]);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('families');
        $query = $builder->selectMax('family_id')->get();
        $row = $query->getRow();
        $nextId = $row ? ((int) $row->family_id + 1) : 1;
        $family_code = 'FAM-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        $familyModel = new FamilyModel();
        $familyMemberModel = new FamilyMemberModel();
        $data = [
            'family_code'    => $family_code,
            'family_name'    => $this->request->getPost('family_name'),
            'head_of_family' => $this->request->getPost('head_of_family'),
            'members_count'  => $this->request->getPost('members_count'),
            'address'        => $this->request->getPost('address'),
            'contact_number' => $this->request->getPost('contact_number'),
            'family_email' => $this->request->getPost('family_email'),
            'password' => $this->request->getPost('password'),
            'registered_on'  => $this->request->getPost('registered_on'),
        ];
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/family', $newName);
            $data['photo'] = $newName;
        } else {
            return redirect()->back()->with('error', 'Please upload a family photo.');
        }
        $familyModel->insert($data);
        $familyId = $familyModel->insertID();
        $userdata = [
            'username'    => $family_code,
            'email'       => $this->request->getPost('family_email'),
            'password'    => $this->request->getPost('password'),
            'phone' => $this->request->getPost('contact_number'),
            'role_id'     => 4,
            'is_active'   => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];
        $userModel = new UserModel();
        if ($userModel->insert($userdata)) {
        } else {
            $errors = $userModel->errors();
            print_r($errors);
        }
        $members = $this->request->getPost('members');
        if ($members && is_array($members)) {
            foreach ($members as $member) {
                $memberData = [
                    'family_id'       => $familyId,
                    'full_name'       => $member['full_name'],
                    'relation_to_head' => $member['relation_to_head'],
                    'date_of_birth'   => $member['date_of_birth'],
                    'gender'          => $member['gender'],
                    'job'             => $member['job'],
                    'education'       => $member['education'],
                    'current_status'  => $member['current_status']
                ];
                $familyMemberModel->insert($memberData);
            }
        }

        return redirect()->to('/families');
    }

    // public function index()
    // {
    //     if (!session()->get('isLoggedIn')) {
    //         return redirect()->to(base_url('/login'));
    //     }
    //     $familyModel = new FamilyModel();
    //     $families = $familyModel->paginate(10);
    //     $pager = $familyModel->pager;
    //     $menus = $this->getMenus();
    //     return view('family/index', ['families' => $families, 'menus' => $menus, 'pager'    => $pager,]);
    // }
    public function index()
    {
        $familyModel = new FamilyModel();
        $phone = $this->request->getGet('phone');

        if (!empty($phone)) {
            $familyModel->like('contact_number', $phone);
        }
        $menus = $this->getMenus();
        $data['families'] = $familyModel->paginate(10);
        $data['pager'] = $familyModel->pager;
        $data['request'] = $this->request;
        $data['menus'] = $menus;
        return view('family/index', $data);
    }

    public function details($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $familyModel = new FamilyModel();
        $familyMemberModel = new FamilyMemberModel();

        $family = $familyModel->find($id);
        $members = $familyMemberModel->where('family_id', $id)->findAll();

        return view('family/details', ['family' => $family, 'members' => $members]);
    }

    public function delete($id = null)
    {
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->back()->with('error', 'Invalid request method.');
        }
        $family = $familyModel->find($id);
        if (!$family) {
            return redirect()->to('/families')->with('error', 'Family not found.');
        }
        $memberModel->where('family_id', $id)->delete();
        $familyModel->delete($id);
        $userModel = new UserModel();
        $userModel->where('email', $family['family_email'])->delete();
        return redirect()->to('/families')->with('success', 'Family and its members deleted successfully.');
    }

    public function edit($id)
    {
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        $family = $familyModel->find($id);
        if (!$family) {
            return redirect()->to('/family')->with('error', 'Family not found.');
        }

        $members = $memberModel->where('family_id', $id)->findAll();
        $menus = $this->getMenus();
        return view('family/edit', [
            'family' => $family,
            'members' => $members,
            'menus' => $menus
        ]);
    }

    public function update($id)
    {
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        $data = $this->request->getPost();
        $familyData = [
            'family_name'     => $data['family_name'],
            'head_of_family'  => $data['head_of_family'],
            'members_count'   => $data['members_count'],
            'address'        => $data['address'],
            'contact_number'  => $data['contact_number'],
            'family_email' => $this->request->getPost('family_email'),
            'password' => $this->request->getPost('password'),
            'registered_on'   => $data['registered_on']
        ];
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/family', $newName);
            $familyData['photo'] = $newName;
        }
        $familyModel->update($id, $familyData);
        $family = $familyModel->find($id);;
        $userModel = new UserModel();
        $newEmail = $this->request->getPost('family_email');
        $phone = $this->request->getPost('contact_number');
        $userUpdateData = [
            'email' => $data['email'] ?? $family['family_email'],   // update email
            'phone' => $data['contact_number'] ?? $family['contact_number'] // update phone
        ];
        $updated = $userModel->where('username', $family['family_code'])
            ->set($userUpdateData)
            ->update();
        $memberModel->where('family_id', $id)->delete();
        if (!empty($data['members'])) {
            foreach ($data['members'] as $member) {
                $member['family_id'] = $id;
                $memberModel->insert($member);
            }
        }
        return redirect()->to('/families')->with('success', 'Family details updated successfully.');
    }


    public function requestCertificate()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $menus = $this->getMenus();
        return view('family/request_certificate', [
            'menus' => $menus
        ]);
    }

    public function saveCertificate()
    {
        $model = new CertificateRequestModel();

        $model->save([
            'family_id'        => session()->get('family_id'),
            'certificate_type' => $this->request->getPost('certificate_type'),
            'details'          => $this->request->getPost('details'),
            'status'           => 'Pending',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Certificate request submitted successfully.');
    }

    public function certificateList()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $db = \Config\Database::connect();    // Build the join query
        $builder = $db->table('certificate_requests as cr');
        $builder->select('
        cr.id as certificate_id,
        cr.certificate_type,
        cr.details as certificate_details,
        cr.status,
        cr.created_at,
        cr.updated_at,
        f.family_id,
        f.family_code,
        f.family_name,
        f.head_of_family,
        f.members_count,
        f.address,
        f.contact_number,
        f.family_email,
        f.registered_on,
        f.photo
    ');
        $builder->join('families as f', 'cr.family_id = f.family_id');
        $builder->orderBy('cr.created_at', 'DESC');    // Execute and get results
        $query = $builder->get();
        $certificates = $query->getResultArray();
        $menus = $this->getMenus();
        return view('family/certificates', ['certificates' => $certificates, 'menus' => $menus]);
    }
    public function approveCertificate($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        $certificateModel = new \App\Models\CertificateRequestModel();
        $certificate = $certificateModel->find($id);

        if (!$certificate) {
            return redirect()->back()->with('error', 'Certificate request not found.');
        }
        $menus = $this->getMenus();
        return view('family/approve_certificate', ['certificate' => $certificate, 'menus' => $menus]);
    }
    public function certificateAction($id)
    {
        $certificateModel = new \App\Models\CertificateRequestModel();
        $certificate = $certificateModel->find($id);
        if ($this->request->getMethod() == 'POST') {
            $status = $this->request->getPost('status');
            if ($status === 'Approved') {
                $file = $this->request->getFile('certificate_file');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/certificates', $newName);
                    $data['status'] = $status;
                    $data['certificate_file'] = $newName;
                } else {
                    return redirect()->back()->with('error', 'Please upload a valid certificate file.');
                }
            } else {
                $data['status'] = $status;;
            }
            $certificateModel->update($id, $data);
            return redirect()->to('/family/requests')->with('success', 'Certificate updated.');
        } else {
            return redirect()->back()->with('error', 'Invalid request.');
        }
    }
    public function myCertificates()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $familyId = session()->get('family_id');
        $db = \Config\Database::connect();
        $builder = $db->table('certificate_requests');
        $builder->select('certificate_requests.*, families.family_code');
        $builder->join('families', 'certificate_requests.family_id = families.family_id');

        if ($familyId) {
            $builder->where('certificate_requests.family_id', $familyId);
        }

        $builder->orderBy('certificate_requests.created_at', 'DESC');

        // ✅ Pagination setup
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        $offset = ($page - 1) * $perPage;

        // ✅ Get total count for pagination
        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults(false); // false = do not reset

        // ✅ Fetch paginated results
        $certificates = $builder->limit($perPage, $offset)->get()->getResultArray();

        // ✅ Set up pager
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total, 'default_full'); // 'default_full' uses full bootstrap-style links

        $menus = $this->getMenus();

        return view('family/my_certificates', [
            'certificates' => $certificates,
            'menus' => $menus,
            'pager' => $pager,
        ]);
    }


    public function announcements()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $model = new AnnouncementModel();
        $announcements = $model->orderBy('created_at', 'DESC')->findAll();
        $announcements = $model->orderBy('created_at', 'DESC')->paginate(10);
        $pager = $model->pager;
        $menus = $this->getMenus();
        return view('announcements', ['announcements' => $announcements, 'menus' => $menus, 'pager' => $pager]);
    }

    public function addAnnouncement()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $menus = $this->getMenus();
        return view('add_announcenment', ['menus' => $menus]);
    }


    public function saveAnnouncement()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        if ($this->request->getMethod() === 'POST') {
            $model = new AnnouncementModel();
            $data = [
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ];
            $model->save($data);
            return redirect()->to('/announcements')->with('success', 'Announcement added.');
        }
    }

    public function editAnnouncement($id)
    {
        $model = new AnnouncementModel();
        $announcement = $model->find($id);
        $menus = $this->getMenus();
        if (!$announcement) {
            return redirect()->to('announcements')->with('error', 'Announcement not found.');
        }

        return view('edit_announcement', ['announcement' => $announcement, 'menus' => $menus]);
    }
    public function updateAnnouncement($id)
    {
        $model = new AnnouncementModel();
        $data = [
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ];

        $model->update($id, $data);
        return redirect()->to('/announcements')->with('success', 'Announcement updated.');
    }
    public function deleteAnnouncement($id)
    {
        $model = new AnnouncementModel();
        $model->delete($id);

        return redirect()->to('/announcements')->with('success', 'Announcement deleted.');
    }

    public function donationPurposes()
    {
        $model = new DonationPurposeModel();
        $data['purposes'] = $model->findAll();
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        $menus = $this->getMenus();
        return view('family/donation_purposeslist', $data);
    }

    public function createdonatnPurposes()
    {
        $model = new DonationPurposeModel();
        $data['purposes'] = $model->findAll();
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('family/donation_purposes', $data);
    }

    public function storedonatnPurposes()
    {
        $model = new DonationPurposeModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);
        return redirect()->to('/donationpurposes')->with('success', 'Donation Purpose added');
    }

    public function editdonatnPurposes($id)
    {
        $model = new DonationPurposeModel();
        $data['purpose'] = $model->find($id);
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('family/donation_purposes_edit', $data);
    }

    public function updatedonatnPurposes($id)
    {
        $model = new DonationPurposeModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);
        return redirect()->to('/donationpurposes')->with('success', 'Donation Purpose updated');
    }

    public function deletedonatnPurposes($id)
    {
        $model = new DonationPurposeModel();
        $model->delete($id);
        return redirect()->to('/donationpurposes')->with('success', 'Donation Purpose deleted');
    }
    public function payment()
    {

        $familyModel = new FamilyModel();
        $purposeModel = new DonationPurposeModel();
        $data['families'] = $familyModel->findAll();
        $data['purposes'] = $purposeModel->where('is_active', 1)->findAll();
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('family/paymentform', $data);
    }
    public function createDonation()
    {
        $familyModel = new FamilyModel();
        $purposeModel = new DonationPurposeModel();
        $data['families'] = $familyModel->findAll();
        $data['purposes'] = $purposeModel->where('is_active', 1)->findAll();
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('family/donations_create', $data);
    }
    public function storeDonation()
    {
        $donationModel = new DonationModel();
        $donationModel->save([
            'family_id' => $this->request->getPost('family_id'),
            'purpose_id' => $this->request->getPost('purpose_id'),
            'amount' => $this->request->getPost('amount'),
            'donation_date' => $this->request->getPost('donation_date'),
            'notes' => $this->request->getPost('notes'),
        ]);

        return redirect()->to('/donations')->with('success', 'Donation recorded successfully');
    }
    public function donationList()
    {
        $donationModel = new \App\Models\DonationModel();
        $donationModel->select('donations.*, families.family_name, donation_purposes.title AS purpose_title')
            ->join('families', 'families.family_id = donations.family_id')
            ->join('donation_purposes', 'donation_purposes.id = donations.purpose_id')
            ->orderBy('donation_date', 'DESC');
        $data['donations'] = $donationModel->paginate(10);
        $data['pager'] = $donationModel->pager;
        $data['menus'] = $this->getMenus();
        return view('family/donations_list', $data);
    }

    public function editDonation($id)
    {
        $donationModel = new \App\Models\DonationModel();
        $familyModel = new \App\Models\FamilyModel();
        $purposeModel = new \App\Models\DonationPurposeModel();
        $data['donation'] = $donationModel->find($id);
        $data['families'] = $familyModel->findAll();
        $data['purposes'] = $purposeModel->where('is_active', 1)->findAll();
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('family/donations_edit', $data);
    }

    public function updateDonation($id)
    {
        $donationModel = new \App\Models\DonationModel();
        $donationModel->update($id, [
            'family_id' => $this->request->getPost('family_id'),
            'purpose_id' => $this->request->getPost('purpose_id'),
            'amount' => $this->request->getPost('amount'),
            'donation_date' => $this->request->getPost('donation_date'),
            'notes' => $this->request->getPost('notes'),
        ]);
        return redirect()->to('/donations')->with('success', 'Donation updated successfully');
    }

    public function deleteDonation($id)
    {
        $donationModel = new \App\Models\DonationModel();
        $donationModel->delete($id);

        return redirect()->to('/donations')->with('success', 'Donation deleted');
    }

    public  function paymentProceed()
    {

        echo  'PAYMENT GATEWAY UNDER CONSTRUCTION';
    }



    public function sendEmail()
    {
        $familyModel = new FamilyModel();
        $memberModel = new FamilyMemberModel();
        $emailService = \Config\Services::email();

        $today = date('m-d');

        // Step 1: Find all members whose birthday is today
        $birthdayMembers = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->findAll();

        if (empty($birthdayMembers)) {
            return 'No birthdays today 🎂';
        }

        // Step 2: Group members by family
        $familiesToEmail = [];

        foreach ($birthdayMembers as $member) {
            $familyId = $member['family_id'];
            if (!isset($familiesToEmail[$familyId])) {
                $familiesToEmail[$familyId] = [];
            }
            $familiesToEmail[$familyId][] = $member['full_name'];
        }

        // Step 3: Send email to each family
        foreach ($familiesToEmail as $familyId => $members) {

            $family = $familyModel->find($familyId);

            if (empty($family['contact_number']) && empty($family['email'])) {
                continue; // skip if no email
            }

            $emailService->clear();

            // Personalize message with member names
            $message = view('emails/family_notification.php', [
                'name' => $family['family_name'],
                'appName'    => 'Family App'
            ]);

            $emailService->setTo($family['family_email']); // family email
            $emailService->setSubject('🎉 Happy Birthday!');
            $emailService->setMessage($message);

            $emailService->send();
        }

        return 'Birthday emails sent to families successfully 🎉';
    }

    public function createGroup()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $db = \Config\Database::connect();
        $members = $db->table('family_members fm')
            ->select('fm.*, f.family_name')
            ->join('families f', 'f.family_id = fm.family_id')
            ->get()
            ->getResultArray();
        $data = [
            'menus'   => $this->getMenus(),
            'members' => $members
        ];
        return view('group/create', $data);
    }

    public function groupList()
    {
        $groupModel = new \App\Models\GroupModel();
        $groupMemberModel = new \App\Models\GroupMemberModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        $menus = $this->getMenus();

        // Get paginated groups
        $groups = $groupModel->paginate(10);

        $groupMembers = [];
        $groupPermissions = []; // <-- new: stores if current user is in group
        $memberId = session()->get('member_id'); // logged-in member

        foreach ($groups as $group) {
            // Get members of this group with family name
            $members = $groupMemberModel
                ->select('fm.member_id, fm.full_name, f.family_name')
                ->join('family_members fm', 'fm.member_id = group_members.member_id')
                ->join('families f', 'f.family_id = fm.family_id')
                ->where('group_id', $group['group_id'])
                ->findAll();

            $groupMembers[$group['group_id']] = $members ;

            // Check if logged-in member is part of this group
            $groupPermissions[$group['group_id']] = false;
            foreach ($members as $m) {
                if ($m['member_id'] == $memberId) {
                    $groupPermissions[$group['group_id']] = true;
                    break;
                }
            }
        }

        $data = [
            'menus' => $menus,
            'groups' => $groups,
            'groupMembers' => $groupMembers,
            'groupPermissions' => $groupPermissions, // pass to view
            'pager' => $groupModel->pager,
        ];

        return view('group/list', $data);
    }


    public function storeGroup()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $groupName = $this->request->getPost('group_name');
        $memberIds = $this->request->getPost('member_ids');
        if (!$groupName) {
            return redirect()->back()->with('error', 'Group name is required');
        }
        $db = \Config\Database::connect();
        $db->transStart();
        $groupModel = new GroupModel();
        $groupId = $groupModel->insert([
            'group_name'  => $groupName,
            'description' => $this->request->getPost('description')
        ]);
        if (!empty($memberIds)) {
            $groupMemberModel = new GroupMemberModel();
            $data = [];
            foreach ($memberIds as $memberId) {
                $data[] = [
                    'group_id'  => $groupId,
                    'member_id' => $memberId
                ];
            }
            $groupMemberModel->insertBatch($data);
        }
        $db->transComplete();
        return redirect()->to('/groups')->with('success', 'Group created successfully');
    }
    public function editGroup($group_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        $groupModel = new GroupModel();
        $groupMemberModel = new GroupMemberModel();
        $memberModel = new FamilyMemberModel();

        $group = $groupModel->find($group_id);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found.');
        }

        $currentMembers = $groupMemberModel
            ->where('group_id', $group_id)
            ->findAll();
        $allMembers = $memberModel
            ->select('family_members.member_id, family_members.full_name, families.family_name')
            ->join('families', 'families.family_id = family_members.family_id')
            ->findAll();


        $data = [
            'group' => $group,
            'currentMembers' => array_column($currentMembers, 'member_id'),
            'members' => $allMembers,
            'menus' => $this->getMenus()
        ];

        return view('group/edit', $data);
    }

    public function updateGroup($group_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        $groupModel = new GroupModel();
        $groupMemberModel = new GroupMemberModel();

        $groupData = [
            'group_name' => $this->request->getPost('group_name'),
            'description' => $this->request->getPost('description')
        ];

        $memberIds = $this->request->getPost('member_ids') ?? [];

        $db = \Config\Database::connect();
        $db->transStart();

        $groupModel->update($group_id, $groupData);

        $groupMemberModel->where('group_id', $group_id)->delete();

        foreach ($memberIds as $memberId) {
            $groupMemberModel->insert([
                'group_id' => $group_id,
                'member_id' => $memberId
            ]);
        }

        $db->transComplete();

        if ($db->transStatus()) {
            return redirect()->to(site_url('groups'))->with('success', 'Group updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update group. Please try again.');
        }
    }

    public function deleteGroup($group_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        $groupModel = new GroupModel();
        $groupMemberModel = new GroupMemberModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $groupMemberModel->where('group_id', $group_id)->delete();
        $groupModel->delete($group_id);

        $db->transComplete();

        if ($db->transStatus()) {
            return redirect()->to(site_url('groups'))->with('success', 'Group deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete group. Please try again.');
        }
    }

    public function viewGroup($group_id)
    {
        $groupModel = new GroupModel();
        $postModel = new GroupPostModel();
        $memberModel = new FamilyMemberModel();
        $groupMemberModel = new GroupMemberModel();
        $group = $groupModel->find($group_id);
        $posts = $postModel
            ->select('group_posts.*, family_members.full_name')
            ->join('family_members', 'family_members.member_id = group_posts.member_id')
            ->where('group_id', $group_id)
            ->orderBy('created_on', 'DESC')
            ->findAll();
        // Get members of this group
        $groupMembers = $groupMemberModel
            ->select('fm.member_id, fm.full_name, f.family_name')
            ->join('family_members fm', 'fm.member_id = group_members.member_id')
            ->join('families f', 'f.family_id = fm.family_id')
            ->where('group_id', $group_id)
            ->findAll();
        return view('group/view', [
            'group' => $group,
            'posts' => $posts,
            'groupMembers' => $groupMembers,
            'menus' => $this->getMenus()
        ]);
    }
    public function addPost($group_id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $groupPostModel = new GroupPostModel();

        // Get the posted values
        $member_id = $this->request->getPost('member_id'); // from the <select>
        $content   = $this->request->getPost('content');

        // Validate input
        if (!$member_id || !$content) {
            return redirect()->back()->with('error', 'Please select a member and write some content.');
        }

        // Insert post
        $groupPostModel->insert([
            'group_id'   => $group_id,
            'member_id'  => $member_id,
            'content'    => $content,
            'created_on' => date('Y-m-d H:i:s'),
            'menus' => $this->getMenus()
        ]);

        return redirect()->to(site_url('groups/view/' . $group_id))
            ->with('success', 'Post added successfully!');
    }
}
