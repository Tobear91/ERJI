<?php

namespace App\Infrastructure\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class Doctrine
{
    private static $_instance;
    private $entity_manager;

    /**
     * Retourne une instance de Doctrine
     */
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();
        $paths = [
            __DIR__ . '/../../Module/User/Infrastructure/Doctrine/Entity',
            __DIR__ . '/../../Module/Societe/Infrastructure/Doctrine/Entity',
            __DIR__ . '/../../Module/SocieteType/Infrastructure/Doctrine/Entity'
        ];
        $isDevMode = 'true';

        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'driver' => $_ENV['DB_DRIVER'],
            'charset' => $_ENV['DB_CHARSET'],
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($connectionParams, $config);
        $this->entity_manager = new EntityManager($connection, $config);
    }

    /**
     * Retourne une instance de Doctrine sans en créer une nouvelle si elle existe déjà
     * @return Doctrine
     */
    public static function getInstance(): self
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * Retourne l'EntityManager
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entity_manager;
    }
}
