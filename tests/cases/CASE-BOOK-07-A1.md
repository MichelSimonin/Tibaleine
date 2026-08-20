# CASE-BOOK-07-A1 — Tentative commencée avant l’expiration

**Spécification :** `SPEC-BOOK-03-A1`
**Critères d'acceptation :** `AC-2`, `AC-4`, `AC-5`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-07`
**Motif :** distinguer une nouvelle tentative d’une tentative commencée avant l’expiration.

## Cas

```gherkin
Étant donné une demande de réservation dont le premier délai n’est pas expiré
Quand le client accède au paiement de l’acompte
Alors un second délai de 15 minutes commence
Et une tentative de paiement est commencée avant la fin de ce second délai
Quand la confirmation de cette tentative arrive après l’expiration du délai
Alors cette tentative peut être confirmée une seule fois
Et la réservation devient « réservée »
Quand le client tente ensuite de démarrer un nouveau paiement avec la réservation expirée
Alors cette nouvelle tentative est refusée
```

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_07_A1_tentative_commencee_avant_expiration`
