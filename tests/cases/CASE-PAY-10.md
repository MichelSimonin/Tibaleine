# CASE-PAY-10 — Réservation créée entre H-24 et H-12

**Spécification :** `SPEC-PAY-BALANCE-02`
**Critères d'acceptation :** `AC-3`, `AC-7`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation créée 18 heures avant le départ
Et un acompte confirmé en ligne
Quand le client choisit le règlement du solde
Alors il peut payer le solde immédiatement en ligne avant H-12
Ou choisir de le régler sur place
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_10_reservation_entre_h24_h12`
