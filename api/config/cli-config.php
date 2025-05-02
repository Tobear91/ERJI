<?php

require 'vendor/autoload.php';

use App\Infrastructure\Doctrine;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$config = new PhpFile(__DIR__ . '/migration.php');
$entity_manager = Doctrine::getInstance()->getEntityManager();
return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entity_manager));
