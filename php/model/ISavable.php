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
// TODO kann wahrscheinlich gelöscht werden
interface ISavable
{
    public function save();
}

