# CASE-CONS-01 — Le client ne voit que ses propres réservations

**Statut :** remplacé

**Amendé par :** `CASE-CONS-01-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-CONS-01-A1`.

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** `AC-01`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la restriction de la consultation aux seules réservations du
client connecté. Si la règle se casse, un client pourrait voir les
réservations d'un autre client, exposant des données personnelles (email,
téléphone, montant payé).

## Cas

```gherkin
Étant donné un client connecté (email : jean.edouard@email.fr) ayant 2 réservations
Et 3 autres réservations appartenant à d'autres clients dans le système
Quand il consulte ses réservations
Alors il voit uniquement ses 2 réservations
Et aucune des 3 réservations des autres clients n'apparaît
```

## Données

| Élément                              |                Valeur |
| --------------------------------------- | ---------------------: |
| Client connecté                          | jean.edouard@email.fr |
| Réservations du client                   |                      2 |
| Réservations d'autres clients (système)  |                      3 |

## Résultat attendu, calculé à la main

| Grandeur                              | Valeur attendue | Calcul                          |
| ------------------------------------------ | ---------------: | ------------------------------------ |
| Réservations affichées                      |                2 | réservations appartenant au client    |
| Réservations d'autres clients affichées     |                0 | filtrage par propriétaire             |

## Ce que ce cas ne vérifie pas

- l'accès à la réservation d'un autre client par une manipulation directe (URL, identifiant) → `CASE-CONS-04` ;
- la consultation par l'employé ou l'administrateur → `CASE-CONS-02`, `CASE-CONS-03` ;
- l'affichage lorsque le client n'a aucune réservation → `CASE-CONS-06` ;
- le mécanisme de connexion lui-même (mot de passe ou lien email) → `SPEC-AUTH-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_01_client_voit_uniquement_ses_reservations`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un client avec 2 réservations et d'autres clients avec des réservations distinctes.
- [ ] Le test vérifie que la consultation du client ne retourne que ses 2 réservations.
- [ ] Le test vérifie qu'aucune réservation d'un autre client n'apparaît dans le résultat.
- [ ] Le nom du test contient `CASE_CONS_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
