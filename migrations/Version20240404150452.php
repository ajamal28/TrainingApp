<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240404150452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, car_id INT NOT NULL, plane_id INT NOT NULL, bike_id INT NOT NULL, UNIQUE INDEX UNIQ_1B80E486C3C6F69F (car_id), UNIQUE INDEX UNIQ_1B80E486F53666A8 (plane_id), UNIQUE INDEX UNIQ_1B80E486D5A4816F (bike_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486F53666A8 FOREIGN KEY (plane_id) REFERENCES planes (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486D5A4816F FOREIGN KEY (bike_id) REFERENCES bikes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486C3C6F69F');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486F53666A8');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486D5A4816F');
        $this->addSql('DROP TABLE vehicle');
    }
}
