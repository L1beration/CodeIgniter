<?php
class Student_Controller extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        $this->load->model('Student_Model', '', true);
        $data['students'] = $this->Student_Model->showStudents();
        $data['check_auth'] = $check_auth;
        $data['content_view'] = 'read_view';
        $data['message'] = '';
        $data['class_type'] = '';
        $this->load->view('template', $data);
    }
    
    function create()
    {
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        $data['check_auth'] = $check_auth;
        if ($check_auth) {  
            $this->load->model('Student_Model', '', true);
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config = array(
                   array(
                         'field'   => 'student_name',
                         'label'   => 'Имя студента',
                         'rules'   => 'trim|required'
                      ),
                );
            
            $this->form_validation->set_message('required', 'Поле %s должно быть заполнено');
            $this->form_validation->set_rules($config); 

            if ($this->form_validation->run() == false) {
                if(!isset($_POST['student_name']) && !isset($_POST['class_id'])) {
                $data['data'] = array(
                    'message' => '',
                    'class_type'=>'',  
                );
                } 
                else {
               
                $data['data'] = array(
                    'message' => validation_errors(),
                    'class_type'=>'validation',
                    
                );
                }
                $data['content_view'] = 'create_view';
                $this->load->view('template', $data);
            }
            else {
                $status = $this->Student_Model->createStudent($_POST['student_name'], $_POST['class_id']);
                if($status == true)
                {
                    $data['students'] = $this->Student_Model->showStudents();
                    $data['data'] = array(
                        'class_type'=>'success',
                        'check_auth' => $check_auth,
                        'message'=> 'Информация о пользователе была добавлена',
                    );
                    $data['content_view'] = 'read_view';
                    $this->load->view('template', $data);
                }
                else {
                    $data['data'] = array(
                        'class_type'=>'error',
                        'message'=> 'Информация о пользователе не была добавлена',
                    );
                    $data['content_view'] = 'create_view';
                    $this->load->view('template', $data);
                }              
            }
        }
        else {
            $this->load->library('auth_controller');
            $this->auth_controller->auth('create');
        }
    }
    
    function update($id = -1)
    {
        $status = false;
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        $data['check_auth'] = $check_auth;
        if ($check_auth) {  
            $this->load->model('Student_Model', '', true);     
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config = array(
                   array(
                         'field'   => 'student_new_name',
                         'label'   => 'Имя студента',
                         'rules'   => 'trim|required',
                      ),
                );

            $this->form_validation->set_message('required', 'Поле %s должно быть заполнено');
            $this->form_validation->set_rules($config); 


            if ($this->form_validation->run() == false or $id == -1) {
                if(!isset($_POST['student_new_name']) && !isset($_POST['class_id'])) {
                $data = array(
                    'id' => $id,
                    'message' => '',
                    'class_type'=>'',
                    'check_auth' => $check_auth,
                    'student_name' => $_POST['student_old_name'],
                    'class_id' => $_POST['old_class_id'],          
                );
                } 
                else {
                $data = array(
                    'id' => $id,
                    'check_auth' => $check_auth,
                    'student_name' => $_POST['student_old_name'],
                    'class_id' => $_POST['old_class_id'],    
                    'class_type'=>'validation',
                    'message'=> validation_errors(),
                );
                }
            $response_view = $this->load->view('update_view', $data, true);
            $response = array(
                'status'=>$status,
                'response_view'=> $response_view,
            );
            echo json_encode($response);
            

            }
            else {
                $status = $this->Student_Model->updateStudent($id, $_POST['student_new_name'], $_POST['class_id']);
                if($status == true)
                {
                    $data = array(
                        'id' => $id,
                        'class_type'=>'success',
                        'check_auth' => $check_auth,
                        'message'=> 'Информация о пользователе была обновлена',
                    );
            $data['students'] = $this->Student_Model->showStudents();
            $response_view = $this->load->view('read_view', $data, true);
            $response = array(
                'status'=>$status,
                'response_view'=> $response_view,
            );
            echo json_encode($response);
                }
                else {
                    $data = array(
                        'id' => $id,
                        'class_type'=>'error',
                        'massage'=> 'Информация о пользователе не была обновлена',
                    );
                    $response_view = $this->load->view('update_view', $data, true);
                    $response = array(
                'status'=>$status,
                'response_view'=> $response_view,
            );
            echo json_encode($response);
                }              
            }
        }
        else  {
        
            $this->load->library('auth_controller');
            $this->auth_controller->auth('update');
        }     
    }
    
    function delete($id = -1)
    {
        $status = false;
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        $data['check_auth'] = $check_auth;
        $this->load->model('Student_Model', '', true);
        if ($check_auth) { 
            if($id > -1) {
                $status = $this->Student_Model->deleteStudent($id);
            }

            $data = array(
                'students' => $this->Student_Model->showStudents(),
                'class_type' => 'success',
                'content_view' =>'read_view',
                'check_auth' => $check_auth,
                'message' => 'Информация о пользователе была удалена',
            );
            $response_view = $this->load->view('read_view', $data, true);
            $response = array(
                'status'=>$status,
                'response_view'=> $response_view,
            );
            echo json_encode($response);
        }
        else {
            $this->load->library('auth_controller');
            $this->auth_controller->auth('delete');
        }
}
}
