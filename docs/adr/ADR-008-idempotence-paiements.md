# ADR-008 — Idempotence des paiements en ligne

**Statut :** proposé
**Date :** 20/08/2026
**Décidé par :** l'équipe 200ping
**S'appuie sur :** `ADR-002-paiement.md` (Stripe), `ADR-005-blocage-places.md`

---

## Contexte

Avec le paiement intégral en un seul bloc, `ADR-002` n'avait pas besoin de
traiter la répétition d'une confirmation : un seul événement de paiement
existait par réservation. Le cahier des charges V5 (CR-05) introduit
plusieurs opérations financières distinctes par réservation — acompte
(toujours en ligne), solde (en ligne entre H-24 et H-12, puis sur place),
complément (après modification), remboursement (`R-42`, `R-52`, `R-54`,
contrainte 15) — et exige explicitement qu'aucune ne soit « enregistrée deux
fois » (`REQ-108`).

Deux risques concrets apparaissent avec ce découpage :

1. une confirmation de paiement en ligne (webhook du prestataire) reçue en
   double crée un second paiement et décrémente les places une seconde fois ;
2. un paiement du solde initié juste avant l'échéance H-12 mais confirmé
   après peut se heurter à un encaissement sur place saisi entre-temps par
   le patron pour la même réservation (`SPEC-PAY-BALANCE-02-A1`,
   `SPEC-BOOK-03-A1`).

## Options envisagées

### Option A — Confiance au prestataire de paiement, aucune garde applicative

| | |
|---|---|
| Ce qu'elle apporte | rien à développer |
| Ce qu'elle coûte | un webhook rejoué (retry réseau, chose courante chez Stripe) crée un second paiement et une seconde décrémentation de places |
| Ce qu'elle rend difficile plus tard | correction a posteriori des doublons, remboursements manuels supplémentaires (`R-49`) |

### Option B — Référence externe unique par tentative, vérifiée avant tout encaissement

| | |
|---|---|
| Ce qu'elle apporte | une confirmation portant une référence déjà traitée est reconnue et renvoie le résultat existant, sans nouvel effet ; avant tout encaissement sur place, on vérifie qu'aucun paiement en ligne n'est déjà payé ou en cours pour la réservation |
| Ce qu'elle coûte | modélisation supplémentaire (`Paiement.reference_externe` unique, statut `en_attente \| paye \| echoue \| impaye`, `date_initiation`/`date_confirmation`) |
| Ce qu'elle rend difficile plus tard | — |

## Décision

Chaque tentative de paiement en ligne porte une **référence externe
unique**. Une confirmation portant une référence déjà traitée est reconnue
et ne produit **aucun second paiement, aucune seconde décrémentation de
places**. Avant d'enregistrer un paiement sur place, le système vérifie
qu'aucun paiement en ligne n'est déjà payé ou en cours pour la même
réservation.

## Raisons

- `REQ-108` et la contrainte 15 du cahier V5 exigent explicitement qu'une
  opération financière ne soit pas enregistrée deux fois ;
- un paiement du solde initié avant H-12 doit pouvoir être confirmé après
  (`SPEC-PAY-BALANCE-02-A1`, `SPEC-BOOK-03-A1`) sans ouvrir de fenêtre de
  double encaissement avec le paiement sur place ;
- `SPEC-SYST-01-A1` étend cette règle à toute confirmation reçue du
  prestataire de paiement, pas seulement à l'acompte.

## Conséquences acceptées

- toute création de paiement passe désormais par une vérification
  d'unicité, y compris l'enregistrement manuel du patron (paiement sur
  place) ;
- un cas résiduel rarissime reste possible (confirmation en ligne et saisie
  sur place à quelques instants d'écart) ; il est accepté et corrigé
  manuellement par le patron, cohérent avec le remboursement manuel déjà
  retenu (`R-49`) ;
- s'appuie sur `ADR-002` (Stripe fournit les webhooks nécessaires à cette
  vérification) ; reste distinct d'`ADR-005` (le blocage temporaire des
  places protège la phase de réservation, pas la confirmation du paiement
  lui-même).

## Ce qui nous ferait revenir dessus

- si un volume de doublons résiduels devenait significatif malgré cette
  garde, justifiant un mécanisme plus strict (contrainte d'unicité en base,
  verrou transactionnel explicite).
