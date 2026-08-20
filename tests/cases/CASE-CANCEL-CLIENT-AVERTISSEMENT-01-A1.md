# CASE-CANCEL-CLIENT-AVERTISSEMENT-01-A1 — Remboursement intégral après avertissement

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03-A1`
**Critères d'acceptation :** `AC-2`, `AC-3`, `AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-AVERTISSEMENT-01`
**Motif :** rembourser intégralement l’acompte encaissé par une action du patron.

## Cas

```gherkin
Étant donné un avertissement envoyé avec succès pour une réservation
Et un acompte de 78 € comme seule somme encaissée
Quand le client annule après cet avertissement
Alors le remboursement calculé est de 78 €
Et le patron peut l’initier
Quand la même confirmation est reçue deux fois
Alors un seul remboursement de 78 € est enregistré
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_AVERTISSEMENT_01_A1_remboursement_acompte`
