# CASE-CANCEL-CLIENT-01-A1 — Complément dû pour une annulation à moins de 48 heures

**Spécification :** `SPEC-CANCEL-CLIENT-01-A1`
**Critères d'acceptation :** `AC-2`, `AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-01`
**Motif :** calculer les frais sur le montant initial et déduire l’acompte encaissé.

## Cas

```gherkin
Étant donné une réservation de montant initial 260 €
Et un acompte encaissé de 78 €
Quand le client annule moins de 48 heures avant le départ
Alors les frais dus sont de 130 €
Et le complément restant dû est de 52 €
Et un lien de paiement valable 24 heures est créé
Et après expiration du lien le complément reste payable sur place
Et la réservation passe à l’état « annulée »
```

## Résultat attendu

Frais : `260 € × 50 % = 130 €`. Complément : `130 € − 78 € = 52 €`.

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_01_A1_complement_moins_48h`
