# Plan de délégation — `<SPEC-BOOK-01>`

Copiez ce gabarit en `docs/delegation-<SPEC-DOM-nn>.md`.

Un client peut écrire des informations dans le formulaire de réservation. Il peut envoyer les données 
et recevoir un retour par mail.
Après réservation, le nombre de places disponible sur l'activité est mis à jour.
---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérification que le formulaire de réservation client enregistre une réservation valide et que les données saisies correspondent au bon objet métier.| `CASE-BOOK-01` | `SPEC-BOOK-01`, `CASE-BOOK-01`, fichiers de test et fixtures liés au formulaire client et à la création d'une réservation. | L'agent ne touche pas le service d'envoi d'email, la logique de paiement, les autres specs du domaine (`SPEC-BOOK-02`, `SPEC-BOOK-03`) et les données de référence non liées au formulaire. |
| 2 | Vérification de l'envoi du mail de confirmation et du contenu du message envoyé au client.| `CASE-BOOK-03` | `SPEC-BOOK-01`, `CASE-BOOK-03`, le template de mail et les fichiers de test liés à la confirmation client. | L'agent ne touche pas les entités de réservation, la logique du formulaire, la logique de paiement ni les autres services de notification. |
| 3 | Vérification de la mise à jour des places disponibles après une réservation payée.| `CASE-BOOK-04` | `SPEC-BOOK-01`, `CASE-BOOK-04`, fixtures de créneaux et de réservations, fichiers de test liés à la disponibilité d'une activité. | L'agent ne touche pas le service d'email, la logique de blocage temporaire (`SPEC-BOOK-03`), la logique de paiement ni les règles de réservation hôtel (`SPEC-BOOK-02`). |
| 4 | Vérification de l'envoi d'un SMS au patron et de la création d'une notification dans son espace administrateur après une réservation payée. | [`CASE-BOOK-08`](../../tests/cases/CASE-BOOK-08-NOTIFICATION-PATRON.md) | `SPEC-BOOK-01`, `CASE-BOOK-08`, le service de notification et les fichiers de test liés aux notifications du patron. | L'agent ne touche pas l'email de confirmation du client, la logique du formulaire, la logique de paiement, la mise à jour des places ni les autres spécifications du domaine. |

**Colonne 3.** Un identifiant `CASE`, pas une phrase. Si vous ne savez pas quel test
va changer d'état, la tâche est mal découpée — c'est le repère du module 07.

**Colonne 4.** Ce que l'agent reçoit : les fichiers, les spécifications, les cas de
test. Pas le dépôt entier.

**Colonne 5.** Ce qu'il n'a pas à modifier. Une colonne vide veut dire que vous
n'avez pas pensé au rayon d'action — or « l'agent modifie des fichiers que vous ne
lui avez pas désignés » est le premier des trois signaux de reprise en main.

---

## Après — ce qui s'est passé

Complété au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | | |
| 2 | | |
| 3 | | |
| 4 | | |

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

C'est une des trois questions obligatoires de la présentation de J10.
