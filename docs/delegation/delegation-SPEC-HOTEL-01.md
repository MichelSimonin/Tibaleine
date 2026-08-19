# Plan de délégation — `SPEC-HOTEL-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).
>
> **Ce plan documente un écart non résolu** sur la tâche 1 : le cas
> correspondant s'appuie sur une hypothèse que ni la spec ni le modèle de
> données ne confirment. Gardé tel quel plutôt que maquillé (voir gabarit,
> « Ce qui sera regardé »).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de création d'un compte hôtel | `CASE-HOTEL-01` | `SPEC-HOTEL-01`, gabarit CASE | `SPEC-BOOK-02` |
| 2 | Écrire le cas de consultation des créneaux par l'hôtel | `CASE-HOTEL-02` | `SPEC-HOTEL-01` | `SPEC-DISP-01` |
| 3 | Écrire le cas de consultation des réservations par l'hôtel | `CASE-HOTEL-03` | `SPEC-HOTEL-01` | `SPEC-CONS-01` |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `repris` (non appliqué) | Le cas suppose que c'est **le patron** qui crée le compte hôtel, alors que la Revue IA de `SPEC-HOTEL-01` laisse explicitement cette question ouverte (« l'hôtel peut-il s'inscrire lui-même ? »). Plus grave : `docs/mcd/mcd-V2.md` §7.4 dit que la clientèle hôtel est modélisée en **table `Hotel` séparée**, mais `docs/mcd/mcd-V2.dbml` (le schéma réel) dit qu'un hôtel est un **Utilisateur ordinaire** — aucun rôle ni table « hôtel » n'existe dans le schéma. Le cas ne peut pas être considéré fiable tant que cette contradiction n'est pas tranchée. |
| 2 | `conforme` | Dépend du même point non tranché que la tâche 1 (comment identifier un compte hôtel), sans que ça bloque le contenu du cas lui-même. |
| 3 | `conforme` | Idem. |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

Pas le nombre de `conforme`. Ce qui se lit, c'est **l'écart entre ce que vous aviez
prévu et ce qui est arrivé, et le fait que vous l'ayez vu**. La tâche 1 est
précisément ce cas-là : une hypothèse silencieuse plutôt qu'une décision
tracée, sur un point qui touche potentiellement tout le modèle de données.
