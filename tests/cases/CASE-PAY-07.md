# CASE-PAY-07 — Acompte de privatisation de 50 %

**Spécification :** `SPEC-PAY-01`
**Critère d'acceptation :** `AC-2`
**Statut :** applicable

## Cas

```gherkin
Étant donné une privatisation d’un montant TTC de 600 € demandée par un client ordinaire
Quand le système calcule l’acompte
Alors l’acompte demandé est de 300 €
Et le solde restant est de 300 €
```

## Résultat attendu

`600 € × 50 % = 300 €`.

## Test automatisé

**Nom attendu :** `test_CASE_PAY_07_acompte_privatisation_50_pourcent`
