# Plan de délégation — `SPEC-CANCEL-CLIENT-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-CANCEL-CLIENT-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser les frais à moins de 48 heures et le complément restant dû | `CASE-CANCEL-CLIENT-01-A1` | `SPEC-CANCEL-CLIENT-01-A1`, `CASE-CANCEL-CLIENT-01-A1`, `tests/phpunit/CaseCancelClient01Test.php`, services d'annulation et paiement | annulation par le prestataire |
| 2 | Automatiser précisément la frontière H-48 à 25 % | `CASE-CANCEL-CLIENT-02-A1` | `SPEC-CANCEL-CLIENT-01-A1`, `CASE-CANCEL-CLIENT-02-A1`, `tests/phpunit/CaseCancelClient02Test.php` | autres tranches temporelles |
| 3 | Automatiser le remboursement des sommes encaissées et son unicité | `CASE-CANCEL-CLIENT-03-A1` | `SPEC-CANCEL-CLIENT-01-A1`, `CASE-CANCEL-CLIENT-03-A1`, `tests/phpunit/CaseCancelClient03Test.php`, entités paiement et remboursement | remboursement après avertissement |
| 4 | Automatiser l'absence sans remboursement | `CASE-CANCEL-CLIENT-04` | `SPEC-CANCEL-CLIENT-01-A1`, `CASE-CANCEL-CLIENT-04`, service d'annulation | barème d'une annulation formelle |
| 5 | Refuser une nouvelle annulation dans un état terminal ou après le départ | `CASE-CANCEL-CLIENT-05` | `SPEC-CANCEL-CLIENT-01-A1`, `CASE-CANCEL-CLIENT-05`, entité réservation et service d'annulation | modification et report de réservation |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |
| 3 | | |
| 4 | | |
| 5 | | |

## Ce qui sera regardé

Les frais sont calculés sur le montant initial. Les sommes encaissées sont
ensuite déduites et toute opération financière doit rester idempotente.
