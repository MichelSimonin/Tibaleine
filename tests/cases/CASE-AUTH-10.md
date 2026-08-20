# CASE-AUTH-10 — Authentification d’un utilisateur hotel

**Spécification :** `SPEC-AUTH-01-A1`
**Critères d'acceptation :** `AC-1`, `AC-2`, `AC-3`, `AC-4`
**Statut :** applicable

## Cas

```gherkin
Étant donné un utilisateur existant ayant le rôle `hotel`
Quand il s’authentifie avec le mécanisme commun aux utilisateurs
Alors l’authentification réussit sans profil hôtel séparé
Et il ne voit que ses propres réservations
Et les fonctions patron et employé lui sont refusées
```

## Test automatisé

**Nom attendu :** `test_CASE_AUTH_10_authentification_role_hotel`
