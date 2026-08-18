# CASE-AUTH-02 — Création d'un compte sans mot de passe

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-01`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la possibilité de créer un compte sans mot de passe, conforme
à la décision d'équipe (mot de passe optionnel à la création). C'est aussi
la condition préalable au mécanisme de connexion par lien email à usage
unique (`CASE-AUTH-04`). Si la règle se casse, la création de compte pourrait
être bloquée à tort pour les clients qui ne souhaitent pas définir de mot de
passe.

## Cas

```gherkin
Étant donné un visiteur réservant une sortie dauphin le 21 août 2026 à 07:00
Et qu'il fournit son email (marie.dupont@email.fr), son nom et son prénom
Quand il reçoit le mail lui proposant de créer un compte
Et ne définit pas de mot de passe
Alors un compte est créé avec le rôle « utilisateur »
Et le champ mot de passe reste vide
```

## Données

| Élément            |             Valeur |
| -------------------- | -------------------: |
| Email                | marie.dupont@email.fr |
| Mot de passe fourni  |                 aucun |
| Rôle attendu         |          utilisateur |

## Résultat attendu, calculé à la main

| Grandeur                | Valeur attendue | Calcul                      |
| -------------------------- | ---------------: | -------------------------------- |
| Compte créé                 |               oui | résultat de la création          |
| Mot de passe stocké         |     nul / vide | aucun mot de passe fourni         |
| Rôle attribué                |     utilisateur | rôle par défaut d'un client       |

## Ce que ce cas ne vérifie pas

- la création d'un compte avec mot de passe → `CASE-AUTH-01` ;
- l'accès ultérieur aux réservations via le lien email à usage unique → `CASE-AUTH-04` ;
- un email déjà utilisé → `CASE-AUTH-05`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_02_creation_compte_sans_mot_de_passe`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule une réservation suivie de la création de compte sans mot de passe.
- [ ] Le test vérifie que le compte est créé malgré l'absence de mot de passe.
- [ ] Le test vérifie que le champ mot de passe est bien nul/vide.
- [ ] Le test vérifie que le rôle attribué est « utilisateur ».
- [ ] Le nom du test contient `CASE_AUTH_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
