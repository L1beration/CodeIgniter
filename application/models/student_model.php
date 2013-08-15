<?php
class Student_Model extends CI_Model
{
    function showStudents($num, $offset)
    {
        $this->db->select('students.id, student_name, class_name');
        $this->db->join('classes', 'students.class_id = classes.id');
        
        return $this->db->get('students',$num, $offset)->result_array();
    }     

    function createStudent($student_name, $class_id)
    {
        $data = array(
            'student_name' => $student_name ,
            'class_id' => $class_id ,
        );

        return $this->db->insert('students', $data);
    }

    function updateStudent($id, $student_new_name, $class_id)
    {
        $data = array(
           'student_name' => $student_new_name,
           'class_id' => $class_id,
        );
        $this->db->where('id', $id);
        return $this->db->update('students', $this->db->escape($data)); 

    }

    function deleteStudent($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('students'); 
    }
    
    function findStudentInfo($id)
    {
        $this->db->select('student_name, class_id');
        $this->db->where('id', $id);
        return $this->db->get('students')->result_array();
    }
}