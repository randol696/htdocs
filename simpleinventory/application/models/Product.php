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

Class Product extends CI_Model {
    
    public function get_all() {
		//$this->db->order_by("description", "desc"); 
        $query = $this->db->query("SELECT * FROM products ORDER BY description asc");
        return $query->result_array();
    }
    
    public function get_low_qtty(){
		$query = $this->db->query("SELECT * FROM products WHERE quantity <= quantitymin and quantitymin > 0 ORDER BY description");
        return $query->result_array();
	}
    
    public function record_count() {
        return $this->db->count_all("products");
    }
    
    public function get_limited($limit=-1,$start=-1){
        if($limit != -1 && $start != -1){
             $this->db->limit($limit, $start);
             $this->db->order_by("description", "asc"); 
             $query = $this->db->get("products");
             return $query->result_array();
        }
        return $this->get_all();
    }

    public function get_by_id($id) {
        $query = $this->db->query("SELECT * FROM products where id=$id");
        return $query->row_array();
    }
    
    public function get_prosup_by_id($id) {
        $query = $this->db->query("SELECT * FROM prosup where id=$id");
        return $query->row_array();
    }

    public function set_values($id = -1) {
        $this->load->helper('url');

        $data = array(
            'description' => $this->input->post('description'),
            'quantity' => $this->input->post('quantity'),
            'quantitymin' => $this->input->post('quantitymin'),
            'position' => $this->input->post('position'),
            'obs' => $this->input->post('obs')
        );

        if ($id != -1) {        
            return $this->db->update('products', $data, "id = " . $id);
        } else {
            return $this->db->insert('products', $data);
        }
    }
    
    public function search(){
        $this->db->or_like('id', $this->input->post('search'), 'both');
        $this->db->or_like('description', $this->input->post('search'), 'both');
        $this->db->or_like('position', $this->input->post('search'), 'both');
        $query = $this->db->get('products');
        return $query->result_array();
    }
    
    public function remove($id=-1){
        if($id != -1){
            $this->db->where('id',$id);
            return $this->db->delete('products');
        }
        return 0;
    }
    
    public function newsupplier($id){ 
        $data = array(
            'suppliers_id' => $this->input->post('suppliers_id'),
            'products_id' => $this->input->post('products_id'),
            'price' => $this->input->post('price'),
            'obs' => $this->input->post('obs')
        );        
        if ($id != -1) {        
            return $this->db->update('prosup', $data, "id = " . $id);
        } else {
            return $this->db->insert('prosup', $data);
        }
    }
    public function get_all_suppliers($pid) {
        $query = $this->db->query("SELECT ps.id as psid, s.id, s.name, ps.price
        FROM prosup as ps, products as p, suppliers as s 
        WHERE  ps.products_id = p.id and ps.suppliers_id = s.id and p.id = ".$pid);
        return $query->result_array();
    }
    public function removesupplier($id=-1){
        if($id != -1){
            $this->db->where('id',$id);
            return $this->db->delete('prosup');
        }
        return 0;
    }
    
    public function p_io($in, $id){
		
		$qtty = $this->input->post('quantity');
		//$p = $this->get_by_id($id);
		
		if($in){
			$this->db->set('quantity', 'quantity + '.$qtty, FALSE);
		}else{
			$this->db->set('quantity', 'quantity - '.$qtty, FALSE);
		}
                $this->db->where("id", $id);
		return $this->db->update('products');
	}
    
}
