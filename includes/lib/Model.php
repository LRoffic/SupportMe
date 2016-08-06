<?php
/*
Copyright (C) 2016  Lee-Roy Dubourg
  
This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program.  If not, see <http://www.gnu.org/licenses/>. 
*/

class Model implements ArrayAccess {
  private $entry = null;

  function __construct($entry){
    $this->entry = $entry;
  }

  function __get($property){
    if(isset($this->entry->{$property}))
      return $this->entry->{$property};
  }

  function __set($property, $value){
    $this->entry->{$property} = $value;
  }

  function save(){
    return $this->entry->save();
  }

  function offsetExists($offset) { return $this->entry->offsetExists($offset); }
  function offsetGet($offset) { return $this->entry->offsetGet($offset); }
  function offsetSet($offset, $value) { return $this->entry->offsetSet($offset, $value); }
  function offsetUnset($offset) { return $this->entry->offsetUnset($offset); }
}