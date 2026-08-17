## SPEC-CANCEL-03 — Annulation de la réservation à l'initiative du client suite à un avertissement du prestataire

**Exigence :** REQ-018
**Statut :** brouillon | revue IA faite
**Version :** v1

### Règle

> Si un client annule sa réservation pendant la phase d'avertissement (après
> avoir reçu l'avertissement du prestataire), il est remboursé intégralement,
> indépendamment de la décision finale d'annulation de la sortie.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas l'annulation à l'initiative du prestataire → `SPEC-CANCEL-02`
- Ne couvre pas l'annulation à l'initiative du client (sans avertissement) → `SPEC-CANCEL-01`
- Ne couvre pas la réduction du nombre de participants → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une sortie prévue le 12 juillet à 10h00 comprenant 5 réservations
Et que nous sommes le 11 juillet à 18h00
Par cause de mauvais temps probable le lendemain matin, le prestataire
envoie un avertissement concernant une possible annulation des sorties
le lendemain matin
Quand deux clients annulent leurs réservations suite à cet avertissement
Alors ces clients sont remboursés intégralement, indépendamment de la décision finale d'annulation
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un client avait annulé sa réservation avant l'avertissement | Le client avait annulé sa réservation avant avertissement et intervention du prestataire. L'annulation sera géré comme une annulation classique à l'initiative du client. |
| 2 | la sortie n'est finalement pas annulée | Le client peut recommencer une procédure de réservation classique. |
| 3 | un client annule après l'avertissement alors que la sortie est finalement maintenue | Il est tout de même remboursé à 100 % (indépendant de la décision finale). |


### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Détection du fait qu'un client « a reçu l'avertissement » : à tracer (table `Notification`, MCD V2) — sinon le remboursement à 100 % est inapplicable.
- Exécution du remboursement : manuelle par le patron (R-49).
- Cas limite 2 : que devient la réservation d'origine du client (annulée) si la sortie est maintenue ? Le client refait-il une demande ou sa réservation est-elle réactivée ?

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Les clients recoivent les messages d'avertissement et d'annulation.
- [ ] AC-2 — Les clients peuvent annuler leurs réservations s'ils sont concernés.
- [ ] AC-3 — Les clients sont remboursés intégralement.
- [ ] AC-4 — Le système peut déterminer qu'un client a reçu l'avertissement (trace des notifications).

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| La « Règle » reprenait le barème client de SPEC-CANCEL-01 | corrigée | Remplacée par la règle « annulation après avertissement → 100 % » |
| Scénario Gherkin mal formé | corrigée | |
| Condition du 100 % : comment savoir qu'un client « a reçu l'avertissement » ? | à trancher | Nécessite la trace des notifications (MCD V2) |
| Cas 2 : que devient la réservation d'origine si la sortie est maintenue ? | à trancher | |
| Exécution du remboursement manuelle (R-49) non précisée | à trancher | |

Les refus se reportent aussi dans `docs/journal.md`.
