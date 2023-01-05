<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {

    public function __construct()
    {
		parent::__construct();
		$this->load->database();
        $this->load->helper('url');
		$this->load->library('session');
    }

    public function getUserByEmail($email)
    {
        if($email != null) {
            $query = $this->db->query("call getUserByEmail('$email')");
            if( $query->num_rows() > 0 ) {
                $row = $query->row();
                return $row;
            } else return "empty";
        } else return "fail";
    }

    public function insertUserDetails($firstName,$lastName,$email,$phone,$password,$age)
    {
        if($firstName != null) {
            $role = 3;
            $query = $this->db->query("call insertUserDetails('$firstName','$lastName','$email','$phone','$password','$age','$role')");
            if( $query->num_rows() > 0 ) {
                $row = $query->row();
                return $row;
            } else return "empty";
        } else return "fail";
    }

    public function getUserByEmailAndPassword($email,$password)
    {
        if($password != null) {
            $query = $this->db->query("call getUserByEmailAndPassword('$email','$password')");
            if( $query->num_rows() > 0 ) {
                $row = $query->row();
                return $row;
            } else return "empty";
        } else return "fail";
    }

    public function getUserByRole($role)
    {
        if($role != null) {
            $query = $this->db->query("call getUserByRole('$role')");
            if( $query->num_rows() > 0 ) {
                $row = $query->result();
                return $row;
            } else return "empty";
        } else return "fail";
    }

    public function updateUserById($rowId,$firstName,$lastName,$email,$phone,$age)
    {
        if($rowId != null) {
            if( $this->db->query("call updateUserById('$rowId','$firstName','$lastName','$email','$phone','$age')") ) {
                return "success";
            } else return "empty";
        } else return "fail";
    }

}
