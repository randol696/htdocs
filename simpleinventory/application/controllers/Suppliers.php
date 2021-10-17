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

class Suppliers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('supplier');
        $this->load->helper('url_helper');
        
        if(!$this->session->userdata('logged_in'))
	   {
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	   }
           
        $this->load->model('user');
        $this->load->model('uprofile');
        $u = $this->user->get_user_by_id($this->session->userdata('logged_in')['id']);
        $p = $this->uprofile->get_by_id($u["uprofiles_id"]);
        $nper = "[".$this->router->fetch_class().".".$this->router->fetch_method()."]";
        //echo $nper."<br/>";
        //echo $p["permissions"];
        if(strpos($p["permissions"], $nper)===FALSE && $p["permissions"]!=='*'){
            redirect('home/nopermission','refresh');
        }
    }

    public function index() {

        $this->load->helper('form');
        $this->load->library('pagination');

        $config['base_url'] = site_url('supplier/index');
        $config['total_rows'] = $this->supplier->record_count();
        $config['per_page'] = 50;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["tabitens"] = $this->supplier->
                get_limited($config["per_page"], $page);
        //$data['tabitens'] = $this->product->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/index', $data);
        $this->load->view('templates/footer');
    }

    public function create($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = "Create a new supplier";
        $data["id"] = $id;
        $data["edit"] = false;
        if ($id != -1) {
            $data["formitem"] = $this->supplier->get_by_id($id);
            $data["edit"] = true;
            $data['title'] = "Update a supplier";
        }

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('suppliers/create');
            $this->load->view('templates/footer');
        } else {
            $this->supplier->set_values($id);
            $data["tadd"] = true;

            $data['tabitens'] = $this->supplier->get_all();
            $this->load->view('templates/header', $data);
            $this->load->view('suppliers/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function search() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['tabitens'] = $this->supplier->search();
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/index', $data);
        $this->load->view('templates/footer');
        $data["search_text"] = $this->input->post('search');
    }

    public function askremove($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $p = $this->supplier->get_by_id($id);
        $data["id"] = $p["id"];
        $data["controller"] = "suppliers";
        $data["desc"] = $p["name"];
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/askremove', $data);
        $this->load->view('templates/footer');
    }

    public function remove($id = -1) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if ($this->supplier->remove($id)) {
            $data["trem"] = true;
            $data['tabitens'] = $this->supplier->get_all();
            $this->load->view('templates/header', $data);
            $this->load->view('suppliers/index', $data);
            $this->load->view('templates/footer');
        }
    }
    
    
    public function usrselect($rcontroller,$rmethod,$arg1=null,$arg2=null,$arg3=null) {

        $this->load->helper('form');
        $this->load->library('pagination');
        
        $data["responseto"] = $rcontroller."/".$rmethod;
        if($arg1 != null){
            $data["responseto"] = $data["responseto"]."/".$arg1;
        }
        if($arg2 != null){
            $data["responseto"] = $data["responseto"]."/".$arg2;
        }
        if($arg3 != null){
            $data["responseto"] = $data["responseto"]."/".$arg3;
        }

        $config['base_url'] = site_url('supplier/usrselect');
        $config['total_rows'] = $this->supplier->record_count();
        $config['per_page'] = 50;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["tabitens"] = $this->supplier->
                get_limited($config["per_page"], $page);
        //$data['tabitens'] = $this->product->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/usrselect', $data);
        $this->load->view('templates/footer');
    }
    
    public function usrselectsearch($rcontroller,$rmethod,$arg1=null,$arg2=null,$arg3=null) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data["responseto"] = $rcontroller."/".$rmethod;
        if($arg1 != null){
            $data["responseto"] = $data["responseto"]."/".$arg1;
        }
        if($arg2 != null){
            $data["responseto"] = $data["responseto"]."/".$arg2;
        }
        if($arg3 != null){
            $data["responseto"] = $data["responseto"]."/".$arg3;
        }
        
        $data['tabitens'] = $this->supplier->search();
        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/usrselect', $data);
        $this->load->view('templates/footer');
        $data["search_text"] = $this->input->post('search');
    }
}
