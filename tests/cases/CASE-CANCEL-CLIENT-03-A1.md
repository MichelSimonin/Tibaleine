# CASE-CANCEL-CLIENT-03-A1 — Remboursement des sommes réellement encaissées

**Spécification :** `SPEC-CANCEL-CLIENT-01-A1`
**Critères d'acceptation :** `AC-2`, `AC-3`, `AC-5`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-03`
**Motif :** rembourser l’encaissement réel et confirmer le remboursement une seule fois.

## Cas

```gherkin
Étant donné une réservation de 260 € annulée plus de 7 jours avant le départ
Et un acompte de 78 € effectivement encaissé
Quand le patron initie le remboursement calculé
Et que la même confirmation de remboursement est reçue deux fois
Alors un seul remboursement de 78 € est enregistré
Et la réservation reste à l’état « annulée »
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_03_A1_remboursement_unique`
