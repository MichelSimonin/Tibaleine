# Plan de délégation — `SPEC-BOOK-02-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-BOOK-02.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Adapter le test de réservation hôtel : état immédiat, paiement en attente, sans acompte ni validation manuelle | `CASE-BOOK-02-A1` | `SPEC-BOOK-02-A1`, `CASE-BOOK-02-A1`, `tests/phpunit/CaseBook02Test.php`, `tests/service/ReservationService.php` | facturation mensuelle et réservation client ordinaire |
| 2 | Conserver la limite de six participants avec le rôle `hotel` | `CASE-BOOK-05` | `SPEC-BOOK-02-A1`, `CASE-BOOK-05`, `tests/phpunit/CaseBook05Test.php` | règles d'acompte et de privatisation |
| 3 | Automatiser le refus d'une privatisation demandée par un hôtel | `CASE-BOOK-10` | `SPEC-BOOK-02-A1`, `CASE-BOOK-10`, `tests/service/ReservationService.php` | réservations standard des clients ordinaires |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |
| 3 | | |

## Ce qui sera regardé

Les tests doivent distinguer l'état de réservation du statut de paiement et ne
doivent créer ni acompte ni profil hôtel séparé.
