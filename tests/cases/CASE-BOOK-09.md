# CASE-BOOK-09 — Concurrence sur la dernière place

**Spécification :** `SPEC-BOOK-03-A1`
**Critère d'acceptation :** `AC-6`
**Statut :** applicable

## Cas

```gherkin
Étant donné un créneau avec une seule place encore disponible
Et deux clients qui demandent cette place simultanément
Quand les deux demandes sont traitées
Alors une seule réservation au maximum est confirmée
Et l’autre client reçoit un refus de disponibilité
Et le nombre de places restantes n’est jamais négatif
```

## Test automatisé

**Nom attendu :** `test_CASE_BOOK_09_concurrence_derniere_place`
