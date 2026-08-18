# CASE-CONS-03 — L'administrateur voit toutes les réservations avec les actions de gestion

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** `AC-03`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'accès de l'administrateur à l'intégralité des réservations,
accompagné des actions de gestion. Si la règle se casse, le patron pourrait
ne pas voir toutes les réservations, ou se voir refuser les actions de
gestion attendues.

## Cas

```gherkin
Étant donné l'administrateur connecté
Et 5 réservations appartenant à 4 clients différents dans le système
Quand il consulte les réservations
Alors il voit les 5 réservations, quel qu'en soit le propriétaire
Et les actions de gestion (modifier, annuler) sont disponibles pour chacune
```

## Données

| Élément                     |         Valeur |
| ------------------------------ | ---------------: |
| Rôle connecté                   |   administrateur |
| Réservations dans le système    |                 5 |
| Clients propriétaires distincts |                 4 |

## Résultat attendu, calculé à la main

| Grandeur                             | Valeur attendue | Calcul                              |
| ----------------------------------------- | ---------------: | ---------------------------------------- |
| Réservations affichées                      |                5 | toutes les réservations du système        |
| Actions de gestion disponibles                |               oui | rôle administrateur, accès complet         |

## Ce que ce cas ne vérifie pas

- la consultation par le client → `CASE-CONS-01` ;
- la consultation par l'employé (sans actions de gestion) → `CASE-CONS-02` ;
- le déroulement effectif d'une modification ou d'une annulation → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02` ;
- la liste exhaustive des actions de gestion disponibles (non détaillée par la spec).

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_03_administrateur_voit_toutes_reservations_avec_gestion`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée plusieurs réservations appartenant à des clients différents.
- [ ] Le test connecte un utilisateur avec le rôle « administrateur ».
- [ ] Le test vérifie que toutes les réservations du système sont visibles.
- [ ] Le test vérifie que des actions de gestion sont proposées pour chaque réservation.
- [ ] Le nom du test contient `CASE_CONS_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
