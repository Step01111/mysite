<?php
namespace App\Models;

use App\Services\DB;

abstract class ActiveRecordEnt
{
    protected $id;
    protected $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public static function findAll()
    {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM `' . static::getTable() . '`';
        return $db->query($sql, null, static::class);
    }
    
    public static function getById(int $id)
    {
        $db = DB::getInstance();
        $sql = 'SELECT * from `' . static::getTable() . '` WHERE id = ' . (int)$id;
        $result = $db->query($sql, null, static::class);
        if ($result) {
            return $result[0];
        }
        else {
            return null;
        }
    }
    
    public static function getByColumn($column, $value)
    {
        $db = DB::getInstance();

        $sql = 'SELECT *
            FROM `'.static::getTable().'`
            WHERE `'.$column.'` = :value
            LIMIT 1';
        
        $values = [':value' => $value];

        $result = $db->query($sql, $values, static::class);
        if ($result) {
            return $result[0];
        }
    }
    
    abstract protected static function getTable(): string;
    
    public function save()
    {
        $mappedProperties = $this->mapProperties();

        if ($this->id) {
            return $this->update($mappedProperties);
        } else {
            return $this->insert($mappedProperties);
        }
    }
    
    private function update(array $properties)
    {
        $columns = [];
        $values = [];
        $i = 1;

        foreach ($properties as $column => $value) {
            $parametr = ':parametr'.$i;
            $columns[] = $column.' = '.$parametr;
            $values[$parametr] = $value;
            $i++;
        }
        
        $sql = 'UPDATE `' . static::getTable().'` SET '.implode(', ', $columns).
            ' WHERE id='.$this->id;
        $db = DB::getInstance();
        $result = $db->query($sql, $values, static::class);
        return $result;
    }
    
    private function insert(array $properties)
    {
        $filtered_properties = array_filter($properties);
        
        $columns = [];
        $parametrs = [];
        $values = [];

        foreach ($filtered_properties as $column => $value) {
            $columns[] = $column;
            $parametr = ':'.$column;
            $parametrs[] = $parametr;
            $values[$parametr] = $value;
        }
        
        $sql = 'INSERT INTO `' . static::getTable() . '` 
            ('. implode(', ', $columns).')
            VALUES ('. implode(', ', $parametrs).')';
        
        $db = DB::getInstance();
        $result = $db->query($sql, $values, static::class);
        if ($result) {
            $this->id = $db->getLastInsertId();
        }
        return $result;
    }
    
    public static function delete(int $id)
    {
        $db = DB::getInstance();
        $sql = 'DELETE FROM `'.static::getTable().'` WHERE id = :id';
        $values = [':id' => $id];
        $db->query($sql, $values);
    }

    private function mapProperties(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $property_name = $property->getName();
            $mappedProperties[$property_name] = $this->$property_name;
        }
        
        return $mappedProperties;
    }
}
