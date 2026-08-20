# CASE-BOOK-02-A1 — Réservation immédiate par un hôtel

**Spécifications :** `SPEC-BOOK-02-A1`, `SPEC-PAY-01-A1`
**Critères d'acceptation :** `SPEC-BOOK-02-A1/AC-1`, `AC-2`, `AC-3`, `AC-6`; `SPEC-PAY-01-A1/AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-BOOK-02`
**Motif :** supprimer l’acompte et la validation manuelle pour une réservation hôtel.

## Cas

```gherkin
Étant donné un utilisateur authentifié ayant le rôle `hotel`
Et un créneau disposant de quatre places
Quand il réserve quatre places
Alors la réservation est immédiatement créée à l’état « réservée »
Et son statut de paiement est « en attente de paiement »
Et aucun acompte ni validation manuelle du patron n’est demandé
Et le patron est informé de la création
```

## Résultat attendu

La réservation hôtel est active immédiatement et sera réglée par la facturation mensuelle.

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_02_A1_reservation_hotel_immediate`
