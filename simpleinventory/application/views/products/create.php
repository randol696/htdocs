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

<h2><?php echo $title ?></h2>

<?php echo validation_errors(); ?>

<?php
if ($edit)
    echo form_open('products/create/' . $id);
else
    echo form_open('products/create');
?>

<table>

<?php if ($edit) { ?>
        <tr>
            <td>ID:</td><td> <?php echo $formitem["id"]; ?></td>
        </tr>
<?php } ?>

    <tr>
        <td>
            <label for="description">Descrição</label></td><td>
            <input size="50" type="input" name="description" value="<?php
            if (isset($formitem)) {
                echo $formitem["description"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="quantity" >Quantidade</label></td><td>
            <input type="input" name="quantity" value="<?php
            if (isset($formitem)) {
                echo $formitem["quantity"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="quantitymin" >Quantidade Mínima</label></td><td>
            <input type="input" name="quantitymin" value="<?php
            if (isset($formitem)) {
                echo $formitem["quantitymin"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="position" >Posição no Estoque</label></td><td>
            <input type="input" name="position" value="<?php
            if (isset($formitem)) {
                echo $formitem["position"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="obs">Obs.</label>
        </td>
        <td>
            <textarea name="obs">
                <?php
                if (isset($formitem)) {
                    echo $formitem["obs"];
                }
                ?></textarea>
        </td>
    </tr>
    <tr>
        <td></td><td>
            <?php if ($edit) { ?>
                <input type="submit" name="submit" value="Update" />
            <?php } else { ?>
                <input type="submit" name="submit" value="Create" />
<?php } ?>
        </td>
    </tr>

</table>
</form>

<h2>Fornecedores</h2>
<table>
 <tr>
	 <th>ID</th>
	 <th>Nome</th>
	 <th>Pre&ccedil;o</th>
 </tr>
 
     <?php if(isset($suppliers)){ ?>
<?php foreach ($suppliers as $items): ?>
    <tr>
        <td><?php echo $items['id']; ?></td>
        <td><?php echo $items['name']; ?></td>        
        <td><?php echo $items['price']; ?></td>   
        <td><a href="<?php echo site_url('products/addsupplier/'.$items['psid'].'/'.$formitem["id"].'/'.$items['id']);?>">Edit</a></td>
        <td><a href="<?php echo site_url('products/askremovesupplier/'.$items['psid']);?>">Remove</a></td>
        </tr>
<?php endforeach; ?>
    <?php }else{ ?>
        <tr>
            <td colspan="8">
        No items</td>
        </tr>
        <?php } ?>
        
</table>
<?php if ($edit) { ?>
<a class="link_button_3" href="<?php echo site_url('suppliers/usrselect/products/addsupplier/-1/'.$formitem["id"]);?>">Add Supplier</a>
<?php } ?>

