<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522085213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE intervenant (id VARCHAR(36) NOT NULL, vic TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, contact_id VARCHAR(36) NOT NULL, chantier_id VARCHAR(36) NOT NULL, INDEX IDX_73D0145CE7A1254A (contact_id), INDEX IDX_73D0145CD0C0049D (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CD0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CE7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CD0C0049D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE intervenant
        SQL);
    }
}
