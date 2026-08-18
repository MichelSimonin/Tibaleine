## SPEC-ALERT-01 — Avertissement météo et notifications automatiques

**Exigence :** REQ-016
**Statut :** validé
**Version :** v1

### Règle

> En cas de risque de mauvaises conditions météo, l'administrateur envoie un
> **avertissement** la veille à 18 h par SMS et/ou mail (message personnalisable,
> depuis le numéro de l'entreprise, en français et en anglais). Une **alerte** est
> également affichée sur le site pour les clients qui réserveraient après 18 h.
> En cas d'annulation définitive, les clients concernés sont prévenus
> automatiquement par SMS et/ou mail, **au même moment**. L'alerte précise que le
> client peut annuler sa réservation sans frais.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas les règles de remboursement liées → `SPEC-CANCEL-02`, `SPEC-CANCEL-03`
- Ne couvre pas la décision d'annulation par créneau → `SPEC-CANCEL-02`
- Ne couvre pas les hôtels (prévenus par téléphone) → `SPEC-CANCEL-02` (cas 2)

### Scénarios nominaux

```gherkin
Étant donné un risque de mauvais temps le lendemain matin
Quand l'administrateur déclenche l'avertissement la veille à 18 h
Alors les clients des créneaux concernés reçoivent un SMS et/ou un mail
Et une alerte est affichée sur le site pour les créneaux concernés

Étant donné une annulation définitive décidée par l'administrateur
Quand l'annulation est confirmée (au moins 2 h avant le départ)
Alors tous les clients concernés sont prévenus automatiquement au même moment
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un client réserve après l'avertissement de 18 h | Il ne reçoit pas de SMS/mail, mais l'alerte est affichée sur le site pour son créneau. |
| 2 | le message doit être personnalisé | L'administrateur peut personnaliser le message (raison de l'annulation). |
| 3 | client étranger | Le message est envoyé en français et en anglais. |
| 4 | hôtel concerné par l'annulation | L'hôtel n'est pas notifié par SMS/mail : il est appelé directement. |
| 5 | le service d'envoi (SMS) est indisponible | Le système gère l'indisponibilité du service externe sans bloquer l'application. |

### Ce qui n'est pas défini

- Comportement exact en cas d'indisponibilité d'un service externe (ambiguïté du CR-04 §6).
- L'heure de décision « vers 5 h » de l'annulation définitive (à confirmer, CR-04 §5).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — L'administrateur peut envoyer l'avertissement la veille à 18 h.
- [ ] AC-2 — Les clients concernés reçoivent l'avertissement et l'annulation par SMS et/ou mail.
- [ ] AC-3 — Une alerte est affichée sur le site pour les créneaux concernés.
- [ ] AC-4 — Le message peut être personnalisé et envoyé en français et en anglais.
- [ ] AC-5 — Les clients sont prévenus au même moment en cas d'annulation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
