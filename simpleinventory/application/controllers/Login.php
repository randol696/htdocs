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

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $this->load->helper(array('form'));
   $this->load->view('login_view');
   if($this->session->userdata('logged_in'))
	   {
		 //If session, redirect to home
		 redirect('home/index', 'refresh');
	   }
 }
 
 public function is_logged_redir(){
   if(!$this->session->userdata('logged_in'))
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

}

