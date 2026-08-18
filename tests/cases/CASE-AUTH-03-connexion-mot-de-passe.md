# CASE-AUTH-03 — Connexion d'un client avec email et mot de passe

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-02`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la connexion d'un client ayant défini un mot de passe à la
création de son compte. Si la règle se casse, un client légitime pourrait
être bloqué à tort, ou une combinaison email/mot de passe incorrecte
pourrait être acceptée.

## Cas

```gherkin
Étant donné un compte client existant avec l'email jean.edouard@email.fr
et le mot de passe « Baleine974! »
Quand le client se connecte avec cet email et ce mot de passe
Alors la connexion réussit
Et le client accède à son espace « utilisateur »
```

## Données

| Élément         |               Valeur |
| ------------------ | ---------------------: |
| Email               | jean.edouard@email.fr |
| Mot de passe saisi  |          « Baleine974! » |
| Mot de passe attendu du compte | « Baleine974! » |

## Résultat attendu, calculé à la main

| Grandeur                  | Valeur attendue | Calcul                      |
| ---------------------------- | ---------------: | -------------------------------- |
| Connexion réussie             |               oui | email + mot de passe corrects    |
| Espace accessible             |    « utilisateur » | rôle du compte connecté          |

## Ce que ce cas ne vérifie pas

- la création du compte avec mot de passe → `CASE-AUTH-01` ;
- la connexion sans mot de passe, via lien email à usage unique → `CASE-AUTH-04` ;
- un mot de passe incorrect (rejet de connexion) — non couvert par un cas limite documenté dans la spec, à envisager séparément si besoin ;
- la réinitialisation d'un mot de passe oublié (hors périmètre, non défini par la spec).

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_03_connexion_avec_mot_de_passe`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un compte avec un mot de passe connu.
- [ ] Le test tente une connexion avec l'email et le mot de passe corrects.
- [ ] Le test vérifie que la connexion réussit.
- [ ] Le test vérifie que le client accède à l'espace « utilisateur ».
- [ ] Le nom du test contient `CASE_AUTH_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
