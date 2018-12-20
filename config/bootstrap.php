<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_pgsql',
    'user'     => 'root',
    'password' => 'password',
    'dbname'   => 'root',
);

$config = Setup::createAnnotationMetadataConfiguration([], true);
$entityManager = EntityManager::create($dbParams, $config);