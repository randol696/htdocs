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

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    private $upermissions="";
    function __construct() {
        parent::__construct();
        
        $session_data = $this->session->userdata('logged_in');
        $this->load->model('user');            
        $this->upermissions = $this->user->get_permissions_str($session_data["id"]);
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            $this->load->model('product');
            $data["lowitens"] = $this->product->get_low_qtty();

            
            
            $data["upermissions"] = $this->upermissions;
            $this->load->view('templates/header', $data);
            $this->load->view('home_view', $data);
            $this->load->view('templates/footer');
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    public function nopermission() {
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('templates/header', $data);
        $this->load->view('nopermission');
        $this->load->view('templates/footer');
    }

}
