# Plan de délégation — `SPEC-PAY-BALANCE-02-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** aucun plan antérieur

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser le lien du solde, sa fenêtre H-24/H-12 et la confirmation tardive d'une tentative déjà commencée | `CASE-PAY-09` | specs PAY-BALANCE base et A1, CASE correspondant, service de paiement | acompte initial |
| 2 | Automatiser une réservation créée entre H-24 et H-12 | `CASE-PAY-10` | spec PAY-BALANCE, CASE correspondant, service de paiement | réservation créée avant H-24 |
| 3 | Automatiser une réservation créée à moins de H-12 avec solde sur place | `CASE-PAY-11` | spec PAY-BALANCE, CASE correspondant, services réservation et paiement | nouvelle tentative en ligne après H-12 |
| 4 | Automatiser le paiement sur place, ses exclusions et le statut intégralement payé | `CASE-PAY-12` | specs PAY-BALANCE base et A1, CASE correspondant, service de paiement | acompte sur place |
| 5 | Refuser l'embarquement lorsque le solde reste impayé | `CASE-PAY-13` | spec PAY-BALANCE, CASE correspondant, services paiement et réservation | politique d'annulation client |

L'unicité transverse de la référence externe est déléguée avec `CASE-SYST-04`
dans `delegation-SPEC-SYST-01-A1.md`.

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

Une tentative commencée avant H-12 peut être confirmée après H-12, mais aucune
nouvelle tentative ne peut commencer après cette limite.
