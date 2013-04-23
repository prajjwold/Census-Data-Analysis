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
        $this->load->view('template/template', $data);
    }

    public function openLayer() {
        $data['main_content'] = "openLayer";
       // $data['title'] = "";
        $this->load->view('openLayer', $data);
    }

}

?>
