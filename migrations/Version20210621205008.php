<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621205008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nom_artiste VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_category (artiste_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_4B8925D821D25844 (artiste_id), INDEX IDX_4B8925D812469DE2 (category_id), PRIMARY KEY(artiste_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_category ADD CONSTRAINT FK_4B8925D821D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_category ADD CONSTRAINT FK_4B8925D812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste_category DROP FOREIGN KEY FK_4B8925D821D25844');
        $this->addSql('ALTER TABLE artiste_category DROP FOREIGN KEY FK_4B8925D812469DE2');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE artiste_category');
        $this->addSql('DROP TABLE category');
    }
}
