# Plan de délégation — `SPEC-HOTEL-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-HOTEL-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Remplacer l'ancien compte hôtel par un utilisateur portant le rôle `hotel` | `CASE-HOTEL-01-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseHotel01Test.php`, entité utilisateur et service de réservation | création d'une entité ou d'un profil hôtel |
| 2 | Adapter la consultation d'un hôtel à ses seules réservations | `CASE-HOTEL-03-A1` | spec A1, CASE correspondant, `tests/phpunit/CaseHotel03Test.php`, service de consultation | droits patron et employé |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |

## Ce qui sera regardé

Aucun test ne doit créer une table, une entité, un profil ou un second compte
hôtel. L'identification repose uniquement sur le rôle de l'utilisateur.
