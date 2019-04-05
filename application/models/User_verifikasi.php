<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_verifikasi
 *
 * @author Acer
 */
class User_verifikasi extends CI_Model{
    function cek_user($user_id, $password){
        $this->db->where('user_id', $user_id);
        $this->db->where('password', $password);
        return $this->db->get('user');
    }
    
}
