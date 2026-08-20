# Plan de délégation — `SPEC-FACT-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-FACT-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Adapter l'émission de facture afin qu'elle ne marque aucun règlement | `CASE-FACT-01-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseFact01Test.php`, service de facturation | enregistrement du règlement |
| 2 | Refuser la génération d'une facture mensuelle pour un client ordinaire | `CASE-FACT-04` | spec A1, CASE correspondant, service de facturation et entité utilisateur | facturation des hôtels |
| 3 | Automatiser l'enregistrement unique du règlement intégral d'une facture hôtel | `CASE-FACT-05` | spec A1, CASE correspondant, services facturation et paiement | émission ou recalcul de la facture |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |
| 3 | | |

## Ce qui sera regardé

Émettre une facture et enregistrer son règlement sont deux opérations distinctes.
Seule la seconde peut produire le statut `intégralement payé`.
