# CASE-PAY-03-A1 — Confirmation répétée sans nouveau décompte

**Spécification :** `SPEC-PAY-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-2`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-PAY-03`
**Motif :** rendre le paiement et l’acquisition des places idempotents.

## Cas

```gherkin
Étant donné un créneau avec quatre places et un acompte confirmé pour deux places
Quand la même référence externe est confirmée une seconde fois
Alors un seul paiement existe
Et le créneau conserve deux places restantes
Et la réservation des deux places n’est pas appliquée une seconde fois
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_03_A1_confirmation_repetee_sans_redecompte`
