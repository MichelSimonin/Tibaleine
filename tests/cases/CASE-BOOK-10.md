# CASE-BOOK-10 — Privatisation refusée pour un hôtel

**Spécification :** `SPEC-BOOK-02-A1`
**Critère d'acceptation :** `AC-5`
**Statut :** applicable

## Cas

```gherkin
Étant donné un utilisateur authentifié ayant le rôle `hotel`
Quand il demande la privatisation d’un créneau
Alors la réservation est refusée
Et aucune place n’est réservée
Et aucun paiement n’est créé
```

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_10_privatisation_refusee_hotel`
