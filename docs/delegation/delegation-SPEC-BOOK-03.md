# Plan de délégation — `SPEC-BOOK-03`

> **Plan historique incomplet.** Le découpage « Avant » a bien été renseigné,
> mais le retour « Après » n'a pas été consigné le jour de l'exécution. Les
> résultats ne sont pas reconstitués rétroactivement.

Lorsqu'un client réserve, une place est bloquée temporairement dès que l'utilisateur clique sur « Réserver » et arrive sur le formulaire, pour une durée de 15 minutes. Au passage au paiement, un nouveau délai d'environ 15 minutes lui est accordé. Si le paiement n'est pas effectué dans ce délai, la place redevient disponible.

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérification qu'une place est bloquée temporairement dès le clic sur « Réserver » pendant 15 minutes.| `CASE-BOOK-06` | `SPEC-BOOK-03`, `CASE-BOOK-06`, fixtures de test sur le moment du clic, la durée de blocage et les places disponibles. | L'agent ne touche pas la logique de paiement, les templates d'email, la logique de réservation client lambda ni les règles d'annulation ou de météo. |
| 2 | Vérification qu'une place est libérée si le paiement n'est pas effectué dans le délai imparti.| `CASE-BOOK-07` | `SPEC-BOOK-03`, `CASE-BOOK-07`, fichiers de test sur la libération de place et la durée de 15 minutes avant expiration. | L'agent ne touche pas le service de paiement, la logique de disponibilité affichée, les notifications client ni les autres specs du domaine (`SPEC-BOOK-01`, `SPEC-BOOK-02`). |


---

## Après — ce qui s'est passé

Non renseigné au rituel de 16h15. L'absence de retour est conservée comme un
écart documentaire plutôt que remplacée par un compte rendu reconstruit.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | *(non renseigné)* | Retour non consigné le jour même. |
| 2 | *(non renseigné)* | Retour non consigné le jour même. |

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
avec six `conforme` qui n'a rien observé. Ici, l'écart à présenter est l'absence
de retour « Après » consigné le jour même.
