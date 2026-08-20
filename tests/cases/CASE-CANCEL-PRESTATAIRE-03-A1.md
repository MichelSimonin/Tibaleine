# CASE-CANCEL-PRESTATAIRE-03-A1 — Remboursement intégral après annulation du prestataire

**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02-A1`
**Critères d'acceptation :** `AC-2`, `AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-PRESTATAIRE-03`
**Motif :** corriger le périmètre vers une annulation initiée par le prestataire.

## Cas

```gherkin
Étant donné une sortie annulée par le prestataire
Et un client ayant choisi le remboursement
Et 260 € effectivement encaissés pour sa réservation
Quand le patron initie le remboursement
Et que la même confirmation est reçue deux fois
Alors un seul remboursement de 260 € est enregistré
Et aucun report n’est créé
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_PRESTATAIRE_03_A1_remboursement_unique`
