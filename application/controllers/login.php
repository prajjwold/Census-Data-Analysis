<?php 
class Login extends CI_Controller{
	
	function index(){
		$data['main_content'] = 'login_form';
		$data['title'] = 'Admin Page';
		$this->load->view('includes/template', $data);
	}

	function validate_credentials(){
		if(!$this->input->post('submit')){
			redirect('login/index');
		}
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		if($query){
			$data = array(
				'username' => $this->input->post('username'),
				'logged_in' => TRUE
				);
			$this->session->set_userdata($data);
			redirect('admin/admin_area');
		}
		else{
			$data['main_content'] = 'login_form';
			$data['title'] = 'Admin Login';
			$this->load->view('includes/template', $data);
		}
	}

	function signout(){
		$data = array(
			'username' => '',
			'logged_in' => FALSE
			);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		redirect('home');
	}
}