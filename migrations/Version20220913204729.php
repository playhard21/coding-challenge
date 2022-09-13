<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913204729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE log_dates (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, offset INT NOT NULL, date_utc DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log_request (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, end_point VARCHAR(255) NOT NULL, protocol VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, date_id INT NOT NULL, request_id INT NOT NULL, service_names VARCHAR(255) NOT NULL, status_code INT NOT NULL, UNIQUE INDEX UNIQ_F08FC65CC5B476DB (date_id_id), UNIQUE INDEX UNIQ_F08FC65C22532272 (request_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65CC5B476DB FOREIGN KEY (date_id) REFERENCES log_dates (id)');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65C22532272 FOREIGN KEY (request_id) REFERENCES log_request (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65CC5B476DB');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65C22532272');
        $this->addSql('DROP TABLE log_dates');
        $this->addSql('DROP TABLE log_request');
        $this->addSql('DROP TABLE logs');
    }
}
