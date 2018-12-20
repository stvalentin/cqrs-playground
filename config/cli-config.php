<?php
require_once "../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_pgsql',
    'user'     => 'root',
    'password' => 'password',
    'dbname'   => 'root',
);

$config = Setup::createAnnotationMetadataConfiguration('', true);
$entityManager = EntityManager::create($dbParams, $config);
$entityManager->
