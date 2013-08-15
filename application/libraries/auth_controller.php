<?php
class Auth_Controller extends CI_Controller {

    function auth($method) {
        $allowedPages = array('student_controller:index', 'student_controller:login'); 
        $parametrs = $this->uri->segment_array(); 
        $page = $parametrs[1] . ':' . $method;  
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        
        if (($check_auth == true) || in_array($page, $allowedPages))
        {
            call_user_func_array(array($this, $method));
        }
        else
        {
             $this->login();
        }
    }

    function login()
    {
        $this->load->database();
        
        $data = array(
            'content_view' => 'login_view',
            'check_auth' => false,
        );
        
        $data['data'] = array(
            'message' => '',
            'class_type' => '',
            'check_auth' => false,
        );
        

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        $config = array(
               array(
                    'field'   => 'login',
                    'label'   => 'Login',
                    'rules'   => 'trim|required'
                  ),
            
               array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'trim|required'
               ),
            );

        $this->form_validation->set_rules($config); 

        if($this->form_validation->run())
        {
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $this->db->select('id, login, password');
            $this->db->from('users');
            $this->db->where('login', $login);
            $this->db->where('password', $password);
            $userdata = $this->db->get()->row_array();

            if (@$userdata['login'] == $login and @$userdata['password'] == $password) 
            {
                $authdata = array(
                    'id' => @$userdata['id'],
                    'logged_in' => true
                );

                $this->session->set_userdata($authdata);
                $this->load->helper('url');
                if($this->uri->uri_string == "login_controller/login")
                    redirect (site_url());
                else redirect($this->uri->uri_string);
            }
            $data['data'] = array(
            'message' => 'Логин\Пароль не подходят',
            'class_type' => 'error',
            );
        } elseif(isset($_POST['login']) && isset($_POST['password'])) {
           $data['data'] = array(
            'message' =>  validation_errors(),
            'class_type' => 'validation',
            );
        }      

       $this->load->view('template', $data);
    }
    
    function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
    }
}
