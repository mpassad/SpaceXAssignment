<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211110090304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE launch (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(2048) DEFAULT NULL, presskit VARCHAR(2048) DEFAULT NULL, webcast VARCHAR(2048) DEFAULT NULL, article VARCHAR(2048) DEFAULT NULL, wikipedia VARCHAR(2048) DEFAULT NULL, static_fire_date_utc DATETIME DEFAULT NULL, success TINYINT(1) DEFAULT NULL, details LONGTEXT DEFAULT NULL, payloads LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', flight_number INT DEFAULT NULL, name VARCHAR(1024) DEFAULT NULL, date_utc DATETIME DEFAULT NULL, upcoming TINYINT(1) DEFAULT NULL, api_id VARCHAR(2048) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rocket (id INT AUTO_INCREMENT NOT NULL, height DOUBLE PRECISION DEFAULT NULL, diameter DOUBLE PRECISION DEFAULT NULL, mass DOUBLE PRECISION DEFAULT NULL, image VARCHAR(2048) DEFAULT NULL, name VARCHAR(512) DEFAULT NULL, type VARCHAR(128) DEFAULT NULL, active TINYINT(1) NOT NULL, stages INT DEFAULT NULL, boosters INT DEFAULT NULL, cost_per_launch DOUBLE PRECISION DEFAULT NULL, success_rate_pct DOUBLE PRECISION DEFAULT NULL, first_flight DATE DEFAULT NULL, country VARCHAR(512) DEFAULT NULL, company VARCHAR(512) DEFAULT NULL, wikipedia VARCHAR(2048) DEFAULT NULL, description LONGTEXT DEFAULT NULL, api_id LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE launch');
        $this->addSql('DROP TABLE rocket');
    }
}
