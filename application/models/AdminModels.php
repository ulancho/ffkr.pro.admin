<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModels extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();

    }

    public function addpit($d){
        $string = array(
            'sp_name'=>$d['name'],
            'sp_price'=>$d['price'],
            'sp_inf'=>$d['text'],
            'sp_sections'=>$d['section'],
            'sp_imgname'=>$d['imgname'],
        );
        $q = $this->db->insert_string('spo',$string);
        return $this->db->query($q);
    }



}

