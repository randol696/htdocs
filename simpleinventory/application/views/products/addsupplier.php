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
Adicionar o fornecedor <b><?php echo $supplier["name"]; ?></b> ao produto
<b><?php echo $product["description"]; ?></b>

<br/><br/>

<?php echo form_open('products/addsupplier/'.$id."/".$product["id"]."/".$supplier["id"]); ?>

<input type="hidden" name="suppliers_id" value="<?php echo $supplier["id"]; ?>"/>
<input type="hidden" name="products_id" value="<?php echo $product["id"]; ?>"/>

Price: <input type="input" value="<?php
            if (isset($price)) {
                echo $price;
            }
            ?>" name="price"/>
<input type="submit" value="OK"/>
</form>

