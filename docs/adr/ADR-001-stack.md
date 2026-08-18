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
      → hébergeur mutualisé PHP (à préciser par l'équipe), ~5 €/mois (à confirmer)

## 2. Liste admise

Symfony/PHP, NextJs

## 3. Contexte

Application de réservation de sorties en mer (baleine, dauphin ; créneaux
7 h / 10 h / 14 h) pour une petite entreprise, avec :

- **transactions** : réservation et paiement en ligne (`REQ-001`, `REQ-006`),
  remboursements selon le barème d'annulation (`REQ-007`, `REQ-009`),
  facturation des hôtels en fin de mois (`REQ-013`) ;
- **concurrence sur les places** : capacité limitée des bateaux (12/24 places),
  blocage temporaire des places pour éviter les doubles réservations (`REQ-019`) ;
- **notifications** : avertissement météo la veille à 18 h, annulation par
  créneau, SMS/mail/alerte site (`REQ-016`, `REQ-017`, `REQ-018`), en français
  et en anglais (`REQ-014`) ;
- **volumétrie et pics** : petite volumétrie (deux bateaux, créneaux limités),
  mais pics ponctuels de réservations après une annulation ;
- **support d'usage et réseau** : usage mobile possible (4G), temps de réponse
  < 2 s (`REQ-100`), tout navigateur et appareil (`REQ-105`) ;
- **services externes** : prestataire de paiement (Stripe) et envois SMS/mail,
  avec gestion des indisponibilités (`REQ-020`) ;
- **maintenance après livraison** : par une petite équipe, d'où la priorité à
  une stack déjà connue et maintenable.

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

Symfony est retenu parce qu'il répond aux contraintes du problème, pas par
préférence générale :

- **compétence** : deux membres l'utilisent en entreprise et tous l'ont vu en
  cours — pas de temps d'apprentissage ;
- **schéma versionné** : Doctrine fournit migrations et mapping, nécessaires au
  modèle (réservations, paiements, notifications) ;
- **paiement** : Stripe s'intègre directement à Symfony (`REQ-006`) ;
- **composants** : sécurité (rôles `REQ-003`, `REQ-102`), formulaires et
  traduction FR/EN (`REQ-014`) déjà couverts par l'écosystème ;
- **coût** : hébergement mutualisé PHP, dans la contrainte budgétaire du client.

## 7. Conséquences acceptées

- Affichage non dynamique, effet de chargement constant des pages. Acceptées, car peu de pages nécessaires. Utilisation de la mémoire supérieure à la normale, mais acceptable.
- Ecosystème lourd, mais complet, éprouvé et maintenable.

## 8. Ce qui nous ferait revenir dessus

- Si le projet prend de l'ampleur avec plusieurs pages et des animations plus complexes, la stack ne serait peut-être plus adaptée.

---
