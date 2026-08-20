# Plan de délégation — `SPEC-FACT-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** réalisé — tests automatisés verts
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

Complété le 20 août 2026 après exécution de `bash tools/run-tests.sh`.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Test automatisé vert dans la suite complète. |
| 2 | `conforme` | Test automatisé vert dans la suite complète. |
| 3 | `conforme` | Test automatisé vert dans la suite complète. |

## Ce qui sera regardé

Émettre une facture et enregistrer son règlement sont deux opérations distinctes.
Seule la seconde peut produire le statut `intégralement payé`.
