# CASE-AUTH-01 — Création d'un compte au moment de la réservation, avec mot de passe

**Statut :** applicable
**Nom attendu :** `test_CASE_AUTH_01`

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-01`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la création effective d'un compte client au moment de la
réservation, avec un mot de passe défini. Si la règle se casse, un client
pourrait ne pas obtenir de compte malgré sa demande, ou se voir attribuer un
rôle incorrect.

## Cas

```gherkin
Étant donné un visiteur réservant une sortie baleine le 21 août 2026 à 10:00
Et qu'il fournit son email (jean.edouard@email.fr), son nom et son prénom
Quand il reçoit le mail lui proposant de créer un compte
Et associe un mot de passe valide (« Baleine974! »)
Alors un compte est créé avec le rôle « utilisateur »
Et le client peut se connecter avec son email et son mot de passe
```

## Données

| Élément            |                Valeur |
| -------------------- | ---------------------: |
| Email                |  jean.edouard@email.fr |
| Mot de passe fourni  |          « Baleine974! » |
| Rôle attendu         |             utilisateur |

## Résultat attendu, calculé à la main

| Grandeur                          | Valeur attendue | Calcul                       |
| ------------------------------------ | ---------------: | -------------------------------- |
| Compte créé                          |               oui | résultat de la création          |
| Rôle attribué                        |     utilisateur | rôle par défaut d'un client       |
| Mot de passe enregistré              |               oui | (haché, non vérifié par ce cas)   |

## Ce que ce cas ne vérifie pas

- la création d'un compte sans mot de passe → `CASE-AUTH-02` ;
- un email déjà utilisé → `CASE-AUTH-05` ;
- un mot de passe invalide (trop court, sans caractère spécial) → `CASE-AUTH-06` ;
- la connexion elle-même, au-delà de la création → `CASE-AUTH-03` ;
- le hachage ou le stockage technique du mot de passe.

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_01_creation_compte_avec_mot_de_passe`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule une réservation suivie de la création de compte avec mot de passe.
- [ ] Le test vérifie que le compte est créé avec le rôle « utilisateur ».
- [ ] Le test vérifie qu'un mot de passe est bien enregistré pour ce compte.
- [ ] Le nom du test contient `CASE_AUTH_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
