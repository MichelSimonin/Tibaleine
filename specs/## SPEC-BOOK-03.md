## SPEC-BOOK-03 — Blocage temporaire d'une place (réservations simultanées)

**Exigence :** REQ-019
**Statut :** revue IA faite
**Version :** v1
**Amendée par :** `SPEC-BOOK-03-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-BOOK-03-A1`.


### Règle

> Une place est bloquée temporairement dès que l'utilisateur clique sur
> « Réserver » et arrive sur le formulaire, pour une durée de 15 minutes. Au passage au paiement, un nouveau délai
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
| 3 | le délai expire puis le client paie quand même | (À préciser) le paiement est refusé et la place est déjà rendue disponible aux autres usagers. |
| 4 | deux clients réservent en même temps | Une seule réservation aboutit : la première requête qui aboutit bloque la place, le second client est bloqué et voit une erreur. |

### Ce qui n'est pas défini

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
| Cas limite 4 : parenthèses imbriquées / artefact d'édition | corrigée | Reformulé |
| Cas limite 3 (délai expiré puis paiement) reste « à préciser » | à trancher | Question ouverte |
| Durée du blocage en phase formulaire (avant paiement) non définie | à trancher | Déjà noté dans « Ce qui n'est pas défini » |
| AC-4 « un test de réservations simultanées est réalisé » est une consigne de test, pas un critère observable | à trancher | Préciser le comportement à vérifier |

Les refus se reportent aussi dans `docs/journal.md`.
