# CASE-PAY-05-A1 — Échec d’acompte sans réservation confirmée

**Spécifications :** `SPEC-PAY-01-A1`, `SPEC-SYST-01-A1`
**Critères d'acceptation :** `SPEC-PAY-01-A1/AC-3`, `SPEC-SYST-01-A1/AC-2`, `SPEC-SYST-01-A1/AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-PAY-05`
**Motif :** un acompte échoué, invalide ou non confirmé ne confirme aucune réservation.

## Cas

```gherkin
Étant donné une demande dont l’acompte n’a aucune confirmation valide
Quand le paiement échoue ou que sa confirmation est rejetée
Alors aucun paiement confirmé n’est enregistré
Et la réservation ne passe pas à l’état « réservée »
Et le statut ne devient pas « acompte payé »
Et les places ne sont pas définitivement acquises
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_05_A1_echec_acompte_sans_reservation`
