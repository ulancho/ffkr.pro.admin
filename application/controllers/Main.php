<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index(){
        $this->load->view('main/header/header');
        $this->load->view('main/index');
        $this->load->view('main/footer/footer');
    }

}
