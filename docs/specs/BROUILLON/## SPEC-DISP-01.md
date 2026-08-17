## SPEC-DISP-01 — Consultation des créneaux disponibles

**Exigence :** REQ-008
**Statut :** brouillon
**Version :** v1

### Règle

> Un client peut consulter les créneaux disponibles (date, heure, places
> restantes) avant de réserver. Un créneau complet est affiché comme
> indisponible. Lorsqu'un créneau complet redevient disponible (annulation,
> délai de paiement dépassé), le site affiche un badge « nouvelle place
> disponible ».

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la création d'une réservation → `SPEC-BOOK-01`
- Ne couvre pas l'alerte météo affichée sur le site → `SPEC-ALERT-01`
- Ne couvre pas le blocage temporaire d'une place → `SPEC-BOOK-01` (cas limite)

### Scénarios nominaux

```gherkin
Étant donné une sortie baleine le 12 juillet à 10h00 avec 4 places restantes
Quand un client consulte le calendrier
Alors le créneau est affiché comme disponible avec 4 places restantes

Étant donné un créneau complet
Quand une annulation libère une place
Alors le site affiche un badge « nouvelle place disponible » sur ce créneau
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | créneau complet (0 place restante) | Le créneau est affiché comme indisponible, la réservation est bloquée. |
| 2 | place libérée après expiration du délai de paiement (15 min) | Le badge « nouvelle place disponible » est affiché. |
| 3 | avertissement météo envoyé (18 h la veille) | Une alerte est affichée sur le site pour les créneaux concernés (voir SPEC-ALERT-01). |
| 4 | créneau du jour à moins de 2 h du départ | La réservation est bloquée (réservation impossible à moins de 2 h). |

### Ce qui n'est pas défini

- Format d'affichage exact du calendrier (vue jour / semaine / mois).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un client voit les créneaux disponibles avec le nombre de places restantes.
- [ ] AC-2 — Un créneau complet est affiché comme indisponible.
- [ ] AC-3 — Un badge « nouvelle place disponible » apparaît quand un créneau complet redevient disponible.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
