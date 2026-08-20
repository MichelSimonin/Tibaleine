# CASE-CONS-05 — Une tentative de modification par l'employé est bloquée

**Statut :** applicable
**Nom attendu :** `test_CASE_CONS_05`

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** — (cas limite 2, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le caractère strictement lecture seule de l'accès employé.
Si la règle se casse, un employé pourrait modifier ou annuler une
réservation alors que seule la consultation lui est autorisée.

## Cas

```gherkin
Étant donné un employé connecté consultant une réservation existante
Quand il tente de modifier cette réservation (changement de date, ajout de personne, annulation)
Alors l'action est bloquée
Et un message indique que son rôle ne permet que la consultation
```

## Données

| Élément      |   Valeur |
| --------------- | ---------: |
| Rôle connecté     |   employé |
| Action tentée      | modification |

## Résultat attendu, calculé à la main

| Grandeur      | Valeur attendue | Calcul                     |
| ---------------- | ---------------: | -------------------------------- |
| Action exécutée    |               non | rôle employé, lecture seule        |
| Message retourné    |               oui | accès en lecture seule uniquement  |

## Ce que ce cas ne vérifie pas

- la consultation normale par l'employé → `CASE-CONS-02` ;
- la modification effective par l'administrateur (autorisée, cas différent) → `CASE-CONS-03` ;
- le détail du formulaire de modification lui-même.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_05_employe_modification_bloquee`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un utilisateur avec le rôle « employé ».
- [ ] Le test tente une action de modification sur une réservation existante.
- [ ] Le test vérifie que l'action est bloquée.
- [ ] Le test vérifie qu'un message explicite est retourné.
- [ ] Le nom du test contient `CASE_CONS_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-CONS-01` —
il matérialise le « cas limite 2 » de cette spec (ligne 45), qui n'a pas de
critère d'acceptation dédié.
