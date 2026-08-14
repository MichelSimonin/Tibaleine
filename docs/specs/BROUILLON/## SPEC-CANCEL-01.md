## SPEC-CANCEL-01 — Annulation de la réservation à l'initiative du client

**Exigence :** REQ-0xx
**Statut :** brouillon | revue IA faite | validée
**Version :** v1

### Règle

Une phrase, à l'indicatif, qui dit ce qui doit être vrai. Pas de « le système
pourrait », pas de « idéalement ».

>À moins de 48 heures du départ, une annulation à l'initiative du client
> entraîne une retenue de 50 % du montant total de la réservation, une annulation
>entre 48h et 7 jours entraîne une retenue de 25% du montant et une annulation à plus 
>de 7 jours entraîne un remboursement totale.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas l'annulation à l'initiative du prestataire → `SPEC-CANCEL-02`
- Ne couvre pas la réduction du nombre de participants → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une réservation payée de 260 € prévue le 12 juillet à 10h00
Et que nous sommes le 11 juillet à 09h00
Quand le client annule sa réservation
Alors 130 € restent acquis au prestataire
Et 130 € sont remboursés
Et la réservation passe à l'état « annulée »
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | annulation exactement 48h00 avant le départ | Le cas du remboursement entre dans le cadre des 48h et moins. Le client sera remboursé de 50£ du montant de la réservation et celle-ci sera complétement annulée. |
| 2 | annulation après l'heure de départ | La réservation passe à l'état, "Effectué" peu après l'heure de départ. Il sera impossible d'annuler une reservation après l'heure de départ. |
| 3 | réservation déjà annulée | Une reservation dans l'état "Annulé" ne donne pas accès au bouton pour annuler. Il sera donc impossible d'annuler un réservation déjà annulé. |
| 4 | réservation d'un montant nul (offerte) | Le client peut annuler une réservation d'un montant nul. Le processus de remboursement est géré par le patron qui verra que la réservation était offerte. |

### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Aucune validation orale que annuler à 48h pile entre dans le cadre des 7 à 48h ou moins de 48h.
- Aucune mention de prestation offerte lors des échanges avec le client.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client peut remplir les données du formulaire de demande d'annulation 
- [ ] AC-2 — Le client peut envoyer le formulaire et reçoit un retour
- [ ] AC-3 — Le patron reçoit la demande d'annulation
- [ ] AC-4 — Le patron peut accepter, ou non, la demande d'annulation. (Le cas échéant, la résolution de problème se passera au téléphone entre le patron et son client)
- [ ] AC-5 — Si un report à lieu, le client pourra recommencer une demande de réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
