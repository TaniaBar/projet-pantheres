<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417134209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wines ADD suppliers_id INT NOT NULL');
        $this->addSql('ALTER TABLE wines ADD CONSTRAINT FK_58312A05355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
        $this->addSql('CREATE INDEX IDX_58312A05355AF43 ON wines (suppliers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wines DROP FOREIGN KEY FK_58312A05355AF43');
        $this->addSql('DROP INDEX IDX_58312A05355AF43 ON wines');
        $this->addSql('ALTER TABLE wines DROP suppliers_id');
    }
}
