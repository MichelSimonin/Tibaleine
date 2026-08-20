# CASE-PAY-02-A1 — État réservé et statut acompte payé

**Spécifications :** `SPEC-PAY-01`, `SPEC-BOOK-03-A1`
**Critères d'acceptation :** `SPEC-PAY-01/AC-3`, `SPEC-BOOK-03-A1/AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-PAY-02`
**Motif :** remplacer l’état « payée » par un état et un statut distincts.

## Cas

```gherkin
Étant donné une demande de réservation en attente de confirmation
Quand l’acompte est confirmé
Alors l’état de la réservation devient « réservée »
Et le statut de paiement devient « acompte payé »
Et aucune valeur « payée » n’est utilisée comme état de réservation
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_02_A1_etat_et_statut_separes`
