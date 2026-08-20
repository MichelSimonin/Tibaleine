# CASE-BOOK-04-A1 — Places acquises après confirmation de l’acompte

**Spécifications :** `SPEC-BOOK-01`, `SPEC-BOOK-03-A1`
**Critères d'acceptation :** `SPEC-BOOK-01/AC-4`, `SPEC-BOOK-03-A1/AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-04`
**Motif :** les places deviennent définitives après l’acompte, pas après un paiement intégral.

## Cas

```gherkin
Étant donné un créneau avec six places disponibles
Et une demande portant sur cinq places
Quand le paiement de l’acompte est confirmé
Alors la réservation devient « réservée » avec le statut « acompte payé »
Et il reste une place disponible
Et ces cinq places ne sont plus seulement bloquées temporairement
```

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_04_A1_places_acquises_apres_acompte`
