# Plan de délégation — `SPEC-BOOK-03-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** `delegation-SPEC-BOOK-03.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérifier le premier blocage de quinze minutes à l'ouverture du formulaire | `CASE-BOOK-06` | `SPEC-BOOK-03-A1`, `CASE-BOOK-06`, `tests/phpunit/CaseBook06Test.php`, `tests/service/DisponibiliteService.php` | paiement et notification |
| 2 | Automatiser le second délai, la confirmation tardive autorisée une fois et le refus d'une nouvelle tentative | `CASE-BOOK-07-A1` | `SPEC-BOOK-03-A1`, `CASE-BOOK-07-A1`, `tests/phpunit/CaseBook07Test.php`, services de réservation et paiement | premier délai et facturation hôtel |
| 3 | Vérifier que la confirmation de l'acompte donne l'état `réservée` et le statut `acompte payé` | `CASE-PAY-02-A1` | `SPEC-BOOK-03-A1`, `CASE-PAY-02-A1`, `tests/phpunit/CasePay02Test.php` | calcul du taux de l'acompte |
| 4 | Automatiser l'acquisition définitive des places après confirmation de l'acompte | `CASE-BOOK-04-A1` | `SPEC-BOOK-03-A1`, `CASE-BOOK-04-A1`, `tests/phpunit/CaseBook04Test.php` | notification et paiement du solde |
| 5 | Automatiser la confirmation unique d'une tentative initiée avant expiration | `CASE-PAY-04-A1` | `SPEC-BOOK-03-A1`, `CASE-PAY-04-A1`, `tests/phpunit/CasePay04Test.php` | nouvelles tentatives après expiration |
| 6 | Automatiser la concurrence sur la dernière place | `CASE-BOOK-09` | `SPEC-BOOK-03-A1`, `CASE-BOOK-09`, services de disponibilité et réservation | file d'attente non prévue par la spec |
| 7 | Adapter la notification du patron au passage à l'état `réservée` après confirmation de l'acompte | `CASE-BOOK-08-A1` | `SPEC-BOOK-03-A1`, `CASE-BOOK-08-A1`, `tests/phpunit/CaseBook08Test.php`, service de notification | contenu du mail client et paiement du solde |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |
| 3 | | |
| 4 | | |
| 5 | | |
| 6 | | |
| 7 | | |

## Ce qui sera regardé

Les deux délais doivent rester distincts. Une confirmation tardive d'une
tentative déjà commencée ne doit jamais autoriser une seconde réservation.
