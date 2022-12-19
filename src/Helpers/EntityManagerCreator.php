<?php

namespace Library\Helpers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    public static function create()
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../models"],
            isDevMode: true
        );

        $connection = [
            "driver" => "pdo_mysql",
            "user" => "root",
            "port" => 3306,
            "password" => "r2d2c3potc14ig88",
            "host" => "localhost",
            "dbname" => "library_system"
        ];

        return EntityManager::create($connection, $config);
    }
}

?>