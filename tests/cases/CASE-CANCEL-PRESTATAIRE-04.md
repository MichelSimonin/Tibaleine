# CASE-CANCEL-PRESTATAIRE-04 — Report accepté sans remboursement

**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02-A1`
**Critères d'acceptation :** `AC-4`, `AC-5`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation annulée à la suite de l’annulation d’une sortie
Et un client qui accepte un nouveau créneau proposé
Quand le patron enregistre ce report
Alors la réservation revient à l’état « réservée » sur le nouveau créneau
Et les sommes encaissées sont conservées
Et le statut de paiement est conservé
Et aucun remboursement n’est initié
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_PRESTATAIRE_04_report_sans_remboursement`
