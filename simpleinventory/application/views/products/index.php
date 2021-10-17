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
<a class="link_button_3" href="<?php echo site_url('products/create');?>">Novo Produto</a>
</div>

<h2>Products List</h2>
<?php if(isset($tadd)){ ?>
Product added with success.
<?php } ?>
<?php if(isset($trem)){ ?>
Product REMOVED with success.
<?php } ?>
<?php if(isset($pio)){ ?>
Quantity changed with success.
<?php } ?>

<?php echo form_open('products/search'); ?>   
<label for="search">Search</label>
    <input type="input" name="search" value="<?php if(isset($search_text)){ echo $search_text; } ?>"/><br/>
</form>
<?php if(isset($links)) echo $links; ?>
<table>
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Posição</th>
        <th>QTTY</th>
        <th colspan="4"> </th>
    </tr>
    
    <?php if(isset($tabitens)){ ?>
<?php foreach ($tabitens as $items): ?>
    <tr>
        <td><?php echo $items['id']; ?></td>
        <td 
        <?php if($items["quantity"] <= $items["quantitymin"] && $items["quantitymin"] >0){ ?>
        style="color:red"
        <?php } ?>
        ><?php echo $items['description']; ?></td>        
        <td><?php echo $items['position']; ?></td>   
        <td <?php if($items["quantity"] <= $items["quantitymin"] && $items["quantitymin"] >0){ ?>
        style="color:red"
        <?php } ?>><?php echo $items['quantity']; ?>
        <?php if($items["quantity"] <= $items["quantitymin"] && $items["quantitymin"] >0){ ?>
        (min = <?php echo  $items["quantitymin"]?>)
        <?php } ?>
        </td>  
        <td><a style="padding: 3px 11px;" class="link_button_3_green" href="<?php echo site_url('products/stockio/'.$items['id']."/1");?>">Entrada</a></td>
        <td><a style="padding: 3px 11px;" class="link_button_3_red" href="<?php echo site_url('products/stockio/'.$items['id']."/0");?>">Saída</a></td>
        <td><a href="<?php echo site_url('products/create/'.$items['id']);?>">
            <img style="width:20px" src="<?php echo base_url()."/images/pencil.png" ?>" alt="Edit"/>
            </a></td>
        <td><a   href="<?php echo site_url('products/askremove/'.$items['id']);?>">
                <img style="width:20px" src="<?php echo base_url()."/images/trash.png" ?>" alt="Remove"/>
                </a></td>
        </tr>
<?php endforeach; ?>
    <?php }else{ ?>
        <tr>
            <td colspan="8">
        No items</td>
        </tr>
        <?php } ?>
        
        
        
</table>
<?php if(isset($links)) echo $links; ?>
