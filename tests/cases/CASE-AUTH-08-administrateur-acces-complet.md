# CASE-AUTH-08 — L'administrateur a un accès complet

**Statut :** applicable
**Nom attendu :** `test_CASE_AUTH_08`

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-04`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'accès complet de l'administrateur (le patron) à la gestion
des réservations. Si la règle se casse, le patron pourrait se retrouver
limité dans la gestion de son activité (impossibilité de modifier ou
d'annuler une réservation).

## Cas

```gherkin
Étant donné l'administrateur connecté
Quand il ouvre l'espace de gestion
Alors il peut consulter n'importe quelle réservation
Et il peut modifier n'importe quelle réservation
Et il peut annuler n'importe quelle réservation
```

## Données

| Élément | Valeur |
| --------- | -------: |
| Rôle      | administrateur |

## Résultat attendu, calculé à la main

| Grandeur                | Valeur attendue | Calcul                        |
| --------------------------- | ---------------: | ---------------------------------- |
| Consultation des réservations |          autorisée | rôle administrateur                 |
| Modification d'une réservation |          autorisée | rôle administrateur                 |
| Annulation d'une réservation   |          autorisée | rôle administrateur                 |

## Ce que ce cas ne vérifie pas

- l'accès employé (lecture seule) → `CASE-AUTH-07` ;
- la mécanique de modification ou d'annulation elle-même (barèmes, formulaires) → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02` ;
- la création d'un compte administrateur (hors périmètre, non défini par la spec).

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_08_administrateur_acces_complet`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un utilisateur avec le rôle « administrateur ».
- [ ] Le test vérifie l'accès en consultation à une réservation quelconque.
- [ ] Le test vérifie l'accès en modification à une réservation quelconque.
- [ ] Le test vérifie l'accès en annulation à une réservation quelconque.
- [ ] Le nom du test contient `CASE_AUTH_08`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
