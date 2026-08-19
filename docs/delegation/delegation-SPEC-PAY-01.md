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
| 5 | Écrire le cas de paiement refusé (carte refusée, service indisponible) | `CASE-PAY-05` *(jamais assigné)* | `SPEC-PAY-01` | — |

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
| 5 | *(non réalisée)* | Le cas limite 2 de `SPEC-PAY-01` (paiement échoué) reste sans cas de test, alors que c'est justement le point que la propre Revue IA de la spec signale comme incohérent : « la réservation reste en attente » contredit le workflow confirmée→payée du MCD. Sans cas de test, cette incohérence reste invisible tant que personne ne la cherche. |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

Pas le nombre de `conforme`. Ce qui se lit, c'est **l'écart entre ce que vous aviez
prévu et ce qui est arrivé, et le fait que vous l'ayez vu**. Ici, l'écart n'est
pas dans les 4 tâches faites — il est dans la 5ᵉ, jamais réellement découpée.
