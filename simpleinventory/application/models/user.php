<?php

/* 
 * Copyright (C) 2016 Leandro Israel Pinto
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

Class User extends CI_Model {
    
    function login($username, $password) {
        $this->db->select('id, username, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_users() {
        $query = $this->db->query("SELECT * FROM users");
        return $query->result_array();
    }
    
    public function get_permissions_str($uid){
        if($uid=="") return "";
        $query = $this->db->query("SELECT * FROM users as u,uprofiles as p WHERE u.uprofiles_id = p.id and u.id=$uid");
        $q = $query->result_array();
        return $q[0]["permissions"];
    }

    public function get_user_by_id($id) {
        $query = $this->db->query("SELECT * FROM users where id=$id");
        return $query->row_array();
    }

    public function set_user($id = -1) {
        $this->load->helper('url');

        $data = array(
            'username' => $this->input->post('username'),
            //'password' => md5($this->input->post('password')),
            'realname' => $this->input->post('realname'),
            'obs' => $this->input->post('obs')
        );

        if ($id != -1) {
            if ($this->input->post('password') != '') {
                $data["password"] = md5($this->input->post('password'));
            }      
            return $this->db->update('users', $data, "id = " . $id);
        } else {
            $data["password"] = md5($this->input->post('password'));
            return $this->db->insert('users', $data);
        }
    }
    
    public function remove($id=-1){
        if($id != -1){
            $this->db->where('id',$id);
            return $this->db->delete('users');
        }
        return 0;
    }

}
