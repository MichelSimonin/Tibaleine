# Plan de délégation — `SPEC-SYST-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de détection d'un service externe indisponible | `CASE-SYST-01` | `SPEC-SYST-01`, gabarit CASE | `SPEC-PAY-01`, `SPEC-ALERT-01` |
| 2 | Écrire le cas de non-blocage de l'application en cas de panne | `CASE-SYST-02` | `SPEC-SYST-01` | — |
| 3 | Écrire le cas d'information du client en cas d'indisponibilité | `CASE-SYST-03` | `SPEC-SYST-01` | — |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Signale correctement en « ne vérifie pas » que le mécanisme exact de détection (healthcheck ou test au moment de l'appel) reste une question ouverte de la spec — cohérent avec sa propre Revue IA. |
| 2 | `conforme` | — |
| 3 | `conforme` | — |

**Réserve commune aux trois cas** : le comportement exact de repli en cas de
panne SMS/email (nouvelle tentative, bascule sur un autre canal, ou perte de
la notification) reste marqué « à préciser » dans la spec (ambiguïté CR-04
§6). Les trois cas le signalent honnêtement plutôt que de trancher à sa
place — ce qui est correct, mais laisse la question toujours ouverte.

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
