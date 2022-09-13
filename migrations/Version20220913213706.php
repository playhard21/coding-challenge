<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913213706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65CC5B476DB');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65C22532272');
        $this->addSql('DROP INDEX UNIQ_F08FC65CC5B476DB ON logs');
        $this->addSql('DROP INDEX UNIQ_F08FC65C22532272 ON logs');
        $this->addSql('ALTER TABLE logs ADD date_id INT NOT NULL, ADD request_id INT NOT NULL, DROP date_id_id, DROP request_id_id');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65CB897366B FOREIGN KEY (date_id) REFERENCES log_dates (id)');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65C427EB8A5 FOREIGN KEY (request_id) REFERENCES log_request (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F08FC65CB897366B ON logs (date_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F08FC65C427EB8A5 ON logs (request_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65CB897366B');
        $this->addSql('ALTER TABLE logs DROP FOREIGN KEY FK_F08FC65C427EB8A5');
        $this->addSql('DROP INDEX UNIQ_F08FC65CB897366B ON logs');
        $this->addSql('DROP INDEX UNIQ_F08FC65C427EB8A5 ON logs');
        $this->addSql('ALTER TABLE logs ADD date_id_id INT NOT NULL, ADD request_id_id INT NOT NULL, DROP date_id, DROP request_id');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65CC5B476DB FOREIGN KEY (date_id_id) REFERENCES log_dates (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE logs ADD CONSTRAINT FK_F08FC65C22532272 FOREIGN KEY (request_id_id) REFERENCES log_request (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F08FC65CC5B476DB ON logs (date_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F08FC65C22532272 ON logs (request_id_id)');
    }
}
