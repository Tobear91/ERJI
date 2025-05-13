<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513152358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4C62E638FCF77503 ON contact (societe_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FCF77503
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4C62E638FCF77503 ON contact
        SQL);
    }
}
