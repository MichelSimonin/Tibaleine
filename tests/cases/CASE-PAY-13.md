# CASE-PAY-13 — Solde impayé et embarquement refusé

**Spécification :** `SPEC-PAY-BALANCE-02`
**Critère d'acceptation :** `AC-6`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation dont seul l’acompte est payé
Et un solde exigible non réglé en ligne ni sur place
Quand le client se présente pour embarquer
Alors l’embarquement est refusé
Et la réservation passe à l’état « annulée »
Et le statut ne devient pas « intégralement payé »
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_13_solde_impaye_embarquement_refuse`
