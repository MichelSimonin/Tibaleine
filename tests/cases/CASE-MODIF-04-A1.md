# CASE-MODIF-04-A1 — Suppression et remboursement du trop-perçu

**Spécification :** `SPEC-MODIF-01-A1`
**Critères d'acceptation :** `AC-4`, `AC-5`, `AC-6`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-MODIF-04`
**Motif :** recalculer le solde sans valeur négative et rembourser uniquement le trop-perçu.

## Cas

```gherkin
Étant donné une réservation dont le montant courant est de 260 €
Et 200 € déjà encaissés
Quand le patron supprime un participant et ramène le montant courant à 160 €
Alors le solde restant est de 0 €
Et un trop-perçu de 40 € est identifié
Et le patron peut initier son remboursement
Quand la même confirmation est reçue deux fois
Alors un seul remboursement de 40 € est enregistré
```

## Test automatisé

**Nom attendu :** `test_CASE_MODIF_04_A1_suppression_trop_percu`
