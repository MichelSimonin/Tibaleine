# CASE-BOOK-08-A1 — Notification du patron après l’acompte

**Spécifications :** `SPEC-BOOK-01`, `SPEC-BOOK-03-A1`
**Critères d'acceptation :** `SPEC-BOOK-01/AC-3`, `SPEC-BOOK-03-A1/AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-08`
**Motif :** notifier après passage à « réservée » et « acompte payé ».

## Cas

```gherkin
Étant donné une demande de réservation dont l’acompte n’est pas encore confirmé
Quand l’acompte est confirmé
Alors la réservation passe à l’état « réservée »
Et son statut de paiement devient « acompte payé »
Et le patron reçoit une seule notification concernant cette réservation
```

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_08_A1_notification_patron_apres_acompte`
