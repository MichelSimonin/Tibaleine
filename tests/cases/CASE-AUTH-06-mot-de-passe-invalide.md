# CASE-AUTH-06 — Refus d'un mot de passe trop faible

**Statut :** applicable
**Nom attendu :** `test_CASE_AUTH_06`

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** — (cas limite 3, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la robustesse minimale du mot de passe lorsqu'un client
choisit d'en définir un. Si la règle se casse, des mots de passe faibles
pourraient être acceptés, exposant les comptes clients à des accès non
autorisés.

## Cas

```gherkin
Étant donné un visiteur créant un compte avec l'email paul.martin@email.fr
Quand il propose le mot de passe « abc123 »
Alors l'inscription est refusée
Et un message indique les règles du mot de passe (8 caractères minimum,
au moins un caractère spécial)
```

## Données

| Élément                |     Valeur |
| ------------------------- | -----------: |
| Mot de passe testé         |   « abc123 » |
| Longueur                   | 6 caractères |
| Caractère spécial présent  |          non |

## Résultat attendu, calculé à la main

| Grandeur           | Valeur attendue | Calcul                              |
| --------------------- | ---------------: | ---------------------------------------- |
| Compte créé             |               non | mot de passe non conforme                 |
| Message d'erreur retourné |             oui | règles de longueur / caractère spécial    |

## Ce que ce cas ne vérifie pas

- la création sans mot de passe (cas valide) → `CASE-AUTH-02` ;
- la création avec un mot de passe valide → `CASE-AUTH-01` ;
- la liste exhaustive des caractères spéciaux acceptés (non précisée par la spec) ;
- un mot de passe de longueur suffisante mais toujours sans caractère spécial (variante non testée ici).

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_06_mot_de_passe_invalide_inscription_refusee`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test tente une création de compte avec un mot de passe trop court et sans caractère spécial.
- [ ] Le test vérifie que la création est refusée.
- [ ] Le test vérifie qu'un message d'erreur explicite est retourné.
- [ ] Le nom du test contient `CASE_AUTH_06`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-AUTH-01` —
il matérialise le « cas limite 3 » de cette spec (ligne 50), qui n'a pas de
critère d'acceptation dédié. La spec ne précise pas la liste exacte des
caractères considérés comme « spéciaux » — ce cas teste l'absence totale
d'un tel caractère, pas la validation exhaustive de la règle.
