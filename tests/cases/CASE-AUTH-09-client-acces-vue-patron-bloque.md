# CASE-AUTH-09 — Un client ne peut pas accéder à la vue patron

**Statut :** applicable
**Nom attendu :** `test_CASE_AUTH_09`

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-05`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'étanchéité entre les rôles : un client (rôle
« utilisateur ») ne doit pas pouvoir accéder aux fonctions réservées à
l'administrateur. Si la règle se casse, un client pourrait consulter ou
modifier les réservations d'autres clients, ou accéder aux fonctions de
gestion du patron.

## Cas

```gherkin
Étant donné un client connecté avec le rôle « utilisateur »
Quand il tente d'accéder à l'espace de gestion réservé à l'administrateur
Alors l'accès est bloqué
```

## Données

| Élément            |                       Valeur |
| --------------------- | -----------------------------: |
| Rôle du compte connecté |                   utilisateur |
| Ressource demandée      | espace de gestion administrateur |

## Résultat attendu, calculé à la main

| Grandeur      | Valeur attendue | Calcul                              |
| ---------------- | ---------------: | ---------------------------------------- |
| Accès accordé      |               non | vue non autorisée pour le rôle « utilisateur » |

## Ce que ce cas ne vérifie pas

- l'accès employé à ce même espace (autorisé en lecture seule — cas différent) → `CASE-AUTH-07` ;
- l'accès administrateur → `CASE-AUTH-08` ;
- une tentative d'un employé d'accéder aux fonctions patron (cas symétrique non explicitement couvert par la spec, à envisager séparément) ;
- l'accès d'un client aux réservations d'un autre client → `SPEC-CONS-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_09_client_acces_vue_patron_bloque`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un utilisateur avec le rôle « utilisateur ».
- [ ] Le test tente d'accéder à l'espace de gestion administrateur.
- [ ] Le test vérifie que l'accès est refusé.
- [ ] Le nom du test contient `CASE_AUTH_09`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
