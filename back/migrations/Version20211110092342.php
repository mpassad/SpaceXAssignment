<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211110092342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE launch ADD rocket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE launch ADD CONSTRAINT FK_79B757F5C57537DF FOREIGN KEY (rocket_id) REFERENCES rocket (id)');
        $this->addSql('CREATE INDEX IDX_79B757F5C57537DF ON launch (rocket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE launch DROP FOREIGN KEY FK_79B757F5C57537DF');
        $this->addSql('DROP INDEX IDX_79B757F5C57537DF ON launch');
        $this->addSql('ALTER TABLE launch DROP rocket_id');
    }
}
