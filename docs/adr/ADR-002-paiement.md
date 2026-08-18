# ADR-002 — Prestataire de paiement en ligne

**Statut :** proposé
**Date :** 18/08/2026
**Décidé par :** l'équipe 200ping

---

## Contexte

Le client doit payer sa réservation en ligne (`REQ-006`). Il faut un prestataire
capable de gérer l'encaissement, les échecs de paiement (carte refusée, service
indisponible — `SPEC-PAY-01` cas limite 2) et les remboursements selon le barème
d'annulation (`REQ-009`, `REQ-017`, `REQ-018`).

## Options envisagées

### Option A — Stripe

| | |
|---|---|
| Ce qu'elle apporte | API simple, sandbox dédiée aux tests, remboursements partiels natifs, webhooks, intégration Symfony (bundle) |
| Ce qu'elle coûte | commission par transaction (~1,4 % + 0,25 € en UE) |
| Ce qu'elle rend difficile plus tard | dépendance à un tiers, nécessite un compte marchand |

### Option B — PayPal

| | |
|---|---|
| Ce qu'elle apporte | très répandu, confiance des utilisateurs |
| Ce qu'elle coûte | commission plus élevée, API plus lourde |
| Ce qu'elle rend difficile plus tard | intégration moins directe, remboursements partiels moins simples |

## Décision

Nous utilisons **Stripe** comme prestataire de paiement en ligne.

## Raisons

- sandbox dédiée → les cases `CASE-PAY-*` sont exécutables sans carte réelle ;
- remboursements partiels natifs, adaptés au barème de `SPEC-CANCEL-CLIENT-01` ;
- cohérent avec l'ADR-001 (intégration Symfony retenue).

## Conséquences acceptées

- commission par transaction, à intégrer dans la facturation ;
- gestion des webhooks (échec, indisponibilité) à prévoir (`SPEC-SYST-01`).

## Ce qui nous ferait revenir dessus

- Si le client refuse Stripe ou impose un autre prestataire.
