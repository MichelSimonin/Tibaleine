<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260821080000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Garantit en base l’unicité des créneaux baleine et des tarifs sans perturber la comparaison Doctrine.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX IF EXISTS uniq_sortie_baleine_creneau');
        $this->addSql('DROP INDEX IF EXISTS uniq_tarif_collectif');
        $this->addSql('DROP INDEX IF EXISTS uniq_tarif_privatisation');
        $this->addSql('ALTER TABLE utilisateur ALTER langue DROP DEFAULT');
        $this->addSql('ALTER TABLE notification ALTER statut DROP DEFAULT');
        $this->addSql('DROP TRIGGER IF EXISTS trg_sortie_baleine_unique ON sortie');
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
        $this->addSql('CREATE TRIGGER trg_sortie_baleine_unique BEFORE INSERT OR UPDATE ON sortie FOR EACH ROW EXECUTE FUNCTION verifier_creneau_baleine()');
        $this->addSql('DROP TRIGGER IF EXISTS trg_tarif_unique ON tarif');
        $this->addSql(<<<'SQL'
CREATE OR REPLACE FUNCTION verifier_tarif_unique() RETURNS trigger AS $$
BEGIN
    PERFORM pg_advisory_xact_lock(hashtextextended(NEW.type_sortie || COALESCE(NEW.categorie, '') || COALESCE(NEW.bateau_id::text, ''), 0));
    IF NEW.bateau_id IS NULL AND EXISTS (SELECT 1 FROM tarif t WHERE t.type_sortie = NEW.type_sortie AND t.categorie = NEW.categorie AND t.bateau_id IS NULL AND t.id <> COALESCE(NEW.id, 0)) THEN
        RAISE EXCEPTION 'Un tarif collectif existe déjà pour ce type et cette catégorie.';
    END IF;
    IF NEW.categorie IS NULL AND EXISTS (SELECT 1 FROM tarif t WHERE t.type_sortie = NEW.type_sortie AND t.bateau_id = NEW.bateau_id AND t.categorie IS NULL AND t.id <> COALESCE(NEW.id, 0)) THEN
        RAISE EXCEPTION 'Un tarif de privatisation existe déjà pour ce bateau.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql
SQL);
        $this->addSql('CREATE TRIGGER trg_tarif_unique BEFORE INSERT OR UPDATE ON tarif FOR EACH ROW EXECUTE FUNCTION verifier_tarif_unique()');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER IF EXISTS trg_sortie_baleine_unique ON sortie');
        $this->addSql('DROP FUNCTION IF EXISTS verifier_creneau_baleine()');
        $this->addSql('DROP TRIGGER IF EXISTS trg_tarif_unique ON tarif');
        $this->addSql('DROP FUNCTION IF EXISTS verifier_tarif_unique()');
        $this->addSql("CREATE UNIQUE INDEX uniq_sortie_baleine_creneau ON sortie (date, heure_depart) WHERE type = 'baleine'");
        $this->addSql('CREATE UNIQUE INDEX uniq_tarif_collectif ON tarif (type_sortie, categorie) WHERE bateau_id IS NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_tarif_privatisation ON tarif (type_sortie, bateau_id) WHERE categorie IS NULL');
    }
}
