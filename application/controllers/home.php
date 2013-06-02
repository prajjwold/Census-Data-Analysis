<?php

class Home extends CI_Controller {

    private $hash_index = 777;

    public function index() {
        $this->load->model('cluster_model');
        $data['title'] = "";
        $data['main_content'] = "index";
        if ($query = $this->cluster_model->get_clusters()) {
            $data['cluster_info'] = $query;
        }
       //$this->load->view('template/template', $data);
       $this->openlayer();
    }

    public function openLayer() {
        $data['main_content'] = "openLayer";
        if($query = $this->cluster_model->get_cluster_info()){
            $data['cluster_info'] = $query;
        }
        if($query = $this->cluster_model->get_popup_info()){
            $data['popup_info'] = $query;
        }
        // if ($query = $this->cluster_model->get_num_clusters()) {
        //     $data['num_cluster'] = $query;
        //  }
       // $data['title'] = "";
        //echo 'The OpenLayer Page';
        $this->load->view('openLayer', $data);
    }

}
?>
