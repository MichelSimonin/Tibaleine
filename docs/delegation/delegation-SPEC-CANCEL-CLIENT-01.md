# Plan de délégation — `SPEC-CANCEL-CLIENT-01`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).
>
> **Différence avec les plans ALERT-01 / AUTH-01 / CONS-01 / DISP-01** : ici
> les 3 cas (`CASE-CANCEL-CLIENT-01/02/03`) existaient déjà, écrits par
> l'équipe. La tâche confiée n'était pas d'écrire des cas, mais de **vérifier
> et corriger leur conformité** à la spec (référence spec, critères
> d'acceptation cités).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérifier la correspondance entre les AC de `SPEC-CANCEL-CLIENT-01` et les 3 cas existants | *(aucun — tâche d'audit, pas de CASE modifié)* | `SPEC-CANCEL-CLIENT-01`, `CASE-CANCEL-CLIENT-01`, `CASE-CANCEL-CLIENT-02`, `CASE-CANCEL-CLIENT-03` | les autres specs `SPEC-CANCEL-*` |
| 2 | Corriger le champ « Critère d'acceptation » de `CASE-CANCEL-CLIENT-02` (ne garder que l'AC réellement testé) | `CASE-CANCEL-CLIENT-02` | `CASE-CANCEL-CLIENT-02.md` | `CASE-CANCEL-CLIENT-01.md`, `CASE-CANCEL-CLIENT-03.md` |

**Tâche 1 ne pointe vers aucun `CASE`** — c'est volontairement laissé vide
plutôt que rempli artificiellement : le gabarit dit explicitement (ligne 19-20)
que si on ne sait pas quel test va changer d'état, la tâche est mal
découpée. Une tâche d'audit pur n'en est pas une au sens du gabarit ; elle
sert à préparer la vraie tâche (la 2).

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | L'audit a bien identifié l'écart : `CASE-CANCEL-CLIENT-02` citait 5 AC (`AC-01, 02, 04, 06, 07`) alors que son contenu ne teste réellement qu'`AC-04`. |
| 2 | `conforme` | Le champ a été réduit à `AC-04` seul. À noter : le fichier avait aussi été modifié en parallèle sur le disque (correction de la référence spec, `SPEC-CANCEL_CLIENT-01` → `SPEC-CANCEL-CLIENT-01`) par quelqu'un d'autre de l'équipe pendant l'intervention — signal de travail concurrent sur le même fichier, pas un échec de la tâche. |

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
