# CASE-CONS-06 — Le client sans réservation voit un message dédié

**Statut :** applicable
**Nom attendu :** `test_CASE_CONS_06`

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** — (cas limite 3, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'affichage d'un message explicite lorsqu'un client n'a
aucune réservation, plutôt qu'une liste vide ou une erreur technique. Si la
règle se casse, un client sans réservation pourrait voir un écran vide sans
explication, ou une erreur perturbant l'expérience.

## Cas

```gherkin
Étant donné un client connecté n'ayant aucune réservation
Quand il consulte ses réservations
Alors il voit un message « aucune réservation »
```

## Données

| Élément            |   Valeur |
| ---------------------- | ---------: |
| Réservations du client   |          0 |

## Résultat attendu, calculé à la main

| Grandeur          | Valeur attendue         | Calcul                     |
| -------------------- | -------------------------: | -------------------------------- |
| Réservations affichées |                          0 | aucune réservation existante       |
| Message affiché         | « aucune réservation »   | résultat attendu de la spec        |

## Ce que ce cas ne vérifie pas

- la consultation lorsque le client a des réservations → `CASE-CONS-01` ;
- le comportement de l'employé ou de l'administrateur en l'absence de réservations dans le système (cas différent, non couvert par la spec).

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_06_aucune_reservation_message_affiche`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un client n'ayant aucune réservation.
- [ ] Le test consulte les réservations de ce client.
- [ ] Le test vérifie qu'aucune réservation n'est retournée.
- [ ] Le test vérifie que le message « aucune réservation » est affiché.
- [ ] Le nom du test contient `CASE_CONS_06`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-CONS-01` —
il matérialise le « cas limite 3 » de cette spec (ligne 46), qui n'a pas de
critère d'acceptation dédié.
