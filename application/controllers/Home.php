<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	public function index()
	{
		redirect('Home/login');
	}

	public function login()
	{
		$data = array();
		$data['title'] = "Login";
		if($this->session->userdata('e-roleId')) {
			if($this->session->userdata('e-roleId') == 1) {
				// Admin is logged in
				redirect('Home/admindashboard');
			} else if($this->session->userdata('e-roleId') == 3) {
				// User is logged in
				redirect('Home/userdashboard');
			} else {
				session_destroy();
				redirect('Home/login');
			}
		} else {
			// no one is logged in
			$this->load->view('includes/header.php',$data);
			$this->load->view('login.php',$data);
			$this->load->view('includes/footer.php',$data);
			$this->load->view('includes/login-js.php',$data);
		}
	}

	public function admindashboard()
	{
		$data = array();
		$data['title'] = "Admin Dashboard";
		if($this->session->userdata('e-roleId')) {
			if($this->session->userdata('e-roleId') == 1) { // Admin is logged in
				$this->load->view('includes/header.php',$data);
				$this->load->view('admindashboard.php',$data);
				$this->load->view('includes/footer.php',$data);
				$this->load->view('includes/admindashboard-js.php',$data);
			} else if($this->session->userdata('e-roleId') == 3) {
				// User is logged in
				redirect('Home/userdashboard');
			} else {
				session_destroy();
				redirect('Home/login');
			}
		} else {
			// no one is logged in
			redirect('Home/login');
		}
	}

	public function userdashboard()
	{
		$data = array();
		$data['title'] = "User Dashboard";
		if($this->session->userdata('e-roleId')) {
			if($this->session->userdata('e-roleId') == 1) {
				// Admin is logged in
				redirect('Home/admindashboard');
			} else if($this->session->userdata('e-roleId') == 3) {
				// User is logged in
				echo '<h1>This Is User Login</h1> <a class="btn btn-danger" href="'.base_url("Home/logout").'">Logout</a>';
			} else {
				session_destroy();
				redirect('Home/login');
			}
		} else {
			// no one is logged in
			redirect('Home/login');
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('Home');
	}
}
