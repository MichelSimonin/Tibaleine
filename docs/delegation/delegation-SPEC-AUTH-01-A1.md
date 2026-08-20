# Plan de délégation — `SPEC-AUTH-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** réalisé — tests automatisés verts
**Plan historique associé :** `delegation-SPEC-AUTH-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser l'authentification commune d'un utilisateur `hotel`, sans profil séparé | `CASE-AUTH-10` | `SPEC-AUTH-01-A1`, `CASE-AUTH-10`, `tests/phpunit/CaseAuth01Test.php`, `tests/service/CompteService.php`, `tests/entite_test/Utilisateur.php` | specs et CASE en lecture seule ; droits des autres rôles |
| 2 | Automatiser la visibilité limitée des réservations et le refus des fonctions privilégiées | `CASE-HOTEL-03-A1` | `SPEC-AUTH-01-A1`, `CASE-HOTEL-03-A1`, `tests/phpunit/CaseHotel03Test.php`, `tests/service/AutorisationService.php` | réservation hôtel et facturation |

## Après — ce qui s'est passé

Complété le 20 août 2026 après exécution de `bash tools/run-tests.sh`.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Test automatisé vert dans la suite complète. |
| 2 | `conforme` | Test automatisé vert dans la suite complète. |

## Ce qui sera regardé

Chaque test doit utiliser le rôle `hotel` sur un utilisateur existant, sans
introduire de compte, profil ou mécanisme d'authentification séparé.
