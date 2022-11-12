<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112171201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE section_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE page (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE section (id INT NOT NULL, page_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D737AEFC4663E4 ON section (page_id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text ADD section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE text ADD title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C7D823E37A FOREIGN KEY (section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3B8BA7C7D823E37A ON text (section_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE text DROP CONSTRAINT FK_3B8BA7C7D823E37A');
        $this->addSql('DROP SEQUENCE page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE section_id_seq CASCADE');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT FK_2D737AEFC4663E4');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP INDEX IDX_3B8BA7C7D823E37A');
        $this->addSql('ALTER TABLE text DROP section_id');
        $this->addSql('ALTER TABLE text DROP title');
    }
}
