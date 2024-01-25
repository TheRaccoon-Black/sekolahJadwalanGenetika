<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Akun extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('AkunModel');
            $this->load->library('session');
        }
        function index(){
            $this->load->view('Akun/Admin/v_register');
        }
        public function login(){
            $this->load->view('Akun/Admin/v_login');
        }
    
        public function register() {
            $fullname = $this->input->post('fullName');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            $this->AkunModel->register($fullname, $email, $password);

            redirect('akun/login');
        }
        public function validate() {
            $email = $this->input->post('email');
            $password =md5($this->input->post('password'));
        
            $user = $this->AkunModel->get_user_data($email, $password);
        
            if ($user) {
                $user_data = array(
                    'userId' => $user->userId,
                    // 'username' => $user->username,
                    'fullName' => $user->fullName,
                    'email' => $user->email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);
        
                redirect('tes'); 
            } else {
                redirect('akun/login'); 
            }
        }
        
    
        public function logout() {
            $this->session->sess_destroy();
            redirect('akun/login');
        }
    }
    