# CASE-HOTEL-03-A1 — Consultation limitée pour le rôle hotel

**Spécifications :** `SPEC-HOTEL-01-A1`, `SPEC-AUTH-01-A1`
**Critères d'acceptation :** `SPEC-AUTH-01-A1/AC-2`, `AC-3`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-HOTEL-03`
**Motif :** limiter l’hôtel à ses réservations sans privilèges patron ou employé.

## Cas

```gherkin
Étant donné un utilisateur authentifié ayant le rôle `hotel`
Et deux réservations qui lui appartiennent et trois réservations étrangères
Quand il consulte les réservations
Alors seules ses deux réservations sont visibles
Et les fonctions réservées au patron ou aux employés lui sont refusées
```

## Test automatisé

**Nom attendu :** `test_CASE_HOTEL_03_A1_acces_limite`
