# CASE-PAY-04-A1 — Confirmation d’une tentative initiée avant expiration

**Spécification :** `SPEC-BOOK-03-A1`
**Critères d'acceptation :** `AC-4`, `AC-5`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-PAY-04`
**Motif :** autoriser une seule confirmation tardive d’une tentative déjà commencée.

## Cas

```gherkin
Étant donné une tentative d’acompte initiée avant l’expiration du délai de paiement
Et une confirmation reçue après cette expiration
Quand le système traite cette confirmation
Alors la confirmation peut être appliquée une seule fois
Et aucune nouvelle tentative ne peut être initiée sur la réservation expirée
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_04_A1_confirmation_apres_expiration`
