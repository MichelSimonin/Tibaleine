## SPEC-MODIF-01 — Modification d'une réservation

**Exigence :** REQ-010
**Statut :** brouillon
**Version :** v1

### Règle

> Une réservation peut être modifiée (report, ajout ou suppression de
> participants). La demande de modification s'effectue par téléphone. Une
> réservation non payée n'est modifiable que si son état est « en attente ».
> Après paiement, l'ajout de participants entraîne le paiement d'un supplément
> (lien de paiement envoyé par mail) ; la suppression de participants suit le
> circuit du remboursement.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le remboursement d'une annulation → `SPEC-CANCEL-01`
- Ne couvre pas le report après annulation météo → `SPEC-CANCEL-02`, `SPEC-CANCEL-03`

### Scénarios nominaux

```gherkin
Étant donné une réservation en attente de 2 personnes
Quand le client demande par téléphone d'ajouter 1 personne
Alors le patron modifie la réservation

Étant donné une réservation payée
Quand le patron ajoute 1 participant (signalé assez tôt, moins de 2 h avant le départ)
Alors un supplément est dû
Et un mail avec le lien de paiement du supplément est envoyé au client

Étant donné une réservation payée
Quand un participant est supprimé
Alors le remboursement est calculé selon les conditions d'annulation
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | ajout de participant moins de 2 h avant le départ | La modification n'est pas possible (délai dépassé). |
| 2 | suppression de participant | Remboursement calculé selon les conditions d'annulation (même circuit que le remboursement). |
| 3 | modification d'une réservation payée | Possible uniquement par le patron, sous réserve du délai. |
| 4 | la modification dépasse la capacité du bateau | La modification est refusée. |

### Ce qui n'est pas défini

- Modification en ligne par le client (question ouverte : le client doit-il obligatoirement passer par téléphone ?).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Une demande de modification s'effectue par téléphone.
- [ ] AC-2 — Le patron peut modifier une réservation en attente.
- [ ] AC-3 — Après paiement, un ajout de participant entraîne un supplément payé par mail.
- [ ] AC-4 — Une suppression de participant suit le circuit du remboursement.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
