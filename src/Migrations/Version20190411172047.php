<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411172047 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD description VARCHAR(255) DEFAULT NULL, CHANGE author_id author_id INT NOT NULL, CHANGE annee annee INT NOT NULL, CHANGE tduree tduree DOUBLE PRECISION NOT NULL, CHANGE image image VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE introduction introduction VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP description, CHANGE author_id author_id INT DEFAULT NULL, CHANGE annee annee DOUBLE PRECISION NOT NULL, CHANGE tduree tduree DOUBLE PRECISION DEFAULT NULL, CHANGE image image VARCHAR(500) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE introduction introduction VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
