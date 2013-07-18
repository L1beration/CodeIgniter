<?php
class Login_Controller extends CI_Controller
{
    function logout()
    {
        $this->load->library('auth_controller');
        $this->auth_controller->logout();
        $this->load->helper('url');
        redirect(site_url());
    }
    
    function login()
    {
        $this->load->library('session');
        $this->load->library('auth_controller');
        $this->auth_controller->login();      
    }
}