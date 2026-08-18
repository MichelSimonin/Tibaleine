# Plan de délégation — `SPEC-CONS-01`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas où le client ne voit que ses propres réservations | `CASE-CONS-01` | `SPEC-CONS-01`, gabarit CASE | `SPEC-AUTH-01` |
| 2 | Écrire le cas où l'employé voit toutes les réservations en lecture seule | `CASE-CONS-02` | `SPEC-CONS-01` | `SPEC-AUTH-01` |
| 3 | Écrire le cas où l'administrateur voit toutes les réservations avec actions de gestion | `CASE-CONS-03` | `SPEC-CONS-01` | `SPEC-CANCEL-*`, `SPEC-MODIF-01` |
| 4 | Écrire le cas où un client ne peut pas accéder à la réservation d'un autre client | `CASE-CONS-04` | `SPEC-CONS-01` | — |
| 5 | Écrire le cas où une tentative de modification par l'employé est bloquée | `CASE-CONS-05` | `SPEC-CONS-01` | `SPEC-MODIF-01` |
| 6 | Écrire le cas où le client sans réservation voit un message dédié | `CASE-CONS-06` | `SPEC-CONS-01` | — |

**Préalable non listé dans ce découpage** : deux points de la Revue IA de
`SPEC-CONS-01` ont dû être tranchés avant l'écriture des cas 1 et 2 — l'accès
sans mot de passe (résolu par la décision prise sur `SPEC-AUTH-01`, lien
email) et le périmètre de consultation de l'employé (toutes les réservations,
en lecture seule). Un vrai plan de délégation les aurait listés comme tâche 0.

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | — |
| 2 | `conforme` | — |
| 3 | `conforme` | — |
| 4 | `conforme` | — |
| 5 | `conforme` | — |
| 6 | `conforme` | — |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

Pas le nombre de `conforme`. Ce qui se lit, c'est **l'écart entre ce que vous aviez
prévu et ce qui est arrivé, et le fait que vous l'ayez vu**.

Une équipe avec quatre `repris` qui sait dire pourquoi pilote mieux qu'une équipe
avec six `conforme` qui n'a rien observé.
