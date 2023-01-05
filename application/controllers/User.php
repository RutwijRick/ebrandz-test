<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel'); 
		$this->load->helper('url');
		$this->load->library('cart');
		$this->load->library('session');
		$this->load->database();
		$this->load->helper(array('form', 'url'));
	}

	public function registerUser()
	{
		if($this->input->post('firstName') && $this->input->post('firstName') != "") {
			$firstName = filter_var($this->input->post('firstName'),FILTER_SANITIZE_STRING);
			$lastName = filter_var($this->input->post('lastName'),FILTER_SANITIZE_STRING);
			$email = filter_var($this->input->post('email'),FILTER_SANITIZE_STRING);
			$password = sha1(filter_var($this->input->post('password'),FILTER_SANITIZE_STRING));
			$phone = filter_var($this->input->post('phone'),FILTER_SANITIZE_STRING);
			$age = filter_var($this->input->post('age'),FILTER_SANITIZE_STRING);
			if($firstName != "" && $lastName != "" && $email != "" && $password != "" && $phone != "" && $age != "") {
				// check if email exists
				if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
				$emailDetails = $this->Usermodel->getUserByEmail($email);
				if($emailDetails != "fail") {
					if($emailDetails == "empty") {
						//User does not exist -> insert
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						$insertUserDetails = $this->Usermodel->insertUserDetails($firstName,$lastName,$email,$phone,$password,$age);
						if($insertUserDetails != "fail") {
							if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
							echo json_encode('success');
						} else echo 'Insert Fail';
					} else {
						//User exists -> return
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						echo json_encode("exists");
					}
				} else echo 'Select Fail';
			} else echo 'All Fields Are Mandatory';
		} else echo 'Direct Access Not Allowed';
	}

	public function loginUser()
	{
		if($this->input->post('email') && $this->input->post('email') != "") {
			$email = filter_var($this->input->post('email'),FILTER_SANITIZE_STRING);
			$password = sha1(filter_var($this->input->post('password'),FILTER_SANITIZE_STRING));
			if($email != "" && $password != "") {
				// check if email exists
				if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
				$userDetails = $this->Usermodel->getUserByEmailAndPassword($email,$password);
				if($userDetails != "fail") {
					if($userDetails == "empty") {
						//User does not exist -> invalid
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						echo json_encode('invalid');
					} else {
						// user found
						$sessionData = array(
							"e-authId" => $userDetails->id,
							"e-email" => $userDetails->email,
							"e-username" => $userDetails->firstName.' '.$userDetails->lastName,
							"e-roleId" => $userDetails->role
						);
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						$this->session->set_userdata($sessionData);
						// $_SESSION['e-username'] = $userDetails->firstName.' '.$userDetails->lastName;
						// $_SESSION['e-email'] = $userDetails->email;
						// $_SESSION['e-roleId'] = $userDetails->role;
						echo json_encode('success');
					}
				} else echo 'Select Fail';
			} else echo 'All Fields Are Mandatory';
		} else echo 'Direct Access Not Allowed';
	}

	public function getUserByRole()
	{
		if($this->session->userdata('e-roleId') && $this->session->userdata('e-roleId') == 1) { // check if logged in
			if($this->input->post('role') && $this->input->post('role') != "") { // check if post data exists
				$role = filter_var($this->input->post('role'),FILTER_SANITIZE_STRING);
				if($role != "") {
					// get user data
					if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
					$userDetails = $this->Usermodel->getUserByRole($role);
					if($userDetails != "fail") {
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						echo json_encode($userDetails);
					} else echo 'Select Fail';
				} else echo 'Role Not Defined';
			} else echo 'Direct Access Not Allowed';
		} else {
			echo "Access Denied";
		}
	}

	public function updateUserById()
	{
		if($this->session->userdata('e-roleId') && $this->session->userdata('e-roleId') == 1) { // check if logged in
			if($this->input->post('rowId') && $this->input->post('rowId') != "") { // check if post data exists
				$rowId = filter_var($this->input->post('rowId'),FILTER_SANITIZE_STRING);
				$firstName = filter_var($this->input->post('firstName'),FILTER_SANITIZE_STRING);
				$lastName = filter_var($this->input->post('lastName'),FILTER_SANITIZE_STRING);
				$email = filter_var($this->input->post('email'),FILTER_SANITIZE_STRING);
				$phone = filter_var($this->input->post('phone'),FILTER_SANITIZE_STRING);
				$age = filter_var($this->input->post('age'),FILTER_SANITIZE_STRING);
				if($firstName != "" && $lastName != "" && $email != "" && $phone != "" && $age != "") {
					// get user data
					if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
					$userDetails = $this->Usermodel->updateUserById($rowId,$firstName,$lastName,$email,$phone,$age);
					if($userDetails != "fail") {
						if(mysqli_more_results($this->db->conn_id)) mysqli_next_result($this->db->conn_id);
						echo json_encode($userDetails);
					} else echo 'fail';
				} else echo 'No Data Found';
			} else echo 'Direct Access Not Allowed';
		} else {
			echo "Access Denied";
		}
	}
}
