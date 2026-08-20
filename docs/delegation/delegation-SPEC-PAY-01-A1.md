# Plan de délégation — `SPEC-PAY-01-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-PAY-01.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser l'unicité du paiement et du décompte des places pour une même référence externe | `CASE-PAY-03-A1` | spec A1, CASE correspondant, `tests/phpunit/CasePay03Test.php`, services paiement et réservation | taux de l'acompte |
| 2 | Automatiser l'échec ou l'absence de confirmation sans paiement ni réservation confirmée | `CASE-PAY-05-A1` | spec A1, CASE correspondant, `tests/phpunit/CasePay05Test.php`, service de paiement | paiement du solde |

La couverture de l'exclusion d'acompte pour le rôle `hotel` est déléguée avec
`CASE-BOOK-02-A1` dans `delegation-SPEC-BOOK-02-A1.md`. L'idempotence système
transverse est déléguée avec `CASE-SYST-04` dans le plan `SPEC-SYST-01-A1`.

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |

## Ce qui sera regardé

La comparaison porte sur la référence externe complète. Une répétition doit
retourner le résultat existant sans nouveau paiement ni nouveau décompte.
