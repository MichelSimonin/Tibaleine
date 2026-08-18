# Plan de délégation — `SPEC-ALERT-01`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas d'envoi de l'avertissement à 18 h aux clients déjà réservés | `CASE-ALERT-01` | `SPEC-ALERT-01`, gabarit CASE | `SPEC-SYST-01`, `SPEC-CANCEL-PRESTATAIRE-02` |
| 2 | Écrire le cas de l'alerte site pour un client réservant après 18 h | `CASE-ALERT-02` | `SPEC-ALERT-01`, gabarit CASE | `SPEC-DISP-01` |
| 3 | Écrire le cas du message personnalisé et bilingue (FR/EN) | `CASE-ALERT-03` | `SPEC-ALERT-01`, `SPEC-LANG-01` (référence) | `SPEC-LANG-01` (lecture seule, pas de modification) |
| 4 | Écrire le cas d'annulation définitive avec notification simultanée « sans frais » | `CASE-ALERT-04` | `SPEC-ALERT-01`, `SPEC-CANCEL-PRESTATAIRE-02` (référence) | `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` |
| 5 | Écrire le cas de l'hôtel non notifié par SMS/mail (appelé directement) | `CASE-ALERT-05` | `SPEC-ALERT-01` | `SPEC-FACT-01`, `SPEC-HOTEL-01` |
| 6 | Écrire le cas de panne du service SMS lors d'un avertissement | `CASE-ALERT-06` | `SPEC-ALERT-01`, `SPEC-SYST-01` (référence) | `SPEC-SYST-01` (lecture seule, pas de modification) |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | — |
| 2 | `conforme` | — |
| 3 | `conforme` | Dépend d'un point non tranché signalé dans le cas (détermination de la langue du client — absent du MCD V2), sans avoir bloqué la rédaction. |
| 4 | `conforme` | — |
| 5 | `conforme` | — |
| 6 | `conforme` | Comportement de repli en cas de panne (retry, bascule mail) resté hors périmètre du cas — signalé, pas bloquant. |

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
