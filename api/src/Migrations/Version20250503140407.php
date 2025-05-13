<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503140407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE societe (id VARCHAR(36) NOT NULL, name VARCHAR(32) NOT NULL, address VARCHAR(64) NOT NULL, postal_code VARCHAR(16) NOT NULL, city VARCHAR(32) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, societe_type_id VARCHAR(36) NOT NULL, INDEX IDX_19653DBD8A0110 (societe_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE societe_type (id VARCHAR(36) NOT NULL, label VARCHAR(32) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id VARCHAR(36) NOT NULL, firstname VARCHAR(32) NOT NULL, lastname VARCHAR(32) NOT NULL, email VARCHAR(128) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE societe ADD CONSTRAINT FK_19653DBD8A0110 FOREIGN KEY (societe_type_id) REFERENCES societe_type (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE societe DROP FOREIGN KEY FK_19653DBD8A0110
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE societe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE societe_type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
