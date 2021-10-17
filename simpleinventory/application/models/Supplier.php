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

Class Supplier extends CI_Model {
    
    public function get_all() {
        $query = $this->db->query("SELECT * FROM suppliers");
        return $query->result_array();
    }
    
    public function record_count() {
        return $this->db->count_all("suppliers");
    }
    
    public function get_limited($limit=-1,$start=-1){
        if($limit != -1 && $start != -1){
             $this->db->limit($limit, $start);
             $query = $this->db->get("suppliers");
             return $query->result_array();
        }
        return $this->get_all();
    }

    public function get_by_id($id) {
        $query = $this->db->query("SELECT * FROM suppliers where id=$id");
        return $query->row_array();
    }

    public function set_values($id = -1) {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'contact' => $this->input->post('contact'),
            'address' => $this->input->post('address'),
            'obs' => $this->input->post('obs')
        );

        if ($id != -1) {        
            return $this->db->update('suppliers', $data, "id = " . $id);
        } else {
            return $this->db->insert('suppliers', $data);
        }
    }
    
    public function search(){
        $this->db->or_like('name', $this->input->post('search'), 'both');
        $this->db->or_like('contact', $this->input->post('search'), 'both');
        $this->db->or_like('address', $this->input->post('search'), 'both');
        $this->db->or_like('email', $this->input->post('search'), 'both');
        $this->db->or_like('obs', $this->input->post('search'), 'both');
        $query = $this->db->get('suppliers');
        return $query->result_array();
    }
    
    public function remove($id=-1){
        if($id != -1){
            $this->db->where('id',$id);
            return $this->db->delete('suppliers');
        }
        return 0;
    }
    
}
