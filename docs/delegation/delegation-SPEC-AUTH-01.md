# Plan de délégation — `SPEC-AUTH-01`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de création de compte avec mot de passe | `CASE-AUTH-01` | `SPEC-AUTH-01`, gabarit CASE | `SPEC-CONS-01`, `SPEC-BOOK-01/02` |
| 2 | Écrire le cas de création de compte sans mot de passe | `CASE-AUTH-02` | `SPEC-AUTH-01` | `SPEC-CONS-01` |
| 3 | Écrire le cas de connexion par mot de passe | `CASE-AUTH-03` | `SPEC-AUTH-01` | — |
| 4 | Écrire le cas de connexion par lien email à usage unique | `CASE-AUTH-04` | `SPEC-AUTH-01`, `SPEC-CONS-01` (référence) | `SPEC-CONS-01` (lecture seule) |
| 5 | Écrire le cas d'email déjà utilisé (cas limite 1) | `CASE-AUTH-05` | `SPEC-AUTH-01` | — |
| 6 | Écrire le cas de mot de passe invalide (cas limite 3) | `CASE-AUTH-06` | `SPEC-AUTH-01` | — |
| 7 | Écrire le cas de l'employé en lecture seule | `CASE-AUTH-07` | `SPEC-AUTH-01` | `SPEC-CONS-01` |
| 8 | Écrire le cas de l'administrateur en accès complet | `CASE-AUTH-08` | `SPEC-AUTH-01` | `SPEC-CANCEL-*` |
| 9 | Écrire le cas du client bloqué sur la vue patron | `CASE-AUTH-09` | `SPEC-AUTH-01` | — |

**Préalable non listé dans ce découpage** : avant d'écrire ces 9 cas, trois
décisions d'équipe ont dû être tranchées et documentées dans la Revue IA de
`SPEC-AUTH-01` (compte client confirmé, mot de passe optionnel, accès sans
mot de passe via lien email à usage unique). Ce travail de clarification a
précédé le découpage ci-dessus — un vrai plan de délégation l'aurait listé
comme tâche 0.

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | — |
| 2 | `conforme` | — |
| 3 | `conforme` | — |
| 4 | `conforme` | Durée de validité du lien avant expiration volontairement laissée hors périmètre (point encore ouvert, à trancher plus tard). |
| 5 | `conforme` | — |
| 6 | `conforme` | — |
| 7 | `conforme` | — |
| 8 | `conforme` | — |
| 9 | `conforme` | — |

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
