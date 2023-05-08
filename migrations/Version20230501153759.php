<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501153759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participa (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, campeonato_id INT DEFAULT NULL, INDEX IDX_E926CCDA76ED395 (user_id), INDEX IDX_E926CCD93BAAE11 (campeonato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, provincia_id INT NOT NULL, categoria_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nombre VARCHAR(50) NOT NULL, apellido1 VARCHAR(50) NOT NULL, apellido2 VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6494E7121AF (provincia_id), INDEX IDX_8D93D6493397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participa ADD CONSTRAINT FK_E926CCDA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE participa ADD CONSTRAINT FK_E926CCD93BAAE11 FOREIGN KEY (campeonato_id) REFERENCES campeonato (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6494E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6493397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participa DROP FOREIGN KEY FK_E926CCDA76ED395');
        $this->addSql('ALTER TABLE participa DROP FOREIGN KEY FK_E926CCD93BAAE11');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6494E7121AF');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6493397707A');
        $this->addSql('DROP TABLE participa');
        $this->addSql('DROP TABLE `user`');
    }
}
