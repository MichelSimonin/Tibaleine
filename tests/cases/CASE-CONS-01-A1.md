# CASE-CONS-01-A1 — Le client voit l’état et le statut de paiement

**Spécifications :** `SPEC-CONS-01`, `SPEC-PAY-BALANCE-02`
**Critères d'acceptation :** `SPEC-CONS-01/AC-1`, `SPEC-PAY-BALANCE-02/AC-8`
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
