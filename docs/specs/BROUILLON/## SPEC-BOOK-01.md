## SPEC-BOOK-01 — Réservation d'un créneau d'un client lambda

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
- Ne couvre pas une réservation via un compte professionnel → `SPEC-BOOK-02`

### Scénarios nominaux

```gherkin
Étant donné un créneau libre pour une sortie baleine le 12 juillet à 10h00 pour lequel il reste 4 places.
Quand le client réserve ce créneau
Il fournis son email, nom, prénom et le nombre de personnes ( 3 adultes et 1 enfant)
Alors en confirmant, le client recevra un email de confirmation de prise en charge de sa demande et le réservation passe en état "En attente".
Le patron reçoit un sms qu'il y a une demande de réservation.
(A CONFIRMER) Le patron peut accepter ou non la demande.
(A CONFIRMER | Ignoré si le process change) Si le patron accepte la réservation passe en "Validé".
Le client peut payer sa réservation et celle-ci passe en état "Payée".



### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le client veut finalement inclure une nouvelle personne lors de la soumission de la demande | Dans ce scénario, le nombre de place disponible n'est pas assez pour inclure une nouvelle personne. La demande est bloqué. Le client doit alors revoir le nombre de personne ou essayer un autre créneau.|
| 2 | le client essaye de réserver à 1h du départ | La réservation est bloqué 2h avant le départ. |
| 3 | (A CONFIRMER) Plusieurs clients essayent de réserver un même créneau. | La première réservation qui passe en état "Payée" aura les places. Si il n'y a plus de place pour les prochaines réservation en attente, les concernés recevront un mail/sms leurs disant que le créneau n'est plus disponible et les inviteront à essayer un autre créneau. |
| 4 | la réservation est validé mais le client n'a toujours pas payé au moment du départ | (Question à posé) |

### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Fonctionnement des paiement si le client ne veut pas payer en ligne.
- Fonctionnement de la liste d'attente des réservations.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client peut remplir les données du formulaire de demande de réservation 
- [ ] AC-2 — Le client peut envoyer le formulaire et reçoit un retour par mail.
- [ ] AC-3 — Le patron reçoit la demande de réservation
- [ ] AC-4 — Le patron peut accepter, ou non, la demande de réservation. (Le cas échéant, la résolution de problème se passera au téléphone entre le patron et son client)
- [ ] AC-5 — Si un refus à lieu, le client pourra recommencer une demande de réservation.
- [ ] AC-6 — Le nombre de place disponible pour une activité se met à jour après le paiement d'une réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
