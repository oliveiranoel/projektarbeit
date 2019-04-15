<?php
namespace php\model;

/**
 * 
 * @author dsu
 * 
 * Classes that implement this interface are savable, 
 * meaning the inheriting class can be saved to the database.
 *
 */
interface ISavable
{
    public function save();
}

