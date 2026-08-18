# ADR-004 — Canaux de notification (SMS, mail, alerte site)

**Statut :** proposé
**Date :** 18/08/2026
**Décidé par :** l'équipe 200ping

---

## Contexte

Les clients doivent être prévenus : confirmation de réservation (`REQ-001`),
avertissement météo la veille à 18 h puis annulation (`REQ-016`, `REQ-017`),
remboursement après annulation (`REQ-018`). Les hôtels sont prévenus par
téléphone et sortent des canaux automatiques.

## Options envisagées

### Option A — Table `Notification` (sms | email | popup_site)

| | |
|---|---|
| Ce qu'elle apporte | trace de tous les envois, plusieurs canaux, audit possible |
| Ce qu'elle coûte | une table supplémentaire |
| Ce qu'elle rend difficile plus tard | — |

### Option B — Envoi direct sans trace

| | |
|---|---|
| Ce qu'elle apporte | plus simple |
| Ce qu'elle coûte | impossible de vérifier l'heure d'envoi (18 h) ni de prouver l'envoi |
| Ce qu'elle rend difficile plus tard | audit, tests, débogage |

## Décision

Une table **`Notification`** trace chaque envoi, avec le canal
(`sms | email | popup_site`) et la date d'envoi.

## Raisons

- l'avertissement à 18 h et l'annulation ≥ 2 h avant sont vérifiables par la
  date d'envoi (`SPEC-CANCEL-PRESTATAIRE-02`) ;
- le message est envoyé dans la langue du client (`SPEC-LANG-01`).

## Conséquences acceptées

- volume d'enregistrements en base ;
- un service d'envoi SMS à choisir (prestataire externe).

## Ce qui nous ferait revenir dessus

- Si le besoin d'audit des envois disparaissait.
