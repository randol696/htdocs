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

class Products extends CI_Controller {

    private $upermissions = "";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product');
        
        $this->load->helper('url_helper');
        
        if(!$this->session->userdata('logged_in'))
	   {
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	   }
        
           /*
        $this->load->model('user');
        $this->load->model('uprofile');
        $u = $this->user->get_user_by_id($this->session->userdata('logged_in')['id']);
        $p = $this->uprofile->get_by_id($u["uprofiles_id"]);
        */
           
        
        $session_data = $this->session->userdata('logged_in');
        $this->load->model('user');            
        $p = $this->user->get_permissions_str($session_data["id"]);
        $nper = "[".$this->router->fetch_class().".".$this->router->fetch_method()."]";
        if(strpos($p, $nper)===FALSE && $p!=='*'){
            redirect('home/nopermission','refresh');
        }
        $this->upermissions = $p;
        
          

    }

    public function index() {

        $this->load->helper('form');
        $this->load->library('pagination');

        $config['base_url'] = site_url('products/index');
        $config['total_rows'] = $this->product->record_count();
        $config['per_page'] = 50;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);


        $data["links"] = $this->pagination->create_links();

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["tabitens"] = $this->product->
                get_limited($config["per_page"], $page);


        //$data['tabitens'] = $this->product->get_all();

        $data["upermissions"] = $this->upermissions;
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }

    public function create($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        

        $data['title'] = "Create a new product";
        $data["id"] = $id;
        $data["edit"] = false;
        if ($id != -1) {
            $data["formitem"] = $this->product->get_by_id($id);
            $data["edit"] = true;
            $data['title'] = "Update a product";
            $data['suppliers'] = $this->product->get_all_suppliers($id);
        }

        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/create');
            $this->load->view('templates/footer');
        } else {
            $this->product->set_values($id);
            $data["tadd"] = true;

            $data['tabitens'] = $this->product->get_all();
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function addsupplier($id = -1, $pid = -1, $sid = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($sid == -1 || $pid == -1) {
            $data['tabitens'] = $this->product->get_all();
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('supplier');
            $data["supplier"] = $this->supplier->get_by_id($sid);
            $data["product"] = $this->product->get_by_id($pid);
            $data["id"] = $id;
            if($id != -1){
                $data["prosup"] = $this->product->get_prosup_by_id($id); 
                $data["price"] = $data["prosup"]["price"];
            }
            $this->form_validation->set_rules('price', 'Price', 'required');
            if ($this->form_validation->run() === FALSE) {
                $data["upermissions"] = $this->upermissions;
                $this->load->view('templates/header', $data);
                $this->load->view('products/addsupplier');
                $this->load->view('templates/footer');
            } else {
                $this->product->newsupplier($id);
                $data=array();
                $data["sadd"] = true;
				$data["id"] = $pid;
                $data["formitem"] = $this->product->get_by_id($pid);
                $data['suppliers'] = $this->product->get_all_suppliers($pid);
				$data["edit"] = true;
				$data['title'] = "Update a product";
                                $data["upermissions"] = $this->upermissions;
                $this->load->view('templates/header', $data);
                $this->load->view('products/create');
                $this->load->view('templates/footer');
            }
        }
    }

    public function search() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['tabitens'] = $this->product->search();
        $data["upermissions"] = $this->upermissions;
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
        $data["search_text"] = $this->input->post('search');
    }
    
    public function askremovesupplier($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('supplier');
        $ps = $this->product->get_prosup_by_id($id);
        $p = $this->product->get_by_id($ps["products_id"]);
        $s = $this->supplier->get_by_id($ps["suppliers_id"]);
        $data["psid"] = $ps["id"];
        $data["pid"] = $ps["products_id"];
        $data["controller"] = "products";
        $data["desc"] = $s["name"]." de ".$p["description"];
        $data["upermissions"] = $this->upermissions;
        $this->load->view('templates/header', $data);
        $this->load->view('products/askremovesupplier', $data);
        $this->load->view('templates/footer');
    }

    public function askremove($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $p = $this->product->get_by_id($id);
        $data["id"] = $p["id"];
        $data["controller"] = "products";
        $data["desc"] = $p["description"];
        $data["upermissions"] = $this->upermissions;
        $this->load->view('templates/header', $data);
        $this->load->view('products/askremove', $data);
        $this->load->view('templates/footer');
    }

    public function remove($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if ($this->product->remove($id)) {
            $data["trem"] = true;
            $data['tabitens'] = $this->product->get_all();
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }
    }
    
    public function removesupplier($pid, $sid = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('supplier');
        if ($this->product->removesupplier($sid)) {
            $data["srem"] = true;
            $data=array();
                
				$data["id"] = $pid;
                $data["formitem"] = $this->product->get_by_id($pid);
                $data['suppliers'] = $this->product->get_all_suppliers($pid);
				$data["edit"] = true;
				$data['title'] = "Update a product";
                                $data["upermissions"] = $this->upermissions;
                $this->load->view('templates/header', $data);
                $this->load->view('products/create');
                $this->load->view('templates/footer');
        }
    }

    public function stockio($id, $in = '1') {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data = array();
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data["id"] = $id;
            $data["in"] = $in;
            $data["product"] = $this->product->get_by_id($id);
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/stockio');
            $this->load->view('templates/footer');
        } else {
            $this->product->p_io($in, $id);
            $data["pio"] = true;


            $data['tabitens'] = $this->product->get_all();
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }
    }

}
