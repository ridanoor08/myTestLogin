<?php
/**
 * Created by PhpStorm.
 * User: rida.n
 * Date: 3/28/2019
 * Time: 11:54 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->load->view('loginView');
    }

    public function checkLogin(){

        /*$email = $this->input->post('email');*/
       // var_dump($email);
        /*echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';*/

        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('loginView');
        }
        else{
            $this->verifyUser();
        }
    }

    public function verifyUser(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = array(
            'email'  => $email,
            'password'     => $password
        );
        $this->session->set_userdata($data);
        $this->load->model('LoginModel');
        if($this->LoginModel->login($email, $password)){
            redirect('HomeController/index');
        }
        else{

            $this->session->set_flashdata('error_msg', 'Incorrect Email or Password. Please try again.');
            redirect('LoginController/index');
        }
    }

    public function logout(){
        $this->session->unset_userdata('$val');
        $this->session->sess_destroy();
        redirect('LoginController/index');
    }

}