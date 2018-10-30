<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModels extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

//добавление спортивного питания
    public function addpit($d)
    {
        $string = array(
            'sp_name' => $d['name'],
            'sp_price' => $d['price'],
            'sp_inf' => $d['text'],
            'sp_sections' => $d['section'],
            'sp_imgname' => $d['imgname'],
        );
        $q = $this->db->insert_string('spo', $string);
        return $this->db->query($q);
    }

// Select ALL
    public function selectAll($table, $num = null, $offset = null)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table, $num, $offset);
        return $query->result();

    }
//    Select with where



// Delete по id и tablename
public function deleteOne($table,$id){


    $this->db->where('id', $id);
    $this->db->delete($table);

    if ($this->db->affected_rows() == '1') {
        return TRUE;
    }
    else {
        return FAlSE;
    }
}

}

