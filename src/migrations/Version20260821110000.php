<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260821110000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Transforme les sorties en disponibilités bateau affectées dynamiquement et garantit l’exclusivité des privatisations.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sortie ALTER type DROP NOT NULL');
        $this->addSql(<<<'SQL'
CREATE OR REPLACE FUNCTION verifier_creneau_baleine() RETURNS trigger AS $$
BEGIN
    IF NEW.type IS NOT NULL THEN
        PERFORM pg_advisory_xact_lock(hashtextextended(NEW.date::text || NEW.heure_depart::text, 0));
    END IF;
    IF NEW.type = 'baleine' AND EXISTS (
        SELECT 1 FROM sortie s
        WHERE s.type = 'baleine' AND s.date = NEW.date AND s.heure_depart = NEW.heure_depart
          AND s.id <> COALESCE(NEW.id, 0)
    ) THEN
        RAISE EXCEPTION 'Une seule sortie baleine est autorisée par créneau.';
    END IF;
    IF NEW.type = 'privatisation' AND EXISTS (
        SELECT 1 FROM sortie s
        WHERE s.type IS NOT NULL AND s.date = NEW.date AND s.heure_depart = NEW.heure_depart
          AND s.id <> COALESCE(NEW.id, 0)
    ) THEN
        RAISE EXCEPTION 'Une privatisation doit être seule sur son créneau.';
    END IF;
    IF NEW.type IN ('baleine', 'dauphin') AND EXISTS (
        SELECT 1 FROM sortie s
        WHERE s.type = 'privatisation' AND s.date = NEW.date AND s.heure_depart = NEW.heure_depart
          AND s.id <> COALESCE(NEW.id, 0)
    ) THEN
        RAISE EXCEPTION 'Ce créneau est réservé à une privatisation.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql
SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
CREATE OR REPLACE FUNCTION verifier_creneau_baleine() RETURNS trigger AS $$
BEGIN
    IF NEW.type = 'baleine' THEN
        PERFORM pg_advisory_xact_lock(hashtextextended(NEW.date::text || NEW.heure_depart::text, 0));
        IF EXISTS (SELECT 1 FROM sortie s WHERE s.type = 'baleine' AND s.date = NEW.date AND s.heure_depart = NEW.heure_depart AND s.id <> COALESCE(NEW.id, 0)) THEN
            RAISE EXCEPTION 'Une seule sortie baleine est autorisée par créneau.';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql
SQL);
        $this->addSql("UPDATE sortie SET type = 'dauphin' WHERE type IS NULL");
        $this->addSql('ALTER TABLE sortie ALTER type SET NOT NULL');
    }
}
