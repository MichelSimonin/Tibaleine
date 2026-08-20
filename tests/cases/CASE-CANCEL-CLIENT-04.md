# CASE-CANCEL-CLIENT-04 — Absence sans remboursement

**Spécification :** `SPEC-CANCEL-CLIENT-01-A1`
**Critère d'acceptation :** `AC-7`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation active dont le client ne demande pas l’annulation
Quand le client ne se présente pas au départ
Alors aucun remboursement n’est calculé ni initié
Et l’absence n’est pas transformée en annulation ouvrant droit à remboursement
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_04_absence_sans_remboursement`
