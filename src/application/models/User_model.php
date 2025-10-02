<?php

class User_model extends CI_Model {
    public function register($enc_password){
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $enc_password
        );

        return $this->db->insert('users', $data);
    }

    public function login($username, $password){
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows()==1){
            $result = $query->row_array();
            if(password_verify($password,$result['password'])){
                return $result['id'];
            }
        }
         return false;
    }
}