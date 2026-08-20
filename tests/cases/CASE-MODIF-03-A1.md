# CASE-MODIF-03-A1 — Ajout intégré au solde restant

**Spécification :** `SPEC-MODIF-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-2`, `AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-MODIF-03`
**Motif :** supprimer le lien immédiat de supplément et intégrer la différence au solde.

## Cas

```gherkin
Étant donné une réservation de montant courant 260 € avec un acompte payé de 78 €
Quand le patron ajoute un participant portant le montant courant à 325 €
Alors le montant initial reste inchangé
Et l’acompte reste 78 €
Et le solde restant devient 247 €
Et aucun complément d’acompte ni lien de paiement immédiat séparé n’est créé
```

## Résultat attendu

Solde : `325 € − 78 € = 247 €`.

## Test automatisé

**Nom attendu :** `test_CASE_MODIF_03_A1_ajout_augmente_solde`
