<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260403223548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, original_name VARCHAR(255) DEFAULT NULL, file_name VARCHAR(255) NOT NULL, height INTEGER DEFAULT NULL, width INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, position INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE section (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, position INTEGER DEFAULT NULL, CONSTRAINT FK_2D737AEFC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2D737AEFC4663E4 ON section (page_id)');
        $this->addSql('CREATE TABLE spot (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, position VARCHAR(1000) DEFAULT NULL, access VARCHAR(1000) DEFAULT NULL, description CLOB DEFAULT NULL, orientation VARCHAR(1000) DEFAULT NULL, water VARCHAR(1000) DEFAULT NULL, dangers VARCHAR(1000) DEFAULT NULL, more CLOB DEFAULT NULL, security VARCHAR(1000) DEFAULT NULL, subtitle VARCHAR(1000) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, windguru_id INTEGER DEFAULT NULL, custom_content CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE text (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, section_id INTEGER DEFAULT NULL, "key" VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, content CLOB DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, position INTEGER DEFAULT NULL, CONSTRAINT FK_3B8BA7C7D823E37A FOREIGN KEY (section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3B8BA7C7D823E37A ON text (section_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE spot');
        $this->addSql('DROP TABLE text');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
