## SPEC-SYST-01 — Disponibilité des services externes

**Exigence :** REQ-020
**Statut :** brouillon
**Version :** v1

### Règle

> Le système vérifie la disponibilité des services externes utilisés par
> l'application (paiement, SMS, email) et gère leur indisponibilité afin qu'une
> panne d'un service tiers ne bloque ni ne perturbe le fonctionnement de
> l'application.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la sécurité de l'application (failles) → `REQ-103`
- Ne couvre pas le paiement en ligne → `SPEC-PAY-01`
- Ne couvre pas l'envoi des alertes/annulations → `SPEC-ALERT-01`

### Scénarios nominaux

```gherkin
Étant donné un service de paiement indisponible
Quand un client tente de payer
Alors le système gère l'indisponibilité sans panne
Et le client est informé du problème

Étant donné un service SMS indisponible
Quand un avertissement ou une annulation doit être envoyé
Alors le système gère l'indisponibilité sans bloquer l'application
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le service de paiement est indisponible | Le client ne peut pas payer mais l'application reste fonctionnelle (message d'erreur adapté). |
| 2 | le service SMS est indisponible lors d'une annulation | (À préciser) la notification est-elle reportée, passée en mail, ou perdue ? |
| 3 | le service email est indisponible | (À préciser) comportement dégradé attendu. |

### Ce qui n'est pas défini

- Comportement exact en cas de panne d'un service externe (ambiguïté du CR-04 §6).
- Stratégie de reprise (nouvelle tentative, file d'attente) en cas de panne.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le système détecte l'indisponibilité d'un service externe.
- [ ] AC-2 — Une panne d'un service externe ne bloque pas l'application.
- [ ] AC-3 — Le client est informé en cas d'indisponibilité du service concerné.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
