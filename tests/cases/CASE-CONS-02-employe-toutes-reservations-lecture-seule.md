# CASE-CONS-02 — L'employé voit toutes les réservations en lecture seule

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** `AC-02`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'accès de l'employé à l'intégralité des réservations, en
lecture seule. Si la règle se casse, l'employé pourrait ne voir qu'un
sous-ensemble de réservations (gênant son travail), ou au contraire pouvoir
les modifier alors qu'il ne devrait avoir qu'un accès en consultation.

## Cas

```gherkin
Étant donné un employé connecté
Et 5 réservations appartenant à 4 clients différents dans le système
Quand il consulte les réservations
Alors il voit les 5 réservations, quel qu'en soit le propriétaire
Et aucune action de modification ou d'annulation n'est disponible
```

## Données

| Élément                     |    Valeur |
| ------------------------------ | ----------: |
| Rôle connecté                   |     employé |
| Réservations dans le système    |           5 |
| Clients propriétaires distincts |           4 |

## Résultat attendu, calculé à la main

| Grandeur                       | Valeur attendue | Calcul                        |
| ----------------------------------- | ---------------: | ----------------------------------- |
| Réservations affichées                |                5 | toutes les réservations du système    |
| Actions de modification disponibles   |               non | rôle employé, lecture seule           |

## Ce que ce cas ne vérifie pas

- la consultation par le client (accès restreint à ses propres réservations) → `CASE-CONS-01` ;
- la consultation par l'administrateur (avec actions de gestion) → `CASE-CONS-03` ;
- une tentative concrète de modification bloquée côté employé → `CASE-CONS-05`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_02_employe_voit_toutes_reservations_lecture_seule`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée plusieurs réservations appartenant à des clients différents.
- [ ] Le test connecte un utilisateur avec le rôle « employé ».
- [ ] Le test vérifie que toutes les réservations du système sont visibles par l'employé.
- [ ] Le test vérifie qu'aucune action de modification n'est proposée dans la réponse.
- [ ] Le nom du test contient `CASE_CONS_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
