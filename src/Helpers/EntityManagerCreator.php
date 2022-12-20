<?php

namespace Library\Helpers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class EntityManagerCreator
{
    public static function create()
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../models"],
            isDevMode: true
        );

        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();

        $connection = [
            "driver" => $_ENV["DB_DRIVER"],
            "user" => $_ENV["DB_USER"],
            "port" => 3306,
            "password" => $_ENV["DB_PASSWORD"],
            "host" => $_ENV["DB_HOST"],
            "dbname" => $_ENV["DB_NAME"]
        ];

        return EntityManager::create($connection, $config);
    }
}

?>