# Plan de délégation — `SPEC-FACT-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de regroupement et facturation en fin de mois | `CASE-FACT-01` | `SPEC-FACT-01`, gabarit CASE | `SPEC-BOOK-02`, `SPEC-PAY-01` |
| 2 | Écrire le cas de la remise de 15 % | `CASE-FACT-02` | `SPEC-FACT-01` | — |
| 3 | Écrire le cas d'exclusion des réservations annulées | `CASE-FACT-03` | `SPEC-FACT-01`, `SPEC-CANCEL-PRESTATAIRE-02` (référence) | `SPEC-CANCEL-PRESTATAIRE-02` (lecture seule) |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Montants cohérents avec le barème utilisé ailleurs dans le projet (65 €/40 € baleine, 50 € dauphin — cf. `CASE-BOOK-02`). |
| 2 | `conforme` | — |
| 3 | `conforme` | — |

**Trou de couverture non traité** : le cas limite 1 de `SPEC-FACT-01`
(paiement de l'hôtel en avance ou en retard — deux options non tranchées
dans la spec) n'a jamais fait l'objet d'une tâche. C'est correct de l'avoir
laissé de côté plutôt que de trancher à la place du client, mais ça reste un
maillon manquant tant que la question n'est pas posée.

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
