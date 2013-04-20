<?php 	$this->load->view('template/header', $title);

		$this->load->view('template/banner');
		
		$this->load->view($main_content);
		
		$this->load->view('template/footer');?>