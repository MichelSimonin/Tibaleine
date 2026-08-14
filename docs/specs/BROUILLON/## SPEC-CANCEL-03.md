## SPEC-CANCEL-03 — Annulation de la réservation à l'initiative du client suite à un avertissement du prestataire

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
- Ne couvre pas l'annulation à l'initiative du client (sans avertissement) → `SPEC-CANCEL-01`
- Ne couvre pas la réduction du nombre de participants → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une prévue le 12 juillet à 10h00 comprenant 5 réservations.
Et que nous sommes le 11 juillet à 18h00.
Par cause de mauvais temps probable le lendemain matin, le prestataire 
envoie un avertissement concernant une possible annulation des sorties 
le lendemain matin.
Deux client ont annulé leurs reservations suite à cet avertissement.
Ces clients doivent être remboursé intégralement, indépendamment de la décision finale d'annulation.
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un client avait annulé sa réservation avant l'avertissement | Le client avait annulé sa réservation avant avertissement et intervention du prestataire. L'annulation sera géré comme une annulation classique à l'initiative du client. |
| 2 | la sortie n'est finalement pas annulé | Le client peut recommencer une procédure de réservation classique.  |


### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- ...

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Les clients recoivent les messages d'avertissement et d'annulation.
- [ ] AC-2 — Les clients peuvent annuler leurs réservations s'ils sont concernés.
- [ ] AC-3 — Les clients sont remboursé intégralement.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
