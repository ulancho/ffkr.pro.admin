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
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }

    public function clubs(){
        $this->load->view('main/header/header');
        $this->load->view('main/clubs');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function trainers(){
        $this->load->view('main/header/header');
        $this->load->view('main/trainers');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function one_clubs(){
        $this->load->view('main/header/header');
        $this->load->view('main/one-clubs');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function personal_trainer(){
        $this->load->view('main/header/header');
        $this->load->view('main/personal-trainer');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function contact(){
        $this->load->view('main/header/header');
        $this->load->view('main/contact-us');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function news(){
        $this->load->view('main/header/header');
        $this->load->view('main/news');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function one_news(){
        $this->load->view('main/header/header');
        $this->load->view('main/one-news');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function error_page(){
        $this->load->view('404');
    }
    public function education(){
        $this->load->view('main/header/header');
        $this->load->view('main/education');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }
    public function sport_eat(){
        $this->load->view('main/header/header');
        $this->load->view('main/sport_eat');
        $this->load->view('main/modal');
        $this->load->view('main/footer/footer');
    }


}
