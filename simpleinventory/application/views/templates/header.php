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

?><!doctype html>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url();?>/css/main.css">
    </head>
    <body
    style = "background-image: url('<?php echo base_url();?>/images/greyzz.png')"
    > 
        
    <div id="wrapper">

<table><tr><td> <h1>Sistema</h1> </td><td style="text-align:right"> 
	<a href="<?php echo site_url('home/logout');?>">Sair</a> </td></tr></table>

<?php
$t_products = true;
$t_users = true;
$t_suppliers = true;
if(isset($upermissions)){
    
    if(strpos($upermissions, "[users.") === FALSE){
        $t_users = false;
    }
    if(strpos($upermissions, "[products.") === FALSE){
        $t_products = false;
    }
    if(strpos($upermissions, "[suppliers.") === FALSE){
        $t_suppliers = false;
    }
    if(strpos($upermissions, "*") !== FALSE){
        $t_products = true;
        $t_users = true;
        $t_suppliers = true;
    }
}
?>
<div id="navbar">
<ul>
  
  <li><a <?php if($this->uri->segment(1) == 'home'){ ?> class="active" <?php } ?> href="<?php echo site_url('home/index');?>">Home</a></li>
  <?php if($t_users){ ?><li><a <?php if($this->uri->segment(1) == 'users'){ ?> class="active" <?php } ?> href="<?php echo site_url('users/index');?>">Usuários</a></li><?php } ?>
  <?php if($t_products){ ?><li><a <?php if($this->uri->segment(1) == 'products'){ ?> class="active" <?php } ?> href="<?php echo site_url('products/index');?>">Produtos</a></li><?php } ?>
  <?php if($t_suppliers){ ?><li><a <?php if($this->uri->segment(1) == 'suppliers'){ ?> class="active" <?php } ?> href="<?php echo site_url('suppliers/index');?>">Fornecedores</a></li><?php } ?>
</ul>
</div>

   
   <div class="tabcontent">
