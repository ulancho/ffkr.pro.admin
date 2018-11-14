<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModels extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

// добавление спортивного питания
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

// Редактирование
    public function updatepit($arr)
    {
        if (isset($arr['imgname'])){
            $data = array(
                'sp_name' => $arr['name'],
                'sp_price' => $arr['price'],
                'sp_inf' => $arr['text'],
                'sp_sections' => $arr['section'],
                'sp_imgname' => $arr['imgname']
            );
        }
        else{
            $data = array(
                'sp_name' => $arr['name'],
                'sp_price' => $arr['price'],
                'sp_inf' => $arr['text'],
                'sp_sections' => $arr['section'],
            );
        }

        $this->db->where('id', $arr['id']);
        $q = $this->db->update('spo', $data);

        $success = $this->db->affected_rows();

        if (!$success) {
            return false;
        } else {
            return true;
        }
    }

// Select ALL
    public function selectAll($table, $num = null, $offset = null)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($table, $num, $offset);
        return $query->result();

    }

// Select with where po id
    public function getId($tablename, $id)
    {
        $sql = "SELECT * FROM $tablename WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

// Удаление изобр из папки
    private function deleteFiles($name)
    {
        return unlink(FCPATH . "public/images/sportpit/" . $name);
    }

// Delete по id и tablename
    public function deleteOne($table, $id)
    {
        $con = $this->getId($table, $id);
        $name = $con->sp_imgname;
        $this->db->where('id', $id);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            $this->deleteFiles($name);
            return TRUE;
        } else {
            return FAlSE;
        }
    }

}

