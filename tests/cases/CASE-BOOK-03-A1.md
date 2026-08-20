# CASE-BOOK-03-A1 — Email après confirmation de l’acompte

**Spécifications :** `SPEC-BOOK-01`, `SPEC-PAY-01`
**Critères d'acceptation :** `SPEC-BOOK-01/AC-2`, `SPEC-PAY-01/AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-03`
**Motif :** remplacer le paiement intégral de 300 € par la confirmation de l’acompte.

## Cas

```gherkin
Étant donné une demande de réservation valide d’un montant de 300 €
Quand l’acompte attendu est confirmé
Alors la réservation passe à l’état « réservée »
Et son statut de paiement devient « acompte payé »
Et un email récapitulatif est envoyé au client
```

## Résultat attendu

L’email n’est envoyé qu’après confirmation de l’acompte, sans exiger le règlement des 300 €.

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_03_A1_email_apres_acompte`
