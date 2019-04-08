<?php
/**
 * Created by PhpStorm.
 * User: rida.n
 * Date: 3/28/2019
 * Time: 11:54 AM
 */

class LoginModel extends CI_Model
{
    public function login($email, $password){
        $this->db->select('fld_email', 'fld_password');
        $this->db->from('tbl_users');
        $this->db->where('fld_email', $email);
        $this->db->where('fld_password', $password);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }
        else{
            return false;
        }
    }
}