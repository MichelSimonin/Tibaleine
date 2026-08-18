# CASE-AUTH-07 — L'employé accède aux réservations en lecture seule

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-03`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la limitation du rôle « employé » à la seule consultation des
réservations. Si la règle se casse, un employé pourrait modifier ou annuler
des réservations sans en avoir le droit.

## Cas

```gherkin
Étant donné un employé connecté
Quand il ouvre l'espace de gestion et consulte les réservations
Alors il voit toutes les réservations en lecture seule
Et toute tentative de modification ou d'annulation est bloquée
```

## Données

| Élément | Valeur |
| --------- | -------: |
| Rôle      | employé |

## Résultat attendu, calculé à la main

| Grandeur                | Valeur attendue | Calcul                    |
| --------------------------- | ---------------: | ------------------------------ |
| Consultation des réservations |          autorisée | rôle employé                    |
| Modification d'une réservation |            bloquée | rôle employé (lecture seule)    |
| Annulation d'une réservation   |            bloquée | rôle employé (lecture seule)    |

## Ce que ce cas ne vérifie pas

- l'accès administrateur (accès complet) → `CASE-AUTH-08` ;
- le contenu détaillé de la consultation des réservations → `SPEC-CONS-01` ;
- une tentative d'accès à la vue patron par l'employé (non couvert par un cas limite documenté dans la spec, à envisager séparément).

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_07_employe_lecture_seule`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un utilisateur avec le rôle « employé ».
- [ ] Le test vérifie l'accès en consultation aux réservations.
- [ ] Le test vérifie qu'une tentative de modification est bloquée.
- [ ] Le test vérifie qu'une tentative d'annulation est bloquée.
- [ ] Le nom du test contient `CASE_AUTH_07`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
