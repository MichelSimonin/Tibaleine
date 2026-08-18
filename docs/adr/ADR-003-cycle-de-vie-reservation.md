# ADR-003 — Cycle de vie d'une réservation : `payée | annulée`

**Statut :** proposé
**Date :** 18/08/2026
**Décidé par :** l'équipe 200ping

---

## Contexte

Le modèle doit décrire l'état d'une réservation pour gérer le paiement
(`REQ-006`), l'annulation et les remboursements (`REQ-007`, `REQ-009`,
`REQ-017`, `REQ-018`). Le client réserve en ligne puis paie ; il n'y a pas
d'étape manuelle entre les deux.

## Options envisagées

### Option A — Deux états : `payée | annulée`

| | |
|---|---|
| Ce qu'elle apporte | simple, sans validation intermédiaire : le client réserve et paie |
| Ce qu'elle coûte | pas d'état « réservé non payé » persistant |
| Ce qu'elle rend difficile plus tard | tracer une réservation avant son paiement |

### Option B — Trois états : `réservée | payée | annulée`

| | |
|---|---|
| Ce qu'elle apporte | trace une réservation avant son paiement |
| Ce qu'elle coûte | un état intermédiaire à gérer et à libérer |
| Ce qu'elle rend difficile plus tard | — |

## Décision

`Reservation.etat` vaut **`payée`** après paiement et **`annulée`** après une
annulation.

## Raisons

- « le client réserve, tout se fait de manière automatique sur le site/application » : pas de validation patron (les AC-4/5 de `SPEC-BOOK-01` ont été supprimés) ;
- le remboursement s'appuie sur l'état de la réservation et les notifications, pas sur un état de validation (`SPEC-CANCEL-*`).

## Conséquences acceptées

- une réservation non payée n'est pas persistée comme état dédié ;
- la modification (`REQ-010`) porte sur une réservation payée (`SPEC-MODIF-01`).

## Ce qui nous ferait revenir dessus

- Si le besoin de tracer des réservations non payées apparaît.
