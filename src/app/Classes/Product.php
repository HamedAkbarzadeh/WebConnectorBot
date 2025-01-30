<?php

namespace src\app\Classes;

use function PHPSTORM_META\argumentsSet;

class Product
{

    private $sql = null;
    private $telegramApi = null;


    public function __construct($sql, $telegramApi)
    {
        $this->sql = $sql;
        $this->telegramApi = $telegramApi;
    }


    public function updateProduct($tableName, $productID, $columns, $values)
    {
        return $this->sql->table($tableName)->select()->where('id', $productID)->update($columns, $values);
    }
    public function store($columns, $values)
    {
        try {
            if (!is_array($columns) || !is_array($values)) {
                throw new \Exception("request argumen be should array");
            }
            return $this->sql->table('product')->insert($columns, $values);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
