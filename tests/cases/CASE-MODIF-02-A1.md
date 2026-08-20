# CASE-MODIF-02-A1 — Montants initial et courant après modification

**Spécification :** `SPEC-MODIF-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-2`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-MODIF-02`
**Motif :** conserver le montant initial et l’acompte malgré la modification.

## Cas

```gherkin
Étant donné une réservation « réservée » de montant initial 260 €
Et un acompte déjà payé de 78 €
Quand le patron enregistre une modification portant le montant courant à 325 €
Alors le montant initial reste 260 €
Et le montant courant devient 325 €
Et l’acompte reste 78 €
```

## Test automatisé

**Nom attendu :** `test_CASE_MODIF_02_A1_montants_initial_courant`
