<?php 
class Membership_model extends CI_Model{
	
	var $gallery_path;
	var $gallery_path_url;

	function __construct(){
		parent::__construct();
		$this->gallery_path = realpath(APPPATH.'../image');
		$this->gallery_path_url = base_url().'/image/';
	}

	function validate(){
		$this->load->helper('security');
		$password = mysql_real_escape_string(strip_tags(substr($this->input->post('password'),0,40)));
		$username = mysql_real_escape_string(strip_tags(substr($this->input->post('username'),0,30)));
		$this->db->where('username', $username);
		$this->db->where('password1', do_hash($password));
		$query = $this->db->get('admin');
		if($query->num_rows == 1){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function do_upload($data, $image_data, $table, $full, $thumbs, $height, $width, $fh, $fw){ 
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path.'/'.$thumbs,
			'maintain_ratio' => TRUE,
			'width' => $width,
			'height' => $height 
			);
		$this->load->library('image_lib', $config);
		if ( ! $this->image_lib->resize()){
            echo $this->image_lib->display_errors();
        }
        $config = array(
	        'source_image'  => $image_data['full_path'],
	        'new_image' => $this->gallery_path.'/'.$full,
	        'maintain_ratio' => TRUE,
	        'width' => $fw,
	        'height' => $fh
	        );
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	    $this->image_lib->clear();
	    unlink($image_data['full_path']);
		if($data['id']){
			$this->db->where('id', $data['id']);
			$this->db->update($table,$data);
		}
		else{
			$this->db->insert($table,$data);
		}
		
		
	}

	function get_records($table){
		$query = $this->db->get($table);
		return $query->result();
	}

	function get_detail_record($table){
		$this->db->where('id', $this->uri->segment(3));
		$query = $this->db->get($table);
		return $query->row_array();
	}

	function delete_row($table){
		$this->db->where('id', $this->uri->segment(3));
		$this->db->delete($table);
	}

	function get_num_records($table,$no){
		$query = $this->db->query('select * from '.$table.' order by id DESC limit '.$no.'');
		return $query->result();
	}

	function get_news_records(){
		$query = $this->db->query("SELECT *
FROM `newsevents`
WHERE `catagory` LIKE 'समाचार' order by id DESC 
LIMIT 2");
		return $query->result();
	}

	function get_other_records(){
		$query = $this->db->query("SELECT *
FROM `newsevents`
WHERE `catagory` NOT LIKE 'समाचार' order by id DESC 
LIMIT 2");
		return $query->result();
	}

}