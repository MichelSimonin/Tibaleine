## SPEC-BOOK-02 — Réservation d'un créneau d'un professionnel

**Exigence :** REQ-012
**Statut :** précisée (cahier des charges V5, R-101)
**Version :** v2
**Amendée par :** `SPEC-BOOK-02-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-BOOK-02-A1`.


### Règle

> Un hôtel partenaire peut réserver jusqu'à 6 places par créneau, pour une
> sortie baleine ou dauphin, sans passer par le formulaire client classique.
> Les réservations peuvent se faire directement sur le site grâce à un compte
> pro ou via email/sms au patron qui créera les réservations. Les réservations
> de l'hôtel sont facturées en fin de mois avec une remise de 15 %. Une
> réservation hôtel passe directement à l'état « réservée » dès sa création,
> avec le statut de paiement « en attente de paiement » (R-101) — pas
> d'acompte immédiat, contrairement à un client particulier (`SPEC-PAY-01`).

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01`
- Ne couvre pas la réservation d'un client particulier → `SPEC-BOOK-01`
- Ne couvre pas l'annulation météo d'un créneau concernant l'hôtel → `SPEC-CANCEL-PRESTATAIRE-02` (cas 2)

### Scénarios nominaux

```gherkin
Étant donné un hôtel partenaire
Et des créneaux de la semaine du 17.08.2026 au 23.08.2026 disposant chacun de plus de 6 places
Quand l'hôtel réserve jusqu'à 6 places par créneau sans passer par le formulaire client
Alors les réservations sont validées sans paiement immédiat
Et les réservations de l'hôtel sont facturées en fin de mois avec une remise de 15 %
```


### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | l'hôtel veut réserver pour plus de 6 personnes | Le client à préciser que l'hôtel pouvait réserver jusqu'à 6 places. Tout surplus peut être arranger en discutant avec le client mais ne sera, pour le moment, pas pris en charge par l'appli.|
| 2 | l'hôtel voudrait payer en avance ou en retard | (2 possibilités à déterminer) (1) Possible, chaque réservation jusqu'au paiement est stockée et additionnée. (2) Pas possible, un lien de paiement est envoyé à une date fixe. |
| 3 | l'hôtel tente de réserver une privatisation | La réservation est refusée (l'hôtel ne peut pas réserver de sortie de type privatisation). |
| 4 | l'hôtel réserve sur un créneau presque complet | La réservation est limitée aux places restantes (maximum 6). |


### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Processus de paiement : date fixe ou flexible ? (cas limite 2)
- Confirmation des réservations hôtel par le patron (AC-2) : nécessaire ou non ?

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — L'hôtel peut réserver plusieurs places par semaine simplement
- [ ] AC-2 — Le patron reçoit une notification des réservations hôtel (à préciser : confirmation nécessaire ou non)
- [ ] AC-3 — L'hôtel ne peut pas réserver plus de 6 places sur un même créneau.
- [ ] AC-4 — Le nombre de places disponibles pour une activité se met à jour après une réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| La « Règle » reprenait celle de SPEC-BOOK-01 (client lambda) | corrigée | Remplacée par la règle hôtel (6 places, fin de mois, -15 %) |
| AC-2 ambigu : le patron doit-il confirmer les réservations hôtel ? | à trancher | À poser au client |
| Cas limite 2 (paiement en avance/retard) : deux options non tranchées → spec non validable en l'état | à trancher | Question ouverte (SPEC-FACT-01) |
| Mise à jour des places : après réservation (AC-4) ici vs après paiement (SPEC-BOOK-01 AC-6) — incohérent pour l'hôtel qui paie en fin de mois | tranchée | Ce n'est pas une incohérence : R-101 confirme qu'une réservation hôtel passe à l'état « réservée » dès sa création (statut « en attente de paiement »), sans acompte préalable contrairement au client particulier. AC-4 était donc correct pour ce persona. |
| Cas limites manquants : privatisation refusée (R-57), créneau complet | corrigée | Cas limites 3 et 4 ajoutés |
| Le cahier des charges V5 introduit un acompte obligatoire pour les clients particuliers — s'applique-t-il aussi aux hôtels ? (question ouverte 16) | tranchée | Confirmé par le client : non, l'hôtel reste exclu de l'acompte obligatoire car il paie en une fois chaque mois (toutes les réservations du mois). Cohérent avec R-101 (statut « en attente de paiement »). |

Les refus se reportent aussi dans `docs/journal.md`.
