<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260821083828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Mémorise qu’un créneau complet vient de récupérer des places.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sortie ADD nouvelle_place_disponible BOOLEAN DEFAULT FALSE NOT NULL');
        $this->addSql('ALTER TABLE sortie ALTER nouvelle_place_disponible DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sortie DROP nouvelle_place_disponible');
    }
}
