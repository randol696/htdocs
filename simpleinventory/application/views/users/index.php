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
<a class="link_button_3" href="<?php echo site_url('users/create');?>">New User</a>
</div>

<h2>Users List</h2>
<?php if(isset($useradd)){ ?>
User added with success.
<?php } ?>
<?php if(isset($userrem)){ ?>
User REMOVED with success.
<?php } ?>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>OBS.</th>
        <th colspan="2"> </th>
    </tr>
<?php foreach ($users as $users_item): ?>
    <tr>
        <td><?php echo $users_item['id']; ?></td>
        <td><?php echo $users_item['username']; ?></td>        
        <td><?php echo $users_item['realname']; ?></td>   
        <td><?php echo $users_item['obs']; ?></td>  
        <td><a href="<?php echo site_url('users/create/'.$users_item['id']);?>">Edit</a></td>
        <td><a href="<?php echo site_url('users/remove/'.$users_item['id']);?>">Remove</a></td>
        </tr>
<?php endforeach; ?>
</table>
