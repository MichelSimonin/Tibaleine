# ADR-001 — Choix de la stack technique

**Statut :** proposé
**Date :** J2
**Décidé par :** l'équipe 200ping
**Validation formateur :** requise avant la fin de J2

À rendre en fin de journée J2. Sans ADR-001 validé, l'équipe ne démarre pas la
conception technique.

---

## 1. Contraintes d'admissibilité

Les cinq sont éliminatoires. Cochez et justifiez ; une case non cochée invalide
le choix.

PHP/SYMFONY

- [x] **Déjà pratiquée par au moins deux membres de l'équipe.** : chaque membre de l'équipe a vu le language en cours

- [x] **Runner de tests exécutable en une commande.**
      → la commande : `.vendor/bin/phpunit (emplacement fichier)`

- [x] **Mécanisme de migration ou de schéma versionné.**
      → lequel : Doctrine
- [x] **Intégration possible d'un prestataire de paiement.**
      → lequel, et sous quelle forme : Stripe
- [x] **Déployable dans la contrainte budgétaire du client** (`REQ-1xx`).
      → où, et pour combien par mois :

## 2. Liste admise

Symfony/PHP, NextJs

## 3. Contexte

Ce que le problème demande réellement :

nature des données, transactions,
concurrence sur les places, volumétrie et pics, support d'usage, conditions
réseau, langues, maintenance après livraison. Citer les `REQ` concernées.

## 4. Options envisagées

### Option A — Symfony

|                                      |                                                                                                                                               |
| ------------------------------------ | --------------------------------------------------------------------------------------------------------------------------------------------- |
| Compétences de l'équipe              | Tous les membres ont déjà vu symfony en cours, mais deux membres l'utilisent en entreprise                                                    |
| Ce qu'elle facilite pour ce problème | Evite d'apprendre un language, symfony possede enormement de composants nécessaires                                                           |
| Ce qu'elle coûte                     | Rien                                                                                                                                          |
| Coût d'hébergement estimé            | 0 €/mois                                                                                                                                      |
| Ce qu'elle rend difficile plus tard  | Rend plus difficile l'evolution du front-end, car les modules ne sont pas séparés, ce n'est pas une API REST. Peut devenir moins maintenable. |

### Option B — NextJs

|                                      |                                                                                                            |
| ------------------------------------ | ---------------------------------------------------------------------------------------------------------- |
| Compétences de l'équipe              | Seulement un membre de l'équipe le maitrise convenablement.                                                |
| Ce qu'elle facilite pour ce problème | Gestion du front par composant et le routing est fait de maniere plus efficace par emplacement du dossier. |
| Ce qu'elle coûte                     | Rien                                                                                                       |
| Coût d'hébergement estimé            | 0 €/mois                                                                                                   |
| Ce qu'elle rend difficile plus tard  | Vu que la majorité des membres ne le pratique pas, la maintenabilité sera plus compliqué.                  |

## 5. Décision

Nous choisissons donc symfony pour ce projet.

## 6. Raisons

Celui-ci a été choisi, car deux membres de l'équipe utilisent constamment la technologie.

## 7. Conséquences acceptées

- Affichage non dynamique, effet de chargement constant des pages. Acceptées, car peu de pages nécessaires. Utilisation de la mémoire supérieure à la normale, mais acceptable.
- Ecosystème lourd, mais complet, éprouvé et maintenable.

## 8. Ce qui nous ferait revenir dessus

- Si le projet prend de l'ampleur avec plusieurs pages et des animations plus complexes, la stack ne serait peut-être plus adaptée.

---
