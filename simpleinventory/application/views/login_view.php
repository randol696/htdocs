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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Login</title>
   <link rel="stylesheet" href="<?php echo base_url();?>/css/main.css">
 </head>
 <body style = "background-image: url('<?php echo base_url();?>/images/grayjean.png')">
   
   <br/><br/><br/><br/>
   <h1 style="text-align:center;color:gray">Sistema</h1>
   <br/>
   <?php echo validation_errors(); ?>
   <div class="spaced_form" >
   <?php echo form_open('verifylogin'); ?>
   
   <table style="margin: 0 auto; width: 250px;border:1px solid rgb(230,230,230);background-color:white">
       <tr><th colspan="2">Login</th></tr>
	   <tr>
		   <td><label for="username">Username:</label></td>
		   <td><input type="input" size="20" id="username" name="username"/></td>
	   </tr>
	   <tr>
		   <td><label for="password">Password:</label></td>
		   <td><input type="password" size="20" id="passowrd" name="password"/></td>
	   </tr>
     
     
     <tr><td colspan="2" style="text-align:right">
     <input class="link_button_3" type="submit" value="Login"/>
     </td></tr>
     </table>
   </form>
   </div>
 </body>
</html>

