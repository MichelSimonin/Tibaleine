# CASE-JUSTIF-01 — Justificatif après paiement de l’acompte

**Spécification :** `SPEC-JUSTIF-01`
**Critères d'acceptation :** `AC-1`, `AC-3`, `AC-4`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation dont l’acompte vient d’être confirmé
Et dont le solde n’est pas intégralement réglé
Quand le paiement de l’acompte est enregistré
Alors un justificatif d’acompte est généré et mis à disposition du client
Et aucune facture finale n’est générée
```

## Test automatisé

**Nom attendu :** `test_CASE_JUSTIF_01_justificatif_apres_acompte`
