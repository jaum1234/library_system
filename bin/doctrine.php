#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Library\helper\EntityManagerCreator;

require_once "vendor/autoload.php";

$entityManager = EntityManagerCreator::create();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);