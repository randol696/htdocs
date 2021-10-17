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
    echo form_open('suppliers/create/' . $id);
else
    echo form_open('suppliers/create');
?>

<table>

<?php if ($edit) { ?>
        <tr>
            <td>ID:</td><td> <?php echo $formitem["id"]; ?></td>
        </tr>
<?php } ?>

    <tr>
        <td>
            <label for="name">Name</label></td><td>
            <input size="50" type="input" name="name" value="<?php
            if (isset($formitem)) {
                echo $formitem["name"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="email" >Email</label></td><td>
            <input type="input" name="email" value="<?php
            if (isset($formitem)) {
                echo $formitem["email"];
            }
            ?>"/></td>
    </tr>
    <tr>
        <td>
            <label for="contact">Contact</label>
        </td>
        <td>
            <textarea name="contact"><?php
                if (isset($formitem)) {
                    echo $formitem["contact"];
                }
                ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label for="address">Address</label>
        </td>
        <td>
            <textarea name="address"><?php
                if (isset($formitem)) {
                    echo $formitem["address"];
                }
                ?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label for="obs">Obs.</label>
        </td>
        <td>
            <textarea name="obs"><?php
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

