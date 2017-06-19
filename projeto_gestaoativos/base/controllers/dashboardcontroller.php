<?php

class dashboardcontroller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('access');
    }

    public function index() {

        $this->load->view('dashboardview');
    }

}
