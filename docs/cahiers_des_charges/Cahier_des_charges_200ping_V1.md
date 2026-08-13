# CAHIER DES CHARGES

| Informations                  | Détails         |
| ----------------------------- | --------------- |
| **Nom du projet**             | TI Baleine App  |
| **Client / Maître d'ouvrage** | Ti Baleine Corp |
| **Rédacteur du document**     | 200ping         |
| **Date de rédaction**         | 11/08/2026      |
| **Version**                   | V1.0            |
| **Destinataires**             | Ti Baleine Corp |

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

---

# 1. Contexte et objectifs du projet

## 1.1 Présentation

Entreprise Ti Baleine qui organise des sorties baleine et dauphin et possibilité de privatisation pour d'éventuelles autres types de sorties.

L’entreprise dispose de deux bateaux de **12 et 24 places**.

C’est une petite entreprise composée :

- du patron ;
- d’un naturaliste ;
- de deux skippers.

Les horaires sont tous les jours de la semaine.

Les clients cibles sont :

- les touristes ;
- les locaux.

## 1.2 Origine du projet

Le projet est lancé pour répondre à la problématique de la complexité pour son entrepreneur de gérer les réservations clients.

Actuellement, le fonctionnement et les réservations passent par l’intermédiaire de **WhatsApp**.

La solution envisagée est une interface capable de tout faire en ligne, permettant aux clients de réserver en ligne et de supprimer cette dépendance.

## 1.3 Objectifs

### Objectif principal

L’objectif principal est de permettre à l’entreprise d’organiser les sorties de manière plus encadrée et de simplifier la communication client/entreprise.

### Objectifs secondaires

Fluidifier et améliorer :

- la gestion des réservations clients ;
- leur modification ;
- leur annulation ;
- la qualité du service client en proposant une toute nouvelle manière de réserver ;
- l’organisation de l’équipe.

### Résultats attendus

Ce projet répond sur plusieurs niveaux :

- Diminuer la charge de travail des équipes pour l’organisation, actuellement basée sur WhatsApp ;
- Fortifier et améliorer la vision de l’entreprise pour la clientèle ;
- Améliorer l’expérience utilisateur grâce à une réservation en ligne simple et sécurisée.

## 1.4 Enjeux

Les enjeux sont :

- un meilleur chiffre d’affaires potentiel pour l’entreprise ;
- un accès plus facile aux informations pour les employés grâce à la nouvelle solution ;
- une meilleure organisation.

---

# 2. Présentation de l'existant

## 2.1 Système actuel

Le système actuel utilise **WhatsApp** pour :

- la réservation ;
- la communication entre les clients et l’équipe ;
- la planification ;
- la gestion des réservations.

Le paiement est effectué en présentiel.

Ce système possède plusieurs problèmes sur le plan organisationnel et matériel.

## 2.2 Environnement technique

Aucune infrastructure existante.

Les technologies vont être choisies par l’équipe en fonction des enjeux et contraintes du projet.

## 2.3 Utilisateurs concernés

La solution concerne :

- le patron ;
- les employés ;
- les clients.

### Patron

Le patron a un accès complet à la gestion des réservations.

### Employés

Les employés peuvent uniquement consulter les réservations.

### Clients

Les clients peuvent :

- réserver leurs créneaux ;
- consulter leurs réservations.

---

# 3. Périmètre du projet

## 3.1 Inclus

Le projet comprend :

- Inscription client ;
- Connexion client et entreprise ;
- Faire une réservation ;
- Consultation de sa réservation ;
- Consultation des réservations par l’entreprise ;
- Demande d’annulation ;
- Paiement en ligne.

## 3.2 Exclu

Ce qui est hors périmètre pour le projet :

- Affichage en temps réel de la météo ;
- Système d’avoir client pour réservation ;
- Remboursement direct ;
- Réglementations de sécurité ;
- Paiement en espèce, chèque ou différé.

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

À définir.

## 5.2 Sécurité

À définir.

## 5.3 Ergonomie et accessibilité

Pas de charte graphique déterminée au moment de la rédaction de ce cahier des charges.

## 5.4 Compatibilité

À définir.

---

# 6. Contraintes du projet

## 6.1 Techniques

Aucune technologie n’est imposée par le client.

## 6.2 Budgétaires

Pas de budget déterminé.

## 6.3 Délais

**Fin du projet : 21/08/2026**

## 6.4 Réglementaires

À définir.

---

# 7. Livrables attendus

À définir.

---

# 8. Planning et jalons

| Jalon / Livrable | Date prévisionnelle | Responsable |
| ---------------- | ------------------- | ----------- |
| _[...]_          | _[JJ/MM/AAAA]_      | _[Nom]_     |
| _[...]_          | _[JJ/MM/AAAA]_      | _[Nom]_     |
| _[...]_          | _[JJ/MM/AAAA]_      | _[Nom]_     |
| _[...]_          | _[JJ/MM/AAAA]_      | _[Nom]_     |

---

# 9. Budget

Pas de budget déterminé.
