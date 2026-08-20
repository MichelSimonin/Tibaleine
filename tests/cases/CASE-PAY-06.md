# CASE-PAY-06 — Acompte standard de 30 %

**Spécification :** `SPEC-PAY-01`
**Critère d'acceptation :** `AC-2`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation standard d’un montant TTC de 260 €
Quand le système calcule l’acompte
Alors l’acompte demandé est de 78 €
Et le solde restant est de 182 €
```

## Résultat attendu

`260 € × 30 % = 78 €`.

## Test automatisé

**Nom attendu :** `test_CASE_PAY_06_acompte_standard_30_pourcent`
