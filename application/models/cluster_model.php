<?php 
class Cluster_model extends CI_Model{
	
	
	function get_clusters(){
		$res = $this->db->query('SELECT * FROM demo_test');
		if($res->num_rows == 0){return null;}
		else{
		return $res->result();
		}
		}
	function get_cluster_info(){
		//This is the format for the list of district to be passed to the view
		$list= '"DAILEKH,DOLPA","JUMLA,KALIKOT,MUGU","HUMLA,BAJURA,BAJHANG,ACHHAM,DOTI,KAILALI,KANCHANPUR,DADELDHURA,BAITADI,DARCHULA"';
		return $list;
	}
	function get_popup_info(){
		//This is the format for the list of pop up info for each clusters
		$popup ='"This is sample popup","This is an another popup","This is another popup"';
		return $popup;
	}

	}
?>
