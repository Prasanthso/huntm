<?php 
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class User_profile extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_profile_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function index() {
        $this->load->view('user_profile_login');
    }

    public function login_form() {
        $this->load->view('user_profile_login');
    }

    public function process_login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $email = trim($this->input->post('email', true));
        $password = $this->input->post('password', true);


        $this->load->model('User_profile_model');
        $user = $this->User_profile_model->validate_email($email, $password);

        if ($user) {
            
            $session_data = [
                'user_id' => $user->id,
                'email' => $user->email,
                'full_name' => isset($user->full_name) ? $user->full_name : 'User',
                'role' => $user->role,
                'logged_in' => TRUE
            ];

            $this->session->set_userdata($session_data);
            error_log("Session: " . print_r($session_data, true));

            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    redirect('admin-dashboard');
                    break;
                case 'distributor':
                    redirect('distributor-dashboard');
                    break;
                case 'staff':
                    redirect('dashboard');  // make sure this route exists
                    break;
                default:
                    echo "Unknown role: " . $user->role;
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('user_profile/login_form'); // or your login route
        }

    }

    public function forgot_password_form() 
    {
        $this->load->view('forgot_password');
    }

    public function send_otp() 
    {
        $email = $this->input->post('email');
        $user  = $this->User_profile_model->get_user_by_email($email);

        if (!$user) {
            $this->session->set_flashdata('errors', 'Email not found.');
            redirect('user_profile/forgot_password_form');
        }

        $otp = rand(100000, 999999);
        $this->session->set_tempdata('reset_otp', $otp, 300);
        $this->session->set_userdata('reset_email', $email, 300);

        // Load PHPMailer
        require FCPATH . 'vendor/autoload.php';
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'arasu5070go@gmail.com';    
            $mail->Password   = 'xant stsz yuxn qvgk';           
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('arasu5070go@gmail.com', 'Huntm');
            $mail->addAddress($email); 

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP from HUNTM';
            // $mail->Body    = "Your OTP is: <b>{$otp}</b>";
            $mail->Body = "
                <h2>Password Reset OTP</h2>
                <p>Your OTP for password reset is: <b>{$otp}</b></p>
                <p>This OTP is valid for 5 minutes.Please do not share it with anyone.</p>
                <br>
                <p>Regards,<br>Huntm Team</p>
            ";

            $mail->send();

            $this->session->set_flashdata('success', 'OTP has been sent to your email.');
            redirect('user_profile/verify_otp_form');

        } catch (Exception $e) {
            $this->session->set_flashdata('errors', 'Mail failed: ' . $mail->ErrorInfo);
            redirect('user_profile/forgot_password_form');
        }
    }

    public function verify_otp_form() 
    {        
        $email_sent_to = $this->session->userdata('reset_email');
        $this->load->view('verify_otp', [
            'email_sent_to' => $email_sent_to
        ]);
    }

    public function verify_otp() 
    {
        $entered_otp = $this->input->post('otp');
        $saved_otp   = $this->session->tempdata('reset_otp');

        if ($entered_otp == $saved_otp) {
            redirect('user_profile/reset_password_form');
        } else {
            $this->session->set_flashdata('errors', 'Invalid or expired OTP.');
            redirect('user_profile/verify_otp_form');
        }
    }

    public function reset_password_form()
    {
        $this->load->view('reset_password');
    }

    public function reset_password() 
    {
        $new_pass     = $this->input->post('new_password');
        $confirm_pass = $this->input->post('confirm_password');
        $email        = $this->session->userdata('reset_email');

        if ($new_pass !== $confirm_pass) {
            $this->session->set_flashdata('errors', 'Passwords do not match.');
            redirect('user_profile/reset_password_form');
        }

        $hashed_pass = password_hash($new_pass, PASSWORD_BCRYPT);
        $this->User_profile_model->update_password($email, $hashed_pass);

        $this->session->unset_userdata('reset_email');
        $this->session->unset_tempdata('reset_otp');

        $this->session->set_flashdata('success', 'Password reset successfully. Please log in.');
        redirect('user_profile/login_form');
    }

    public function logout() {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_success', 'You have been logged out successfully.');
        redirect('user_profile/process_login');
    }
}
