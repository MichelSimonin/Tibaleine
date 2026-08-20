# Plan de délégation — `SPEC-MODIF-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** réalisé — tests automatisés verts
**Plan historique associé :** `delegation-SPEC-MODIF-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Distinguer montant initial et montant courant après modification | `CASE-MODIF-02-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseModif02Test.php`, entité réservation | calcul des frais d'annulation |
| 2 | Intégrer un ajout au solde sans complément d'acompte ni lien immédiat séparé | `CASE-MODIF-03-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseModif03Test.php`, services réservation et paiement | paiement immédiat du supplément |
| 3 | Recalculer une suppression et enregistrer une seule fois le remboursement du trop-perçu | `CASE-MODIF-04-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseModif04Test.php`, entités paiement et remboursement | recalcul de l'acompte |
| 4 | Refuser une modification hors capacité ou délai | `CASE-MODIF-06` | spec A1, CASE correspondant, services réservation et disponibilité | règles d'annulation |

## Après — ce qui s'est passé

Complété le 20 août 2026 après exécution de `bash tools/run-tests.sh`.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Test automatisé vert dans la suite complète. |
| 2 | `conforme` | Test automatisé vert dans la suite complète. |
| 3 | `conforme` | Test automatisé vert dans la suite complète. |
| 4 | `conforme` | Test automatisé vert dans la suite complète. |

## Ce qui sera regardé

Le montant initial et l'acompte restent inchangés. Aucun ancien comportement de
supplément immédiat ne doit subsister dans les nouveaux tests.
