# Plan de délégation — `SPEC-MODIF-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de la demande de modification par téléphone | `CASE-MODIF-01` | `SPEC-MODIF-01`, gabarit CASE | — |
| 2 | Écrire le cas de modification appliquée par le patron | `CASE-MODIF-02` | `SPEC-MODIF-01` | — |
| 3 | Écrire le cas du supplément payé par mail après ajout | `CASE-MODIF-03` | `SPEC-MODIF-01`, `SPEC-PAY-01` (référence) | `SPEC-PAY-01` (lecture seule) |
| 4 | Écrire le cas de suppression d'un participant avec remboursement | `CASE-MODIF-04` | `SPEC-MODIF-01`, `SPEC-CANCEL-CLIENT-01` (référence) | `SPEC-CANCEL-CLIENT-01` (lecture seule) |

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

**Trou de couverture non traité** : le cas limite 4 de `SPEC-MODIF-01`
(modification qui dépasse la capacité du bateau) n'a jamais fait l'objet
d'une tâche — les 4 cas couvrent les 4 AC mais pas ce cas limite.

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
