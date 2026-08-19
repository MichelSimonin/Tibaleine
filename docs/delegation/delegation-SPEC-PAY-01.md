# Plan de délégation — `SPEC-PAY-01`

> Reconstruit a posteriori à titre d'exemple, à partir des cas déjà écrits
> par l'équipe. Pour les prochaines specs, écrire la partie « Avant »
> **avant** de confier la première tâche — un plan écrit après coup ne vaut
> rien (voir gabarit).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Écrire le cas de paiement en ligne d'une réservation confirmée | `CASE-PAY-01` | `SPEC-PAY-01`, gabarit CASE | — |
| 2 | Écrire le cas de passage à l'état « payée » | `CASE-PAY-02` | `SPEC-PAY-01` | — |
| 3 | Écrire le cas de mise à jour des places après paiement | `CASE-PAY-03` | `SPEC-PAY-01` | — |
| 4 | Écrire le cas de libération de la place après 15 min sans paiement | `CASE-PAY-04` | `SPEC-PAY-01`, `SPEC-BOOK-03` (référence) | `SPEC-BOOK-03` (lecture seule) |
| 5 | Écrire le cas de paiement refusé (carte refusée, service indisponible) | `CASE-PAY-05` | `SPEC-PAY-01` | — |

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
| 5 | `repris` | La tâche a d'abord été bloquée par une ambiguïté non vue jusque-là : le cas limite 2 de `SPEC-PAY-01` supposait un état « confirmée » avant paiement (repris de `CASE-PAY-02`), incompatible avec le fait qu'aucune validation du patron n'a lieu avant paiement. Une fois la question posée et tranchée (pas de validation patron, paiement direct après soumission), `SPEC-BOOK-01` (AC-4/5 retirés), `SPEC-PAY-01` (AC-5 ajouté), `CASE-PAY-01` et `CASE-PAY-02` (état de départ corrigé) ont été mis à jour en cohérence, puis `CASE-PAY-05` écrit. |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

Pas le nombre de `conforme`. Ce qui se lit, c'est **l'écart entre ce que vous aviez
prévu et ce qui est arrivé, et le fait que vous l'ayez vu**. Ici, l'écart s'est
niché dans la tâche 5 : un état de réservation halluciné (« confirmée ») repris
sans le vérifier depuis un cas voisin, qui a fini par révéler une vraie question
métier (patron valide-t-il avant paiement ?) plutôt qu'un simple oubli de cas.
