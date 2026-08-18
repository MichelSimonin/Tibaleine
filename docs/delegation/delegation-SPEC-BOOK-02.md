# Plan de délégation — `<SPEC-BOOK-02>`

Copiez ce gabarit en `docs/delegation-<SPEC-DOM-nn>.md`.

Un hôtel partenaire peut réserver jusqu'à 6 places par créneau, pour une
sortie baleine ou dauphin, sans passer par le formulaire client classique.
Une réservation peut comprendre plusieurs créneaux et jours.
Le nombre de places disponibles pour chaque activité choisi doit être mis à jour après réservation.
---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérification que l'hôtel peut réserver plusieurs créneaux et qu'il ne puisse pas réserver plus de 6 places sur un même créneau.| `CASE-BOOK-02` | `SPEC-BOOK-02`, `CASE-BOOK-02`, fichiers de test et fixtures liés à la réservation hôtel et à la limite de 6 places par créneau. | L'agent ne touche pas la logique de facturation fin de mois (`SPEC-FACT-01`), la réservation client lambda (`SPEC-BOOK-01`), le paiement immédiat ni les fichiers de données de référence non liés aux réservations hôtel. |
| 2 | Vérification que les places disponibles sont correctement mises à jour après une réservation hôtel.| `CASE-BOOK-05` | `SPEC-BOOK-02`, `CASE-BOOK-05`, fixtures de créneaux, répartition des places restantes et données de réservation hôtel. | L'agent ne touche pas le service de facturation, la logique de réservation cliente, les règles d'annulation, ni les autres specs du domaine susceptibles d'influencer la facturation ou les notifications. |


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
