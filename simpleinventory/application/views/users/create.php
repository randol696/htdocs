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

<?php if($edit)echo form_open('users/create/'.$id); else echo form_open('users/create'); ?>

    <label for="realname">Real Name</label>
    <input type="input" name="realname" value="<?php if(isset($user)){ echo $user["realname"]; } ?>"/><br/>
    
    <label for="username" >Username</label>
    <input type="input" name="username" value="<?php if(isset($user)){ echo $user["username"]; } ?>"/><br/>
    
    <label for="password">Password</label>
    <input type="password" name="password"/><br/>
    
    <label for="obs">Obs.</label>
    <textarea name="obs"><?php if(isset($user)){ echo $user["obs"]; } ?></textarea><br />
    
    <?php if($edit){ ?>
    <input type="submit" name="submit" value="Update" />
    <?php }else { ?>
    <input type="submit" name="submit" value="Create" />
    <?php } ?>

</form>

