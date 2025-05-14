<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514090338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contact_function (id VARCHAR(36) NOT NULL, label VARCHAR(32) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389A837BF FOREIGN KEY (contact_function_id) REFERENCES contact_function (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4C62E6389A837BF ON contact (contact_function_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE contact_function
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389A837BF
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4C62E6389A837BF ON contact
        SQL);
    }
}
