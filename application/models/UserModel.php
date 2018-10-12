<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Almaty');
    }

    public function checkLogin($login,$pwd)
    {
        $this->load->library('password');
        $this->db->select('*');
        $this->db->where('login', $login);
        $query = $this->db->get('user');
        $userInfo = $query->row();
        $count = $query->num_rows();

        if($count == 1){
            if(!$this->password->validate_password($pwd, $userInfo->password))
            {
                error_log('Неудачная попытка входа в систему('.$login.')');
                return false;
            }

        unset($userInfo->password);
        return $userInfo;
    }


}

}
