# Plan de délégation — `SPEC-LANG-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de l'interface disponible en français et en anglais | `CASE-LANG-01` | `SPEC-LANG-01`, gabarit CASE | — |
| 2 | Écrire le cas des messages d'alerte/annulation en français et en anglais | `CASE-LANG-02` | `SPEC-LANG-01`, `SPEC-ALERT-01` (référence) | `SPEC-ALERT-01` (lecture seule) |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | Signale correctement en « ne vérifie pas » que le mécanisme de sélection de la langue reste une question ouverte de la spec. |
| 2 | `repris` (non appliqué) | Le cas teste un message **systématiquement bilingue** (FR + EN envoyés ensemble). Or la Revue IA de `SPEC-LANG-01` avait explicitement relevé une contradiction non tranchée : le scénario nominal 2 dit « disponible en français ET en anglais », le cas limite 2 dit « envoyé en français » pour un client francophone — deux comportements différents (message bilingue systématique, ou message dans la langue du client). Le cas choisit une des deux lectures sans le signaler comme une décision — à documenter ou corriger. |

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
