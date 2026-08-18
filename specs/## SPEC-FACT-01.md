## SPEC-FACT-01 — Facturation hôtel en fin de mois

**Exigence :** REQ-013
**Statut :** brouillon | revue IA faite
**Version :** v1

### Règle

> Les réservations d'un hôtel partenaire sont facturées **en fin de mois**, avec
> une remise de 15 % sur le montant total. Les réservations d'un hôtel annulées
> (annulation météo) ne sont **pas comptabilisées** dans la facture.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la création d'une réservation hôtel → `SPEC-BOOK-02`
- Ne couvre pas le paiement en ligne des clients particuliers → `SPEC-PAY-01`
- Ne couvre pas l'annulation d'un créneau → `SPEC-CANCEL-PRESTATAIRE-02`

### Scénarios nominaux

```gherkin
Étant donné un hôtel partenaire avec des réservations sur le mois
Quand la fin du mois arrive
Alors le total des réservations est facturé à l'hôtel
Et une remise de 15 % est appliquée

Étant donné des réservations d'hôtel annulées à cause de la météo
Quand la facture de fin de mois est établie
Alors ces réservations ne sont pas comptabilisées
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | l'hôtel veut payer en avance ou en retard | Deux options possibles (stockage des réservations jusqu'au paiement OU lien de paiement à date fixe) — question ouverte SPEC-BOOK-02. |
| 2 | l'hôtel a annulé une réservation (hors météo) | La réservation annulée n'est pas comptabilisée (état « annulée »). |

### Ce qui n'est pas défini

- Date fixe ou flexible du paiement en fin de mois (question ouverte du cahier).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Les réservations d'un hôtel sont facturées en fin de mois.
- [ ] AC-2 — Une remise de 15 % est appliquée sur le total.
- [ ] AC-3 — Les réservations annulées ne sont pas comptabilisées.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Cas limite 2 : le barème d'annulation client (SPEC-CANCEL-CLIENT-01) s'applique-t-il aux hôtels ? Un hôtel peut-il annuler lui-même ? | à trancher | |
| Sur quelles réservations le total est-il calculé (confirmées, payées, en attente, refusées) ? | à trancher | |
| Cas limite 1 : deux options non tranchées → spec non validable en l'état (déjà signalé dans SPEC-BOOK-02) | à trancher | Question ouverte cahier |
| La facture de fin de mois est-elle générée automatiquement ou par le patron ? | à trancher | |
| « Fin de mois » : date exacte non précisée (dernier jour, début du mois suivant) | à trancher | |
| AC-1 à AC-3 vérifiables | OK | |

Les refus se reportent aussi dans `docs/journal.md`.
