# Plan de délégation — `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).
>
> **Cas particulier** : un cas (`CASE-CANCEL-CLIENT-AVERTISSEMENT-03`, à
> l'origine `CASE-CANCEL-03`) existait déjà et testait correctement AC-3. La
> tâche a donc été double : compléter la couverture manquante, **et**
> corriger un problème de nommage découvert en cours de route (numérotation
> héritée d'une collision historique avec `SPEC-CANCEL-CLIENT-01`).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Identifier les AC et cas limites de la spec non couverts par le cas existant | *(aucun — tâche d'audit)* | `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`, `CASE-CANCEL-CLIENT-AVERTISSEMENT-03` (existant) | les autres `SPEC-CANCEL-*` |
| 2 | Écrire le cas « annulation avant l'envoi de l'avertissement » (cas limite 1, barème classique) | `CASE-CANCEL-CLIENT-AVERTISSEMENT-02` | `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`, `SPEC-CANCEL-CLIENT-01` (référence) | `SPEC-CANCEL-CLIENT-01` (lecture seule) |
| 3 | Écrire le cas « remboursement intégral maintenu si la sortie a finalement lieu » (AC-4) | `CASE-CANCEL-CLIENT-AVERTISSEMENT-03` | `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` | `SPEC-CANCEL-PRESTATAIRE-02` |
| 4 | Écrire le cas « trace de réception de l'avertissement » (AC-1, AC-5) | `CASE-CANCEL-CLIENT-AVERTISSEMENT-04` | `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` | — |
| 5 | Renuméroter les 4 cas en séquence propre (01 → 04) et corriger la référence spec (tiret) | `CASE-CANCEL-CLIENT-AVERTISSEMENT-01/02/03/04` | historique git des fichiers concernés | `CASE-CANCEL-CLIENT-01/02/03` (autre spec, à ne pas confondre) |

**Note sur la numérotation** : les tâches 2 à 4 sont indiquées ici avec leur
nom **final** (après la tâche 5). Elles ont d'abord été écrites sous
`AVERTISSEMENT-04/05/06`, à la suite du cas existant `AVERTISSEMENT-03` —
avant de découvrir que ce « 03 » n'était pas un choix délibéré mais un
artefact d'une collision de numérotation avec `CASE-CANCEL-CLIENT-03`
(retracée via `git log --follow`).

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | 3 AC (`AC-1`, `AC-4`, `AC-5`) et 1 cas limite (annulation avant avertissement) identifiés comme non couverts. |
| 2 | `conforme` | Ce cas ne correspond à aucun AC numéroté de la spec (matérialise le « cas limite 1 »), signalé explicitement plutôt que d'inventer un AC. |
| 3 | `conforme` | — |
| 4 | `conforme` | Dépend d'un mécanisme de traçabilité (table `Notification`) non confirmé dans le MCD V2 — signalé en remarque, non automatisable tel quel tant que ce point n'est pas tranché. |
| 5 | `repris` | La numérotation d'origine (« 03 » hérité) a dû être corrigée après coup : renommage des 4 fichiers en 01→04, mise à jour du H1, du nom de test et de la référence spec dans chacun. L'utilisateur a ensuite ajouté manuellement un suffixe descriptif au fichier 01 (`-pendant-avertissement`) pour uniformiser avec les 3 autres. |

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
