# CASE-BOOK-01-A1 — Le formulaire conduit au paiement de l’acompte

**Spécifications :** `SPEC-BOOK-01`, `SPEC-PAY-01`
**Critères d'acceptation :** `SPEC-BOOK-01/AC-1`, `SPEC-PAY-01/AC-1`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-01`
**Motif :** la soumission du formulaire ne confirme pas encore la réservation.

## Cas

```gherkin
Étant donné un client qui renseigne un formulaire valide pour un créneau disponible
Quand il soumet le formulaire
Alors les informations sont validées
Et il est dirigé vers le paiement de l’acompte
Et aucune option ne permet de confirmer la réservation sans payer cet acompte
Et la réservation n’est pas encore confirmée à l’état « réservée »
```

## Résultat attendu

Le formulaire ouvre le parcours d’acompte sans confirmer prématurément la réservation ni acquérir définitivement les places.

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_01_A1_formulaire_conduit_au_paiement_acompte`
