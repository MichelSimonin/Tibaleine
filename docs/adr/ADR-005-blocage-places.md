# ADR-005 — Blocage temporaire des places (15 min)

**Statut :** proposé
**Date :** 18/08/2026
**Décidé par :** l'équipe 200ping

---

## Contexte

Deux clients peuvent tenter de réserver la même place au même moment
(`REQ-019`). Il faut un mécanisme qui bloque temporairement une place pendant
la saisie puis le paiement, et la libère ensuite.

## Options envisagées

### Option A — Blocage temporisé : 15 min au formulaire, puis 15 min au paiement

| | |
|---|---|
| Ce qu'elle apporte | évite les doubles réservations ; durée conforme à CR-04/Q61 |
| Ce qu'elle coûte | un mécanisme d'expiration (horodatage + libération) |
| Ce qu'elle rend difficile plus tard | gérer le cas « délai expiré puis paiement » |

### Option B — Aucun blocage (premier paiement, premier servi)

| | |
|---|---|
| Ce qu'elle apporte | plus simple |
| Ce qu'elle coûte | deux clients peuvent payer la même place, conflit à résoudre a posteriori |
| Ce qu'elle rend difficile plus tard | gestion des surréservations |

## Décision

Une place est bloquée dès le clic sur « Réserver » (15 min en phase
formulaire), puis 15 min supplémentaires au paiement ; au-delà, la place
redevient disponible.

## Raisons

- décision client (CR-04/Q61) : 15 min accordées au paiement ;
- durée du blocage en phase formulaire alignée sur 15 min (décision d'équipe).

## Conséquences acceptées

- le cas « paiement après expiration » reste à préciser (`SPEC-BOOK-03`
  cas limite 3) ;
- les places bloquées doivent être comptées dans la disponibilité affichée.

## Ce qui nous ferait revenir dessus

- Si le taux d'abandon montre que 15 min est trop court ou trop long.
