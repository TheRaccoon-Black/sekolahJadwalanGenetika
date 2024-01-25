<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkunModel extends CI_Model {

    public function register($fullname, $email, $password) {
        $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password,

        );

        $this->db->insert('User', $data);
    }

    public function updateNullData($userData) {
        $userId = $userData['userId'];
        $first = $userData['first'];
        $last = $userData['last'];
        $placeOfBirth = $userData['placeOfBirth'];
        $birth = $userData['birth'];
        $phone = $userData['phone'];

        $data = array(
            'firsName' => $first,
            'lastName' => $last,
            'tanggalLahir' => $birth,
            'tempatLahir' => $placeOfBirth,
            'telepon' => $phone
        );

        $this->db->where("userId", $userId);
        $this->db->update("User", $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getTeacher(){
        $this->db->select('*');
        $this->db->where('userid',$this->session->userdata('userId'));
        $query = $this->db->get('User');
    
        if ($query->num_rows() > 0) {
            return $query->row();  
        } else {
            return false;  
        }
    }
    public function get_user_data($email, $password) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('User');
    
        if ($query->num_rows() > 0) {
            return $query->row();  
        } else {
            return false;  
        }
    }
    
    public function getAll($email,$password){

    }
}
