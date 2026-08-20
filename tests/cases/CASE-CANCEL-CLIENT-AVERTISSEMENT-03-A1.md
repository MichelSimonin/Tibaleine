# CASE-CANCEL-CLIENT-AVERTISSEMENT-03-A1 — Sortie maintenue sans réactivation

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03-A1`
**Critère d'acceptation :** `AC-5`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-AVERTISSEMENT-03`
**Motif :** conserver l’annulation lorsque la sortie est finalement maintenue.

## Cas

```gherkin
Étant donné un client ayant annulé après un avertissement
Et sa réservation à l’état « annulée »
Quand le prestataire décide finalement de maintenir la sortie
Alors la réservation reste « annulée »
Et elle n’est pas réactivée automatiquement
Et une nouvelle réservation est nécessaire pour participer
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_AVERTISSEMENT_03_A1_sortie_maintenue`
