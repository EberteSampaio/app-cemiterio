<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251022185700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE falecidos ADD COLUMN data_entrada DATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__falecidos AS SELECT id, data_falecimento, pessoa_nome_completo, pessoa_data_nascimento, timestamp_created_at, timestamp_updated_at FROM falecidos');
        $this->addSql('DROP TABLE falecidos');
        $this->addSql('CREATE TABLE falecidos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, data_falecimento DATE NOT NULL, pessoa_nome_completo VARCHAR(255) NOT NULL, pessoa_data_nascimento DATE DEFAULT NULL, timestamp_created_at DATETIME NOT NULL, timestamp_updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO falecidos (id, data_falecimento, pessoa_nome_completo, pessoa_data_nascimento, timestamp_created_at, timestamp_updated_at) SELECT id, data_falecimento, pessoa_nome_completo, pessoa_data_nascimento, timestamp_created_at, timestamp_updated_at FROM __temp__falecidos');
        $this->addSql('DROP TABLE __temp__falecidos');
    }
}
