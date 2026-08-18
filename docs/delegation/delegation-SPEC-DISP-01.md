# Plan de délégation — `SPEC-DISP-01`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas des places restantes affichées sur un créneau | `CASE-DISP-01` | `SPEC-DISP-01`, gabarit CASE | `SPEC-BOOK-03` |
| 2 | Écrire le cas du créneau complet affiché indisponible | `CASE-DISP-02` | `SPEC-DISP-01` | — |
| 3 | Écrire le cas du badge « nouvelle place disponible » après une annulation | `CASE-DISP-03` | `SPEC-DISP-01` | `SPEC-CANCEL-PRESTATAIRE-02` |
| 4 | Écrire le cas du badge après expiration du délai de paiement | `CASE-DISP-04` | `SPEC-DISP-01`, `SPEC-BOOK-03` (référence) | `SPEC-BOOK-03` (lecture seule) |
| 5 | Écrire le cas de l'alerte météo affichée sur le calendrier | `CASE-DISP-05` | `SPEC-DISP-01`, `SPEC-ALERT-01` (référence) | `SPEC-ALERT-01` (lecture seule) |
| 6 | Écrire le cas du créneau à moins de 2 h affiché indisponible | `CASE-DISP-06` | `SPEC-DISP-01` | `SPEC-BOOK-01` |
| 7 | Écrire le cas du décompte des places dès le clic sur « Réserver » | `CASE-DISP-07` | `SPEC-DISP-01`, `SPEC-BOOK-03` (référence) | `SPEC-BOOK-03` (lecture seule) |

**Préalable non listé dans ce découpage** : deux points de la Revue IA de
`SPEC-DISP-01` ont dû être tranchés avant l'écriture des cas 6 et 7 —
l'affichage d'un créneau à moins de 2 h du départ (indisponible) et le
moment du décompte des places bloquées (dès le clic sur « Réserver »). Un
vrai plan de délégation les aurait listés comme tâche 0.

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
| 7 | `conforme` | — |

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
