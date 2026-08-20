# Plan de délégation — `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03-A1`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** A1  
**Statut du plan :** réalisé — tests automatisés verts
**Plan historique associé :** `delegation-SPEC-CANCEL-CLIENT-AVERTISSEMENT-03.md`

> Les cas sont déjà rédigés. Ce plan est établi avant la délégation de leur
> automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Automatiser le remboursement intégral après un avertissement envoyé avec succès | `CASE-CANCEL-CLIENT-AVERTISSEMENT-01-A1` | spec A1, CASE correspondant, ancien test 01, services notification et remboursement | annulation sans avertissement |
| 2 | Vérifier que le maintien ultérieur de la sortie ne réactive pas la réservation | `CASE-CANCEL-CLIENT-AVERTISSEMENT-03-A1` | spec A1, CASE correspondant, ancien test 03, entités réservation et sortie | création d'une nouvelle réservation |
| 3 | Enregistrer une trace d'envoi réussi sans exiger de preuve de lecture ou de réception | `CASE-CANCEL-CLIENT-AVERTISSEMENT-04-A1` | spec A1, CASE correspondant, ancien test 04, service de notification | contenu bilingue et transport SMS/mail |
| 4 | Conserver le barème classique lorsqu'aucun avertissement n'a été envoyé | `CASE-CANCEL-CLIENT-AVERTISSEMENT-02` | specs d'annulation client et avertissement A1, CASE correspondant, ancien test 02 | annulation postérieure à un avertissement réussi |

## Après — ce qui s'est passé

Complété le 20 août 2026 après exécution de `bash tools/run-tests.sh`.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Test automatisé vert dans la suite complète. |
| 2 | `conforme` | Test automatisé vert dans la suite complète. |
| 3 | `conforme` | Test automatisé vert dans la suite complète. |
| 4 | `conforme` | Test automatisé vert dans la suite complète. |

## Ce qui sera regardé

Une trace d'envoi réussi suffit. Aucun test ne doit inventer un accusé de lecture
ou une preuve de réception opérateur.
