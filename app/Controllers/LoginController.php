<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\DeliveryModel;
use App\Models\StaffModel;
use App\Models\HubModel;
use App\Models\MenuModel;
use App\Models\DonationPurposeModel;
use App\Models\DonationModel;

class LoginController extends Controller
{
    protected $db;
    protected $menuModel;
    // Constructor to load the database service
    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Connecting to the database
        $this->menuModel = new MenuModel();
    }
    protected function getMenus()
    {
        // Get menus based on the current session's role ID
        $role_id = session()->get('role_id');
        return $this->menuModel->getMenus($role_id);
    }
    public function index()
    {
        return view('login');
    }
    public function whatsappLogin()
    {
        return view('wlogin');
    }
    public function login()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'POST') {
            $phone = $this->request->getVar('phone');
            $password = $this->request->getVar('password');
            $userModel = new UserModel();
            $user  = $userModel->getUserByphone($phone);
            // echo $userModel->getLastQuery();
            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';

            if ($user && ($password == $user['password'])) {
                session()->set([
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'role_id'    => $user['role_id'],
                    'hub'    => $user['hub'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('error', 'Invalid username or password.');
                return redirect()->to(base_url('/login'));
            }
        } else {
            session()->setFlashdata('error', 'Invalid attempt.');
            return redirect()->to(base_url('/login'));
        }
    }


    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $menuModel = new MenuModel();
        $menus = $this->getMenus();
        $all_menus = $menuModel->getAllMenus();
        $menus = $this->getMenus();
        $loggedInEmail = session()->get('email'); // assuming you store email in session
        $totalDonations = 0;
        $familyModel = new \App\Models\FamilyModel();
        $memberModel = new \App\Models\FamilyMemberModel();
        $family = $familyModel->where('family_email', $loggedInEmail)->first();
        if (!$family) {            // Optional: Handle if the email is not linked to any family
            $members = '';
            $donationModel = new \App\Models\DonationModel();            // Total donations for all users (admin view)
            $totalDonations = $donationModel
                ->selectSum('amount')
                ->get()
                ->getRow()
                ->amount ?? 0;
        } else {
            session()->set([
                'family_id'    => $family['family_id'],
                'family_code'  => $family['family_code'],
                'family_name'  => $family['family_name'],
            ]);

            $memberModel = new \App\Models\FamilyMemberModel();
            $members = $memberModel->where('family_id', $family['family_id'])->findAll();
            $donationModel = new \App\Models\DonationModel();
            $totalDonations = $donationModel
                ->where('family_id', $family['family_id'])
                ->selectSum('amount')
                ->get()
                ->getRow()
                ->amount ?? 0;
        }

        $today = date('m-d');

        $birthdayCount = $memberModel
            ->where("DATE_FORMAT(date_of_birth, '%m-%d')", $today)
            ->countAllResults();


        return view('admin_layout', [
            'menus' => $menus,
            'family' => $family,
            'members' => $members,
            'totalDonations' => $totalDonations,
            'hasBirthdayToday' => $birthdayCount > 0,
            'birthdayCount'    => $birthdayCount
        ]);
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }

    public function sendWotp()
    {
        $phone = $this->request->getPost('phone');
        $phone = preg_replace('/\D/', '', $phone); // digits only

        $otp = rand(100000, 999999); // generate 6-digit OTP

        // Save OTP in session
        session()->set([
            'login_otp'    => $otp,
            'login_phone'  => $phone,
            'login_expire' => time() + 300 // 5 min
        ]);

        // WHAPI TOKEN (from channel)
        $token = 'p0U29KaI5m7ePTvGMwHcdEVNASUlbdpy';

        $data = [
            "to"   => $phone,
            "body" => "Your login OTP is: $otp"
        ];

        $ch = curl_init("https://gate.whapi.cloud/messages/text?token={$token}");
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Redirect to same page with ?otp=1 to show OTP input
        return redirect()->to('/wlogin?otp=1');
    }

    // Verify OTP
    public function verifyWotp()
    {
        $otp = $this->request->getPost('otp');

        // Check OTP and expiration
        if (
            session()->get('login_otp') == $otp &&
            session()->get('login_expire') >= time()
        ) {
            $phone = session()->get('login_phone');

            // Optional: Get full user info from DB
            $userModel = new \App\Models\UserModel();
            $user = $userModel->getUserByPhone($phone);

            if ($user) {
                // Login successful → create session
                session()->set([
                    'isLoggedIn' => true,
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'user_phone' => $user['phone'],
                    'role_id'    => $user['role_id'],
                    'hub'        => $user['hub']
                ]);

                // Remove OTP from session (clean up)
                session()->remove(['login_otp', 'login_expire', 'login_phone']);

                return redirect()->to('/dashboard'); // Redirect after login
            }
        }

        // Invalid OTP
        session()->setFlashdata('error', 'Invalid or expired OTP.');
        return redirect()->to('/login?otp=1');
    }



    public function sendOtp()
    {
        $phone = $this->request->getPost('phone'); // example: 919876543210
        $otp   = rand(100000, 999999);

        // Save OTP in session
        session()->set([
            'wa_otp' => $otp,
            'wa_phone' => $phone,
            'wa_expire' => time() + 300 // 5 minutes
        ]);

        $token = 'p0U29KaI5m7ePTvGMwHcdEVNASUlbdpy';

        $payload = [
            "to"   => $phone,
            "body" => "Your OTP for login into church app is: $otp"
        ];

        $ch = curl_init("https://gate.whapi.cloud/messages/text");
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'OTP sent on WhatsApp',
            'message' => $payload,

            'whapi_response' => json_decode($response, true)
        ]);
    }

    public function verifyOtp()
    {
        $otp = $this->request->getPost('otp');

        if (
            session()->get('wa_otp') == $otp &&
            session()->get('wa_expire') >= time()
        ) {
            session()->remove(['wa_otp', 'wa_phone', 'wa_expire']);

            return $this->response->setJSON([
                'status' => 'verified',
                'message' => 'OTP verified successfully'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'failed',
            'message' => 'Invalid or expired OTP'
        ]);
    }
}
