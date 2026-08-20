# CASE-FACT-05 — Règlement hôtel enregistré une seule fois

**Spécification :** `SPEC-FACT-01-A1`
**Critères d'acceptation :** `AC-4`, `AC-5`
**Statut :** applicable

## Cas

```gherkin
Étant donné une facture mensuelle hôtel intégralement réglée
Et une confirmation portant une référence externe unique
Quand cette confirmation est reçue deux fois
Alors un seul paiement est enregistré
Et les réservations couvertes passent une seule fois au statut « intégralement payé »
```

## Test automatisé

**Nom attendu :** `test_CASE_FACT_05_reglement_hotel_unique`
