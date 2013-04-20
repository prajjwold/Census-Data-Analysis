<?php 
class Cluster_model extends CI_Model{
	
	
	function get_clusters(){
		$res = $this->db->query('SELECT * FROM demo_test');
		if($res->num_rows == 0){return null;}
		else{
		return $res->result();
		}
		}
	
	}
?>
