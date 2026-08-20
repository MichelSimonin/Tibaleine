# Plan de délégation — `SPEC-CANCEL-PRESTATAIRE-02-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** réalisé — tests automatisés verts
**Plan historique associé :** `delegation-SPEC-CANCEL-PRESTATAIRE-02.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser le choix exclusif entre remboursement et report | `CASE-CANCEL-PRESTATAIRE-02-A1` | spec A1, CASE correspondant, ancien test 02, service d'annulation | décision à la place du client |
| 2 | Automatiser le remboursement de toutes les sommes encaissées et son unicité | `CASE-CANCEL-PRESTATAIRE-03-A1` | spec A1, CASE correspondant, ancien test 03, entités paiement et remboursement | annulation volontaire du client |
| 3 | Automatiser le report accepté sans remboursement et avec conservation des paiements | `CASE-CANCEL-PRESTATAIRE-04` | spec A1, CASE correspondant, services d'annulation et réservation | recalcul de l'acompte ou du statut financier |
| 4 | Vérifier l'exclusion d'une réservation hôtel annulée de la facture | `CASE-FACT-03` | spec A1, `CASE-FACT-03`, `tests/phpunit/CaseFact03Test.php`, service de facturation | autres lignes de la facture mensuelle |

## Après — ce qui s'est passé

Complété le 20 août 2026 après exécution de `bash tools/run-tests.sh`.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Test automatisé vert dans la suite complète. |
| 2 | `conforme` | Test automatisé vert dans la suite complète. |
| 3 | `conforme` | Test automatisé vert dans la suite complète. |
| 4 | `conforme` | Test automatisé vert dans la suite complète. |

## Ce qui sera regardé

Le choix du client doit être explicite et exclusif. Un report conserve les
sommes encaissées ; un remboursement ne doit être confirmé qu'une fois.
