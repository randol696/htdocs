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



Class Uprofile extends CI_Model {
    
    

    public function get_all() {
        $query = $this->db->query("SELECT * FROM uprofiles");
        return $query->result_array();
    }

    public function get_by_id($id) {
        $query = $this->db->query("SELECT * FROM uprofiles where id=$id");
        return $query->row_array();
    }

    

}

