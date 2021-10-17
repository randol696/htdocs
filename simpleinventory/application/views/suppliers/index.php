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

<div class="submenu">
<a class="link_button_3" href="<?php echo site_url('suppliers/create');?>">New Supplier</a>
</div>

<h2>Suppliers List</h2>
<?php if(isset($tadd)){ ?>
Supplier added with success.
<?php } ?>
<?php if(isset($trem)){ ?>
Supplier REMOVED with success.
<?php } ?>


<?php echo form_open('suppliers/search'); ?>   
<label for="search">Search</label>
    <input type="input" name="search" value="<?php if(isset($search_text)){ echo $search_text; } ?>"/><br/>
</form>
<?php if(isset($links)) echo $links; ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th colspan="2"> </th>
    </tr>
    
    <?php if(isset($tabitens)){ ?>
<?php foreach ($tabitens as $items): ?>
    <tr>
        <td><?php echo $items['id']; ?></td>
        <td><?php echo $items['name']; ?></td>        
        <td><?php echo $items['email']; ?></td>   
        <td><?php echo $items['address']; ?></td>          
        <td><a href="<?php echo site_url('suppliers/create/'.$items['id']);?>">Edit</a></td>
        <td><a href="<?php echo site_url('suppliers/askremove/'.$items['id']);?>">Remove</a></td>
        </tr>
<?php endforeach; ?>
    <?php }else{ ?>
        <tr>
            <td colspan="6">
        No items</td>
        </tr>
        <?php } ?>
        
        
        
</table>
<?php if(isset($links)) echo $links; ?>
