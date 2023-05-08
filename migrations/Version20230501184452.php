<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501184452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campeonato ADD comunidad_autonoma_id INT DEFAULT NULL, ADD tipo TINYINT(1) NOT NULL, CHANGE nº_max_participantes n_max_participantes INT NOT NULL');
        $this->addSql('ALTER TABLE campeonato ADD CONSTRAINT FK_722DB8CA88FED51F FOREIGN KEY (comunidad_autonoma_id) REFERENCES comunidad_autonoma (id)');
        $this->addSql('CREATE INDEX IDX_722DB8CA88FED51F ON campeonato (comunidad_autonoma_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campeonato DROP FOREIGN KEY FK_722DB8CA88FED51F');
        $this->addSql('DROP INDEX IDX_722DB8CA88FED51F ON campeonato');
        $this->addSql('ALTER TABLE campeonato DROP comunidad_autonoma_id, DROP tipo, CHANGE n_max_participantes nº_max_participantes INT NOT NULL');
    }
}
