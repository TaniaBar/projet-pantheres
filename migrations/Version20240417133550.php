<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417133550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_details (orders_id INT NOT NULL, wines_id INT DEFAULT NULL, boxes_id INT DEFAULT NULL, quantity INT NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_835379F15E3FCB91 (wines_id), INDEX IDX_835379F1DC3B2062 (boxes_id), PRIMARY KEY(orders_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F15E3FCB91 FOREIGN KEY (wines_id) REFERENCES wines (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1DC3B2062 FOREIGN KEY (boxes_id) REFERENCES boxes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1CFFE9AD6');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F15E3FCB91');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1DC3B2062');
        $this->addSql('DROP TABLE orders_details');
    }
}
