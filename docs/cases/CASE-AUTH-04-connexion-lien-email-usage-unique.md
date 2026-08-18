# CASE-AUTH-04 — Connexion sans mot de passe via un lien email à usage unique

**Spécification :** `SPEC-AUTH-01`
**Critère d'acceptation :** `AC-02`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'accès d'un client sans mot de passe à ses réservations, via
un lien de connexion envoyé par email, à usage unique. Si la règle se casse,
soit un client sans mot de passe se retrouve bloqué (incohérence avec
`SPEC-CONS-01` / REQ-004, signalée dans la Revue IA de `SPEC-AUTH-01`), soit
un lien réutilisable expose les réservations à quiconque intercepte l'email.

## Cas

```gherkin
Étant donné un compte client sans mot de passe (email : marie.dupont@email.fr)
Quand le client demande à consulter ses réservations
Alors un lien de connexion à usage unique lui est envoyé par email
Et en cliquant sur ce lien, le client accède à son espace « utilisateur »
Et en réutilisant ce même lien une seconde fois, l'accès est refusé
```

## Données

| Élément                     |             Valeur |
| ------------------------------ | -------------------: |
| Email                          | marie.dupont@email.fr |
| Mot de passe du compte         |                 aucun |
| Lien de connexion généré       |                   oui |
| 1ʳᵉ utilisation du lien         |                succès |
| 2ᵉ utilisation du même lien    |                 refus |

## Résultat attendu, calculé à la main

| Grandeur                                    | Valeur attendue | Calcul                          |
| ------------------------------------------------ | ---------------: | ------------------------------------ |
| Accès accordé à la 1ʳᵉ utilisation du lien         |               oui | premier clic sur le lien              |
| Accès accordé à la 2ᵉ utilisation du même lien    |               non | lien à usage unique, déjà consommé    |

## Ce que ce cas ne vérifie pas

- la durée de validité du lien avant expiration (point encore ouvert,
  voir Revue IA de `SPEC-AUTH-01`, non tranché à ce stade) ;
- la connexion par mot de passe → `CASE-AUTH-03` ;
- la création du compte sans mot de passe → `CASE-AUTH-02` ;
- le contenu exact du mail envoyé (langue, format) → `SPEC-LANG-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_AUTH_04_connexion_lien_email_usage_unique`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un compte sans mot de passe.
- [ ] Le test déclenche l'envoi d'un lien de connexion par email.
- [ ] Le test vérifie que le premier usage du lien donne accès à l'espace « utilisateur ».
- [ ] Le test vérifie qu'un second usage du même lien est refusé.
- [ ] Le nom du test contient `CASE_AUTH_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne vérifie que le caractère « usage unique » du lien,
pas sa durée de validité — ce point reste à trancher (voir Revue IA de
`SPEC-AUTH-01`). Un cas complémentaire sera nécessaire une fois la durée
d'expiration définie.
