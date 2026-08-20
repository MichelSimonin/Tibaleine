# CASE-CONS-01-A1 — Le client voit l’état et le statut de paiement

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** `AC-1`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CONS-01`
**Motif :** afficher séparément l’état métier et le statut financier.

## Cas

```gherkin
Étant donné un client connecté possédant une réservation
Quand il consulte cette réservation
Alors il voit son état « réservée »
Et il voit séparément son statut de paiement « acompte payé »
Et les réservations des autres clients restent invisibles
```

## Test automatisé

**Nom attendu :** `test_CASE_CONS_01_A1_client_voit_etat_statut`
