<?php 
class Admin extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('membership_model');
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('logged_in');
		if(!isset($is_logged_in) || $is_logged_in != TRUE){
			 redirect('login/index');
		}
	}

	function index(){
		$this->admin_area();
	}

	function admin_area(){
		$data['main_content'] = 'admin_area';
		$data['title'] = 'Admin Area';
		$this->load->view('includes/template', $data);
	}

//-----------------------------------------------------------------------------------------------------------------

	function newsevents_area(){
		$data['main_content'] = 'newsevents_area';
		$data['title'] = 'Newsevents Area';
		if($query = $this->membership_model->get_detail_record('news')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_newsevents(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'type' => $this->input->post('type'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'writer' => $this->input->post('writer'),
					//'date' => $this->input->post('date'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('news',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('news',$data);
				}
			}
			else{
				$config = array(
				'allowed_types' => 'jpg|jpeg|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000,
				'overwite' => false
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();  
				$data = array(
					'type' => $this->input->post('type'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'writer' => $this->input->post('writer'),
					//'date' => $this->input->post('date'),
					'photo' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				if($data['type']=="manoranjan")
				$this->membership_model->do_upload($data,$image_data,'news','full','thumbs',220,160,400,600);
				else
				$this->membership_model->do_upload($data,$image_data,'news','full','thumbs',100,70,400,600);

				
			}
		}
		redirect('admin/view_newsevents');
	}

	function view_newsevents(){
		$data['main_content'] = 'view_newsevents';
		$data['title'] = 'News Events';
		if($query = $this->membership_model->get_records('news')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_newsevents(){
		$this->membership_model->delete_row('news');
		redirect('admin/view_newsevents');
	}

	
//----------------------------------------------------------------------------------------------------

	function literature_area(){
		$data['main_content'] = 'literature_area';
		$data['title'] = 'literature Area';
		if($query = $this->membership_model->get_detail_record('literature')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_literature(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'writer' => $this->input->post('writer'),
					//'date' => $this->input->post('date'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('literature',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('literature',$data);
				}
			}
			else{
				$config = array(
				'allowed_types' => 'jpg|jped|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();  
				$data = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'writer' => $this->input->post('writer'),
					//'date' => $this->input->post('date'),
					'photo' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				$this->membership_model->do_upload($data,$image_data,'literature','full','thumbs',60,60,400,600);
			}
		}
		redirect('admin/view_literature');
	}

	function view_literature(){
		$data['main_content'] = 'view_literature';
		$data['title'] = 'literature';
		if($query = $this->membership_model->get_records('literature')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_literature(){
		$this->membership_model->delete_row('literature');
		redirect('admin/view_literature');
	}

//-----------------------------------------------------------------------------------------------------------------

	function interview_area(){
		$data['main_content'] = 'interview_area';
		$data['title'] = 'interview Area';
		if($query = $this->membership_model->get_detail_record('interview')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_interview(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'interviewer' => $this->input->post('interviewer'),
					'interviewed' => $this->input->post('interviewed'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					//'date' => $this->input->post('date'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('interview',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('interview',$data);
				}
			}
			else{
				$config = array(
				'allowed_types' => 'jpg|jped|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();  
				$data = array(
					'interviewer' => $this->input->post('interviewer'),
					'interviewed' => $this->input->post('interviewed'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					//'date' => $this->input->post('date'),
					'photo' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				$this->membership_model->do_upload($data,$image_data,'interview','full','thumbs',220,140,400,600);
			}
		}
		redirect('admin/view_interview');
	}

	function view_interview(){
		$data['main_content'] = 'view_interview';
		$data['title'] = 'News Events';
		if($query = $this->membership_model->get_records('interview')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_interview(){
		$this->membership_model->delete_row('interview');
		redirect('admin/view_interview');
	}

	
//----------------------------------------------------------------------------------------------------

function fkp_area(){
		$data['main_content'] = 'fkp_area';
		$data['title'] = 'further korea programs Area';
		if($query = $this->membership_model->get_detail_record('further_korea_programs')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_fkp(){
		if($this->input->post('submit')){
			$data = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('further_korea_programs',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('further_korea_programs',$data);
				}
			}
		redirect('admin/view_fkp');
	}

	function view_fkp(){
		$data['main_content'] = 'view_fkp';
		$data['title'] = 'Further Korea Programs';
		if($query = $this->membership_model->get_records('further_korea_programs')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_fkp(){
		$this->membership_model->delete_row('further_korea_programs');
		redirect('admin/view_fkp');
	}

	
//----------------------------------------------------------------------------------------------------

	function gallery_area(){
		$data['main_content'] = 'gallery_area';
		$data['title'] = 'Gallery Area';
		if($query = $this->membership_model->get_detail_record('gallery')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_gallery(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'type' => $this->input->post('type'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('gallery',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('gallery',$data);
				}
			}
			else{
				$config = array(
				'allowed_types' => 'jpg|jped|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000,
				'overwrite' => FALSE
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();  
				$data = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'type' => $this->input->post('type'),
					'photo' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				if($data['type']=="static")
				$this->membership_model->do_upload($data,$image_data,'gallery','gfull','gthumbs',115,220,600,800);
				else
				$this->membership_model->do_upload($data,$image_data,'gallery','gfull','gthumbs',115,220,300,400);

			}
		}
		redirect('admin/view_gallery');
	}

	function view_gallery(){
		$data['main_content'] = 'view_gallery';
		$data['title'] = 'Gallery';
		if($query = $this->membership_model->get_records('gallery')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_gallery(){
		$this->membership_model->delete_row('gallery');
		redirect('admin/view_gallery');
	}

	//----------------------------------------------------------------------------------------------------

	function add_area(){
		$data['main_content'] = 'add_area';
		$data['title'] = 'Add Area';
		if($query = $this->membership_model->get_detail_record('adds')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}


function add_area1(){
		$data['main_content'] = 'add_area1';
		$data['title'] = 'Add Area';
		if($query = $this->membership_model->get_detail_record('adds')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_add(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'title' => $this->input->post('title'),
					'position' => $this->input->post('position'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('adds',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('adds',$data);
				}
			}
			else{
				$config = array(
				'allowed_types' => 'jpg|jped|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();  
				$data = array(
					'title' => $this->input->post('title'),
					'position' => $this->input->post('position'),
					'photo' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				if($data['position']=="top")
				$this->membership_model->do_upload($data,$image_data,'adds','afull','athumbs',60,140,120,280);
				else
				$this->membership_model->do_upload($data,$image_data,'adds','afull','athumbs',120,215,240,430);
				
			}
		}
		redirect('admin/view_add');
	}


function create_add1(){
		if($this->input->post('upload')){
			if(!basename($_FILES['userfile']['name'])){
				$data = array(
					'position' => $this->input->post('position'),
					'id' => $this->input->post('id')
					);
				$this->db->where('id',$data['id']);
				$this->db->update('adds',$data);
				
			}
			else {
				$config = array(
				'allowed_types' => 'jpg|jped|png|gif',
				'upload_path' => realpath(APPPATH.'../image'),
				'max_size' => 20000
				//'file_name' => 'something'
				);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		
		$image_data = $this->upload->data();
		
				$data = array(
					'position' => $this->input->post('position'),
					'photo1' => basename($_FILES['userfile']['name']),
					'id' => $this->input->post('id')
					);
				
				if($data['position']=="top")
				$this->membership_model->do_upload($data,$image_data,'adds','afull','athumbs',60,140,600,800);
				else
				$this->membership_model->do_upload($data,$image_data,'adds','afull','athumbs',120,215,600,800);
				
			}
		}
		redirect('admin/view_add');
	}



	function view_add(){
		$data['main_content'] = 'view_add';
		$data['title'] = 'Adds';
		if($query = $this->membership_model->get_records('adds')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_add(){
		$this->membership_model->delete_row('adds');
		redirect('admin/view_add');
	}

	//----------------------------------------------------------------------------------------------------

	function link_area(){
		$data['main_content'] = 'link_area';
		$data['title'] = 'links';
		if($query = $this->membership_model->get_detail_record('links')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_link(){
		if($this->input->post('submit')){
			$data = array(
					'title' => $this->input->post('title'),
					'link' => $this->input->post('link'),
					'type' => $this->input->post('type'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('links',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('links',$data);
				}
			}
		redirect('admin/view_link');
	}

	function view_link(){
		$data['main_content'] = 'view_link';
		$data['title'] = 'Links';
		if($query = $this->membership_model->get_records('links')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_link(){
		$this->membership_model->delete_row('links');
		redirect('admin/view_link');
	}

	//----------------------------------------------------------------------------------------------------

	function video_area(){
		$data['main_content'] = 'video_area';
		$data['title'] = 'videos';
		if($query = $this->membership_model->get_detail_record('video')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function create_video(){
		if($this->input->post('submit')){
			$data = array(
					'title' => $this->input->post('title'),
					'url' => $this->input->post('url'),
					'position' => $this->input->post('position'),
					'discription' => $this->input->post('discription'),
					'id' => $this->input->post('id')
					);
				if(!$data['id']){
				$this->db->insert('video',$data);
				}
				else{
				$this->db->where('id',$data['id']);
				$this->db->update('video',$data);
				}
			}
		redirect('admin/view_video');
	}

	function view_video(){
		$data['main_content'] = 'view_video';
		$data['title'] = 'Videos';
		if($query = $this->membership_model->get_records('video')){
			$data['records'] = $query;
		}
		$this->load->view('includes/template', $data);
	}

	function delete_video(){
		$this->membership_model->delete_row('video');
		redirect('admin/view_video');
	}



}
