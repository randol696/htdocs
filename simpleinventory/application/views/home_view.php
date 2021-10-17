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
<br/>
<div style="text-align:center">

   <h3>Ol&aacute; <?php echo $username; ?>!</h3>
   </div>

   <br/><br/>
   <?php if(isset($lowitens) && count($lowitens) > 0){ ?>
	   

           <div style="width:800px;margin:0 auto">
               
           <table>
               <tr><th colspan="4">Itens com estoque baixo</th></tr>
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Posição</th>
        <th>QTTY</th>
        
    </tr>   
    
<?php foreach ($lowitens as $items): ?>
    <tr>
        <td><?php echo $items['id']; ?></td>
        <td 
        <?php if($items["quantity"] <= $items["quantitymin"] && $items["quantitymin"] >0){ ?>
        style="color:red"
        <?php } ?>
        ><?php echo $items['description']; ?></td>        
        <td><?php echo $items['position']; ?></td>   
        <td><?php echo $items['quantity']; ?>
        <?php if($items["quantity"] <= $items["quantitymin"] && $items["quantitymin"] >0){ ?>
        (min = <?php echo  $items["quantitymin"]?>)
        <?php } ?>
        </td>  
        
       
        
        </tr>
<?php endforeach; ?>         
</table>
      </div>     
<?php } ?>
   
<br/><br/><br/><br/><br/>