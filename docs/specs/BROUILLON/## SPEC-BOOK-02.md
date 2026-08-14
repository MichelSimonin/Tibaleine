## SPEC-BOOK-02 — Réservation d'un créneau d'un professionnel

**Exigence :** REQ-0xx
**Statut :** brouillon | revue IA faite | validée
**Version :** v1

### Règle

Une phrase, à l'indicatif, qui dit ce qui doit être vrai. Pas de « le système
pourrait », pas de « idéalement ».

> Le client doit pouvoir réserver un créneau en fournissant son email, nom, prénom, date voulue, type de sortie voulu et le nombre de personne, incluant le nombre d'enfants.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas une réservation à l'initiative du prestataire → `SPEC-<DOM>-0x`
- Ne couvre pas une réservation via un compte professionnel → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une collaboration avec un hôtel proche.
L'hôtel doit pouvoir réserver pour tout créneau jusqu'à 6 places 
sans passer par le formulaire et processus client classique.
L'hôtel doit pouvoir payer pour toutes les réservations redevables
à la fin du mois avec une réduction de 15%.
```


### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | l'hôtel veut réserver pour plus de 6 personnes | Le client à préciser que l'hôtel pouvait réserver jusqu'à 6 places. Tout surplus peut être arranger en discutant avec le client mais ne sera, pour le moment, pas pris en charge par l'appli.|
| 2 | l'hôtel voudrait payer en avance ou en retard | (2 possibilités à déterminer) (1) Possible, chaque réservation jusqu'au paiement est stockées est additionné. (2) Pas possible, un lien de paiement est envoyé à une date fixe. |


### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Processus de paiement. Date fixe ou flexible?

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — L'hôtel peut réserver plusieurs places par semaine simplement
- [ ] AC-2 — Le patron reçoit une notification des réservations (???il n'aura pas besoin de confirmer????)
- [ ] AC-3 — Le patron reçoit la demande de réservation
- [ ] AC-4 — Le nombre de place disponible pour une activité se met à jour après une réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
