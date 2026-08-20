# CASE-HOTEL-01-A1 — Hôtel représenté par un utilisateur avec rôle

**Spécifications :** `SPEC-HOTEL-01-A1`, `SPEC-AUTH-01-A1`
**Critères d'acceptation :** `SPEC-HOTEL-01-A1/AC-1`, `AC-2`, `AC-3`; `SPEC-AUTH-01-A1/AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-HOTEL-01`
**Motif :** supprimer la notion de compte ou profil hôtel séparé.

## Cas

```gherkin
Étant donné un utilisateur existant auquel le patron attribue le rôle `hotel`
Quand cet utilisateur est associé à une réservation hôtel
Alors le système reconnaît la réservation comme appartenant à un hôtel
Et le patron peut identifier l’utilisateur associé
Et aucun second compte, profil ou objet hôtel n’est créé
```

## Test automatisé

**Nom attendu :** `test_CASE_HOTEL_01_A1_role_hotel_sans_profil`
