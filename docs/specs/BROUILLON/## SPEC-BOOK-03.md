## SPEC-BOOK-03 — Blocage temporaire d'une place (réservations simultanées)

**Exigence :** REQ-019
**Statut :** brouillon
**Version :** v1

### Règle

> Une place est bloquée temporairement dès que l'utilisateur clique sur
> « Réserver » et arrive sur le formulaire. Au passage au paiement, un délai
> d'environ 15 minutes lui est accordé. Si le paiement n'est pas effectué dans
> ce délai, la place redevient disponible. Ce mécanisme évite que deux clients
> achètent la même place au même moment.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la consultation des créneaux disponibles → `SPEC-DISP-01`
- Ne couvre pas la création d'une réservation → `SPEC-BOOK-01`
- Ne couvre pas le paiement en ligne → `SPEC-PAY-01`

### Scénarios nominaux

```gherkin
Étant donné une place restante sur un créneau
Quand un premier client clique sur « Réserver »
Alors la place est bloquée temporairement pendant sa saisie

Étant donné une place bloquée pendant la phase de paiement
Quand le client ne paie pas dans les 15 minutes
Alors la place redevient disponible

Étant donné un deuxième client tentant de réserver la même place
Quand la place est bloquée par le premier client
Alors le deuxième client ne peut pas réserver cette place
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le client abandonne le formulaire sans payer | La place est libérée (fin du blocage). |
| 2 | le client paie dans les 15 minutes | La place reste acquise, la réservation passe « payée ». |
| 3 | le délai expire puis le client paie quand même | (À préciser) le paiement est refusé ou la place est déjà rendue disponible. |
| 4 | deux clients réservent en même temps | Test de concurrence à prévoir (CR-04/Q61) : une seule réservation aboutit. |

### Ce qui n'est pas défini

- Durée du blocage pendant la phase formulaire (avant paiement) : même durée que les 15 minutes ou différente ?
- Comportement si le délai expire alors que le client paie (cas limite 3).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — La place est bloquée dès l'arrivée sur le formulaire.
- [ ] AC-2 — La place est libérée si le paiement n'est pas fait sous 15 minutes.
- [ ] AC-3 — Deux clients ne peuvent pas acheter la même place simultanément.
- [ ] AC-4 — Un test de réservations simultanées est réalisé.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
