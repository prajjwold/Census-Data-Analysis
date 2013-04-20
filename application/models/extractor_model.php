<?php 
class Extractor_model extends CI_Model{
	
function get_interview(){
		$res = $this->db->query('SELECT id, title, photo, substring( content, 1, 150) as sub_content 
		FROM interview 
		ORDER BY date_in DESC 
		LIMIT 1');
		return $res->result();
		}
	
function get_sahitya(){
		$res = $this->db->query('SELECT id, title, photo, writer
		FROM literature 
		ORDER BY date_in DESC 
		LIMIT 3');
		return $res->result();
		}
	
	
function get_news($title, $len, $limit){
		if($limit == "all"){
		$res = $this->db->query('SELECT id, title, photo, substring( content, 1, '.$len.') as sub_content 
		FROM news 
		WHERE TYPE = "'.$title.'" 
		ORDER BY date_in DESC ');
			
			}
		else{
		$res = $this->db->query('SELECT id, title, photo, substring( content, 1, '.$len.') as sub_content 
		FROM news 
		WHERE TYPE = "'.$title.'" 
		ORDER BY date_in DESC 
		LIMIT '.$limit.'');
		}
		return $res->result();
		}

function get_news_paging($title, $len, $limit, $offset){
		
		$res = $this->db->query('SELECT id, title, photo, substring( content, 1, '.$len.') as sub_content 
		FROM news 
		WHERE TYPE = "'.$title.'" 
		ORDER BY date_in DESC 
		LIMIT '.$limit.','.$offset.'');
		
		return $res->result();
		}


function get_video($pos){
		if($pos == "top") $limit = 2;
		if($pos == "mid") $limit = 1;
		$res = $this->db->query('SELECT url, title, id  
		FROM video 
		WHERE position = "'.$pos.'" 
		ORDER BY id DESC 
		LIMIT '.$limit.'');
		return $res->result();
		}
	

function get_future_works(){
		$res = $this->db->query('SELECT id, title
		FROM further_korea_programs
		ORDER BY id DESC 
		LIMIT 9');
		return $res->result();
		}
	
function get_links($pos, $limit){
		
		$res = $this->db->query('SELECT title, link
		FROM links
		WHERE type = "'.$pos.'" 
		ORDER BY id DESC 
		LIMIT '.$limit.'');
		return $res->result();
		}	
		
function get_adds($pos){
		
		$res = $this->db->query('SELECT title, photo, id 
		FROM adds
		WHERE position = "'.$pos.'" 
		ORDER BY id DESC 
		LIMIT 4');
		return $res->result();
		}	
		
function get_images($pos){
		
		$res = $this->db->query('SELECT title, content, photo
		FROM gallery
		WHERE type = "'.$pos.'" 
		ORDER BY id DESC 
		LIMIT 5');
		return $res->result();
		}	

	}
?>