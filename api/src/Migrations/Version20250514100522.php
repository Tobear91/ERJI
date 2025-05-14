<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514100522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE lot (id VARCHAR(36) NOT NULL, label VARCHAR(32) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, chantier_id VARCHAR(36) NOT NULL, INDEX IDX_B81291BD0C0049D (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lot ADD CONSTRAINT FK_B81291BD0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE lot DROP FOREIGN KEY FK_B81291BD0C0049D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lot
        SQL);
    }
}
