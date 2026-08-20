# CASE-FACT-01-A1 — Émission d’une facture hôtel sans règlement

**Spécification :** `SPEC-FACT-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-FACT-01`
**Motif :** distinguer l’émission de la facture de son règlement.

## Cas

```gherkin
Étant donné deux réservations facturables du même hôtel pour le même mois
Quand la facture mensuelle est émise
Alors elle regroupe uniquement ces réservations
Et leur statut de paiement reste « en attente de paiement »
Et aucun paiement n’est enregistré par la seule émission de la facture
```

## Test automatisé

**Nom attendu :** `test_CASE_FACT_01_A1_emission_sans_reglement`
