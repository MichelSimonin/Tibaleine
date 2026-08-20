# Plan de délégation — `SPEC-JUSTIF-01`

**Date de préparation :** 20 août 2026  
**Version de la spécification :** v1  
**Statut du plan :** prévu — tests automatisés à implémenter  
**Plan historique associé :** aucun plan antérieur

> Les cas de test sont déjà rédigés. Ce plan est établi avant la délégation de
> leur automatisation et ne prétend pas avoir précédé leur rédaction.

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérifier la génération automatique du justificatif d'acompte après confirmation du paiement de l'acompte | `CASE-JUSTIF-01` | `SPEC-JUSTIF-01`, `CASE-JUSTIF-01`, documents de test, entités réservation et paiement, service de génération de document | le paiement du solde, la logique d'annulation, la facturation mensuelle |
| 2 | Vérifier la génération automatique de la facture finale après paiement intégral du solde, quel que soit le canal | `CASE-JUSTIF-02` | `SPEC-JUSTIF-01`, `CASE-JUSTIF-02`, documents de test, service de génération de document, service de paiement, entité réservation | le paiement de l'acompte, le calcul des frais d'annulation, les règles de consultation |

## Après — ce qui s'est passé

À compléter après l'exécution des tâches.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

La lecture centrale porte sur la frontière entre génération documentaire et paiement :
le justificatif suit l'acompte, la facture finale suit le solde, sans création de
pièce supplémentaire tant que la condition de paiement n'est pas atteinte.
