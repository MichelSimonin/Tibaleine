# CASE-AUTH-05 — Refus de création si l'email est déjà utilisé

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** — (cas limite 1, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'unicité de l'email lors de la création d'un compte. Si la
règle se casse, deux comptes pourraient exister pour le même email,
provoquant des conflits de connexion ou de propriété des réservations
associées.

## Cas

```gherkin
Étant donné un compte existant avec l'email jean.edouard@email.fr
Quand un visiteur tente de créer un nouveau compte avec ce même email
Alors la création de compte est refusée
```

## Données

| Élément  |                Valeur |
| ---------- | ---------------------: |
| Email testé | jean.edouard@email.fr |
| Compte existant avec cet email | oui |

## Résultat attendu, calculé à la main

| Grandeur                       | Valeur attendue | Calcul                    |
| ---------------------------------- | ---------------: | ------------------------------ |
| Nouveau compte créé                 |               non | email déjà utilisé              |
| Message d'erreur retourné           |               oui | email non unique                |

## Ce que ce cas ne vérifie pas

- la connexion à un compte existant → `CASE-AUTH-03`, `CASE-AUTH-04` ;
- la réinitialisation d'un mot de passe oublié (hors périmètre, non défini par la spec) ;
- la création réussie avec un email inédit → `CASE-AUTH-01`, `CASE-AUTH-02`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_05_email_deja_utilise_creation_refusee`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un premier compte avec un email donné.
- [ ] Le test tente de créer un second compte avec le même email.
- [ ] Le test vérifie que la seconde création est refusée.
- [ ] Le test vérifie qu'un seul compte existe au final pour cet email.
- [ ] Le nom du test contient `CASE_AUTH_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-AUTH-01` —
il matérialise le « cas limite 1 » de cette spec (ligne 48), qui n'a pas de
critère d'acceptation dédié.
