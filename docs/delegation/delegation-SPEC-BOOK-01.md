# Plan de délégation — `<SPEC-BOOK-01>`

Copiez ce gabarit en `docs/delegation-<SPEC-DOM-nn>.md`.

Un client peut écrire des informations dans le formulaire de réservation. Il peut envoyer les données 
et recevoir un retour par mail.
Après réservation, le nombre de places disponible sur l'activité est mis à jour.
---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Comparaison des données en entrées et les données en sortie| `CASE-BOOK-01-formulaire-client` | Informations données par le client via formulaire et l'entité crée après réservation. | Ces test consitent en de simple comparaison.L'agent ne doit pas modifier les fichiers de données d'entrées et de sortie. Aucune autre fichier dans le projet n'est necessaire pour ces test, ils ne doivent donc en aucun cas être modifiés.  |
| 2 | Envoie du mail et vérification du corp du mail | `CASE-BOOK-03—envoie-retour-mail` | information de l'entité crée après réservation, fichier du service de mail, fichier html contenant le corp du mail.|L'agent ne doit pas toucher au données des entités et code du service de mail.  |
| 3 | | `CASE-BOOK-04—NB-PLACES` | Information de l'entité crée après réservation et des réservations passé sur l'activité réservé. | Ces test consistent en de simple comparaison. Aucun fichier (et particulièrement les données des entités) ne doit être modifier.  |

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
