# CASE-SYST-05 — Confirmation invalide ou absente sans encaissement

**Spécification :** `SPEC-SYST-01-A1`
**Critères d'acceptation :** `AC-2`, `AC-4`
**Statut :** applicable

## Cas

```gherkin
Plan du scénario: opération sans confirmation valide
Étant donné une tentative de paiement <confirmation>
Quand le système détermine son résultat
Alors aucun encaissement confirmé n’est enregistré
Et aucun statut de paiement payé n’est appliqué

Exemples:
| confirmation |
| invalide |
| absente |
```

## Test automatisé

**Nom attendu :** `test_CASE_SYST_05_confirmation_invalide_absente`
