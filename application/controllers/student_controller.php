<?php
class Student_Controller extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        $config['total_rows'] = $this->db->count_all('students');
        $this->pagination->initialize($config);
        $this->load->model('Student_Model', '', true);
        $data['students'] = $this->Student_Model->showStudents($this->pagination->per_page, $this->uri->segment(3));
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
        $status = false;
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
                if($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $data = array(
                        'message' => '',
                        'class_type'=>'',  
                    );
                } 
                else {              
                    $data = array(
                        'message' => validation_errors(),
                        'class_type'=>'validation',
                    );
                }
                
                $response_view = $this->load->view('create_view', $data, true);
                $response = array(
                    'status'=>$status,
                    'response_view'=> $response_view,
                );
                echo json_encode($response);
            }
            else {
                $status = $this->Student_Model->createStudent($_POST['student_name'], $_POST['class_id']);
                if($status == true) {
                    $config['total_rows'] = $this->db->count_all('students');
                    $this->pagination->initialize($config);
                    $data = array(
                        'class_type'=>'success',
                        'check_auth' => $check_auth,
                        'message'=> 'Информация о пользователе была добавлена',
                    );
                    $data['students'] = $this->Student_Model->showStudents($this->pagination->per_page, $this->uri->segment(3));
 
                    $response_view = $this->load->view('read_view', $data, true);
                    $response = array(
                        'status' => $status,
                        'response_view' => $response_view,
                    );
                    echo json_encode($response);
                }
                else {
                    $data = array(
                        'class_type'=>'error',
                        'message'=> 'Информация о пользователе не была добавлена',
                    );
                    $response_view = $this->load->view('create_view', $data, true);
                                $response = array(
                    'status'=>$status,
                    'response_view'=> $response_view,
                    );
                    echo json_encode($response);
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


            if ($this->form_validation->run() == false) {
                if($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $studentInfo = $this->Student_Model->findStudentInfo($id);
                    $data = array(
                        'id' => $id,
                        'message' => '',
                        'class_type'=>'',
                        'check_auth' => $check_auth,
                        'student_name' => $studentInfo[0]['student_name'],
                        'class_id' => $studentInfo[0]['class_id'],          
                    );
                } 
                else {
                    $studentInfo = $this->Student_Model->findStudentInfo($id);
                    $data = array(
                        'id' => $id,
                        'check_auth' => $check_auth,
                        'student_name' => $studentInfo[0]['student_name'],
                        'class_id' => $studentInfo[0]['class_id'],  
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
                $status = $this->Student_Model->updateStudent($id, $_POST['student_new_name'], $_POST['new_class_id']);
                if($status == true) {
                    $data = array(
                        'id' => $id,
                        'class_type'=>'success',
                        'check_auth' => $check_auth,
                        'message'=> 'Информация о пользователе была обновлена',
                        'uri' => $_POST['last_segment'],
                    );
                    $config['total_rows'] = $this->db->count_all('students');
                    $this->pagination->initialize($config);
                    $numb =  $this->uri->segment(3);
                    $data['students'] = $this->Student_Model->showStudents($this->pagination->per_page, $_POST['last_segment']);
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
            $config['total_rows'] = $this->db->count_all('students');
            $this->pagination->initialize($config);
            $this->load->model('Student_Model', '', true);
            
            $segment = $_POST['last_segment'];
            if($this->db->count_all('students')% $this->pagination->per_page == 0) $segment -= $this->pagination->per_page;
            $data = array(
                'students' => $this->Student_Model->showStudents($this->pagination->per_page, $segment),
                'class_type' => 'success',
                'content_view' =>'read_view',
                'check_auth' => $check_auth,
                'message' => 'Информация о пользователе была удалена',
                'uri' => $_POST['last_segment'],
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
