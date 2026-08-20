# CASE-SYST-04 — Confirmation financière répétée sans doublon

**Spécifications :** `SPEC-SYST-01-A1`, `SPEC-PAY-01-A1`, `SPEC-PAY-BALANCE-02-A1`
**Critères d'acceptation :** `SPEC-SYST-01-A1/AC-1`, `AC-3`; `SPEC-PAY-01-A1/AC-1`; `SPEC-PAY-BALANCE-02-A1/AC-1`
**Statut :** applicable

## Cas

```gherkin
Plan du scénario: confirmation répétée d’une opération financière
Étant donné une opération de type <type> confirmée avec la référence externe REF-001
Quand la confirmation REF-001 est reçue de nouveau
Alors aucune seconde opération financière n’est enregistrée
Et le résultat déjà enregistré est retourné

Exemples:
| type |
| acompte |
| solde |
| remboursement |
```

## Test automatisé

**Nom attendu :** `test_CASE_SYST_04_confirmation_financiere_idempotente`
