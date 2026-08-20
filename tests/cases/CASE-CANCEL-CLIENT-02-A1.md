# CASE-CANCEL-CLIENT-02-A1 — Frais exactement à H-48

**Spécification :** `SPEC-CANCEL-CLIENT-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-2`, `AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-02`
**Motif :** fixer la frontière exacte H-48 à 25 % de frais.

## Cas

```gherkin
Étant donné une réservation de montant initial 260 € avec 78 € encaissés
Quand le client annule exactement 48 heures avant le départ
Alors les frais dus sont de 65 €
Et le trop-perçu est de 13 €
Et le patron peut initier un remboursement de 13 €
```

## Résultat attendu

Frais : `260 € × 25 % = 65 €`. Trop-perçu : `78 € − 65 € = 13 €`.

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_02_A1_frontiere_h48`
