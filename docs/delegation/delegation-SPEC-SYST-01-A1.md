# Plan de délégation — `SPEC-SYST-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-SYST-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser la répétition d'une confirmation financière sans doublon | `CASE-SYST-04` | spec A1, CASE correspondant, services paiement, réservation et remboursement | règles de calcul des montants |
| 2 | Automatiser une confirmation invalide ou absente sans encaissement confirmé | `CASE-SYST-05` | spec A1, CASE correspondant, service de paiement | comportement d'un paiement valablement confirmé |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |

## Ce qui sera regardé

Les tests doivent couvrir paiement, statut et effets métier. Une même référence
externe ne peut appliquer une opération financière qu'une seule fois.
