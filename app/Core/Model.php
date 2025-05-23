<?php
namespace App\Core;

use PDO;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=teste-php;charset=utf8',
            'root', 
            ''
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
