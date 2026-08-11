# CAHIER DES CHARGES

| Informations                  | Détails                                                        |
| ----------------------------- | -------------------------------------------------------------- |
| **Nom du projet**             | TI Baleine App                                                 |
| **Client / Maître d'ouvrage** | Ti Baleine Corp                                                |
| **Rédacteur du document**     | 200ping                                                        |
| **Date de rédaction**         | 11/08/2026                                                     |
| **Version**                   | V2.0                                                           |
| **Destinataires**             | Ti Baleine Corp                                                |
| **Sources**                   | `compte-rendu-entretien-01.md`, `compte-rendu-entretien-02.md` |

---

# Sommaire

1. [Contexte et objectifs du projet](#1-contexte-et-objectifs-du-projet)
   - [1.1 Présentation](#11-présentation)
   - [1.2 Origine du projet](#12-origine-du-projet)
   - [1.3 Objectifs](#13-objectifs)
   - [1.4 Enjeux](#14-enjeux)
2. [Présentation de l'existant](#2-présentation-de-lexistant)
   - [2.1 Système actuel](#21-système-actuel)
   - [2.2 Environnement technique](#22-environnement-technique)
   - [2.3 Utilisateurs concernés](#23-utilisateurs-concernés)
3. [Périmètre du projet](#3-périmètre-du-projet)
   - [3.1 Inclus](#31-inclus)
   - [3.2 Exclu](#32-exclu)
4. [Besoins fonctionnels](#4-besoins-fonctionnels)
5. [Besoins non fonctionnels](#5-besoins-non-fonctionnels)
   - [5.1 Performance](#51-performance)
   - [5.2 Sécurité](#52-sécurité)
   - [5.3 Ergonomie et accessibilité](#53-ergonomie-et-accessibilité)
   - [5.4 Compatibilité](#54-compatibilité)
6. [Contraintes du projet](#6-contraintes-du-projet)
   - [6.1 Techniques](#61-techniques)
   - [6.2 Budgétaires](#62-budgétaires)
   - [6.3 Délais](#63-délais)
   - [6.4 Réglementaires](#64-réglementaires)
7. [Livrables attendus](#7-livrables-attendus)
8. [Planning et jalons](#8-planning-et-jalons)
9. [Budget](#9-budget)
10. [Questions restées ouvertes](#10-questions-restées-ouvertes)

---

# 1. Contexte et objectifs du projet

## 1.1 Présentation

Entreprise Ti Baleine qui organise des sorties baleine et dauphin et possibilité de privatisation pour d'éventuelles autres types de sorties. L’entreprise dispose de deux bateaux de 12 et 24 places. C’est une petite entreprise composée du patron, d’un naturaliste et de deux skippers. Les horaires sont tous les jours de la semaine. Les clients cibles sont les touristes et les locaux.

## 1.2 Origine du projet

Le projet est lancé pour répondre à la problématique de la complexité pour son entrepreneur de gérer les réservations clients. Qui, actuellement, passe par l’intermédiaire de Whatsapp pour fonctionner et réserver. La solution, une interface capable de tout faire en ligne, permettant aux clients de réserver en ligne et supprimer cette dépendance.

## 1.3 Objectifs

### Objectif principal

L’objectif principal est de permettre à l’entreprise d’organiser les sorties de manière plus encadrée et de simplifier la communication client/entreprise.

### Objectifs secondaires

Fluidifier et améliorer la gestion des réservations clients, de même pour leur modification et annulation, la qualité du service client en proposant une toute nouvelle manière de réserver et également organisationnel pour l’équipe.

### Résultats attendus

Ce projet répond sur plusieurs niveaux :

- Diminuer la charge de travail des équipes pour l’organisation (Tout fonctionne par Whatsapp)
- Fortifier et améliorer la vision de l’entreprise pour la clientèle
- Amélioration de l’expérience utilisateur par la réservation en ligne, simple et sécurisée

## 1.4 Enjeux

Les enjeux sont de meilleurs chiffres d’affaires potentiels pour l’entreprise, un accès plus facile aux informations pour les employés grâce à la nouvelle solution et une meilleure organisation.

---

# 2. Présentation de l'existant

## 2.1 Système actuel

Le système actuel fait utilisation Whatsapp, la réservation, la communication entre les clients/équipe, la planification, les réservations et le paiement en présentiel. Ce système possède plusieurs problèmes sur le plan organisationnel et matériel.

## 2.2 Environnement technique

Aucune infrastructures existantes. Les technologies vont être choisies par l’équipe en fonction des enjeux et contraintes du projet. Le projet nécessitant d’être hébergé sur le web, un choix de stack sera fait selon les meilleures propositions.

## 2.3 Utilisateurs concernés

La solution concerne le patron, ses employés et leurs clients.

Le patron à une accès complet sur la gestion des réservations, en revanche les employés peuvent consulter uniquement ces réservations.

Les clients peuvent réserver leurs créneaux et les consulter.

---

# 3. Périmètre du projet

## 3.1 Inclus

- Inscription (client)
- Connexion (client et entreprise)
- Faire une réservation (client)
- Consultation de sa réservation (client)
- Consultations des réservations (entreprise)
- Demande d’annulation (client)
- Paiement en ligne (client)

## 3.2 Exclu

Ce qui est hors périmètre pour le projet :

- Affichage en temps réel de la météo
- Système d’avoir client pour réservation
- Remboursement direct
- Réglementations de sécurité
- Paiement en espèce, chèque, différé

---

# 4. Besoins fonctionnels

| Fonctionnalité                 | Priorité    |
| ------------------------------ | ----------- |
| Réservation                    | Essentielle |
| Inscription                    | Essentielle |
| Connexion                      | Essentielle |
| Consultation de sa réservation | Essentielle |
| Consultation des réservations  | Essentielle |
| Paiement en ligne              | Essentielle |
| Demande d’annulation           | Souhaitable |

## Règles métier

### Réservation

```text
Demande de réservation
        ↓
Attente de validation
        ↓
  ┌─────────────┐
  │             │
Confirmation   Refus
     ↓
 Paiement
```

### Inscription

```text
Inscription au moment de la réservation
        ↓
Validation des données
        ↓
  ┌─────────────┐
  │             │
Valide        Invalide
  ↓
Création du compte
  ↓
Notification par mail
```

### Connexion

```text
Connexion
    ↓
Vérification des rôles
    ↓
Accès à la vue concernée
(client, salarié ou patron)
```

### Demande d’annulation

```text
Demande d’annulation
        ↓
Envoi du motif
        ↓
Échange potentiel
        ↓
Rendez-vous annulé
```

### Modification de la réservation

La modification est uniquement possible lorsque la demande est encore en attente.

```text
Modification de la réservation
        ↓
Confirmation
        ↓
Paiement
```

## Parcours utilisateur

### Parcours client

```text
Réservation / Inscription
        ↓
Connexion
        ↓
Consulter / Modifier / Annuler
sa réservation
        ↓
Nouvelle réservation éventuelle
```

### Parcours patron

```text
Connexion
    ↓
Consultation des réservations
    ↓
Confirmation / Refus / Annulation
d’une demande
```

### Parcours employé

```text
Connexion
    ↓
Consultation des réservations
```

---

# 5. Besoins non fonctionnels

## 5.1 Performance

## 5.2 Sécurité

## 5.3 Ergonomie et accessibilité

Pas de charte graphique déterminée au moment de la rédaction de ce cahier des charges.

## 5.4 Compatibilité

---

# 6. Contraintes du projet

## 6.1 Techniques

Le client souhaite que la solution soit accessible sur leurs ordinateurs et sur tout type d’appareil pour leurs propres clients. La solution envisagée est un site web responsive.

## 6.2 Budgétaires

Pas de budget déterminé.

## 6.3 Délais

Fin de projet : 21/08/2026

## 6.4 Réglementaires

---

# 7. Livrables attendus

---

# 8. Planning et jalons

Complétez les grandes étapes et dates clés du projet :

| **Jalon / Livrable** | **Date prévisionnelle** | **Responsable** |
| -------------------- | ----------------------- | --------------- |
|                      | _[JJ/MM/AAAA]_          | _[Nom]_         |
| _[...]_              | _[JJ/MM/AAAA]_          | _[Nom]_         |
| _[...]_              | _[JJ/MM/AAAA]_          | _[Nom]_         |
| _[...]_              | _[JJ/MM/AAAA]_          | _[Nom]_         |

## Diagramme de Gantt

---

# 9. Budget

Pas de budget déterminé.

---

# 10. Questions restées ouvertes

| #   | Question                                                                                                  | Posée le   | Réponse | Hypothèse retenue en attendant          |
| --- | --------------------------------------------------------------------------------------------------------- | ---------- | ------- | --------------------------------------- |
| 1   | Les types de sorties sont-ils définis en avance en fonction du jour ?                                     | 12/08/2026 |         | Non, ils ne sont pas définis en avance. |
| 2   | Possibilité d’avoir deux sorties baleines la matinée ? (Superposition des horaires de 30 min pour 7h/10h) |            |         | D’après les calculs, non                |
