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

# 2. Présentation de l'existant

## 2.1 Système actuel

Le système actuel fait utilisation Whatsapp, la réservation, la communication entre les clients/équipe, la planification, les réservations et le paiement en présentiel. Ce système possède plusieurs problèmes sur le plan organisationnel et matériel.

## 2.2 Environnement technique

Aucune infrastructures existantes. Les technologies vont être choisies par l’équipe en fonction des enjeux et contraintes du projet. Le projet nécessitant d’être hébergé sur le web, un choix de stack sera fait selon les meilleures propositions.

## 2.3 Utilisateurs concernés (Personna)

Jean Bernard - Patron  
Maurice - Employé  
Claudette - Cliente

Le patron à une accès complet sur la gestion des réservations, en revanche les employés peuvent consulter uniquement ces réservations.  
Les clients peuvent réserver leurs créneaux et les consulter.

# 3. Périmètre du projet

## 3.1 Inclus

- Inscription (client)
- Connexion (client et entreprise)
- Faire une réservation (client)
- Consultation de sa réservation (client)
- Consultations des réservations (entreprise)
- Demande d’annulation (client)
- Paiement en ligne (client)
- Création compte (patron)
- Creation de réservation (patron)

## 3.2 Exclu (hors périmètre)

| Élément écarté | Motif |
|---|---|
| Affichage en temps réel de la météo | Consultation de Météo 974 par le patron, pas intéressé par le consultation de la météo directement sur le site |
| Système d’avoir client pour réservation | Si annulation le patron propose une autre date pour la sortie. Si refus du client, le patron rembourse le client en physique (à confirmer au prochain entretien) |
| Remboursement direct depuis l’application | Le patron doit rembourser sur son TPE en récupérant le numéro de carte |
| Réglementations de sécurité sur l’application | Le patron n’a pas de réglementation sur la sécurité. |
| Paiement en espèce, chèque, différé | Le patron voudrait arrêter le paiement sur place. Cela inclut le paiement par espèce, chèque et chèque différé. |

-> CR-01

# 4. Besoins fonctionnels

| Besoin | Priorité |
|---|---|
| Réservation | Essentielle |
| Inscription | Essentielle |
| Connexion | Essentielle |
| Consultation de sa réservation | Essentielle |
| Consultation des réservations | Essentielle |
| Paiement en ligne | Essentielle |
| Création d’un compte | Essentielle |
| Création d’une réservation | Essentielle |
| Demande d’annulation | Souhaitable |

priorité : Must / Should / Could / Won't

| ID | Exigence | Priorité | Persona | Source |
|---|---|---|---|---|
| REQ-001 | Réserver une sortie en ligne (type, date/heure, nb adultes + enfants, email, téléphone) — par le client ou l'hôtel | Must | Client | CR-01/Q01, CR-01/Q03 ; hôtel : CR-03 §5 |
| REQ-002 | Créer un compte au moment de la réservation | Should | Client | CR-03 §4 |
| REQ-003 | Se connecter et accéder à la vue selon le rôle (client, salarié, patron) | Must | Patron, employé, client | CR-02 §4, déduit — décision équipe 12/08/2026 (3 rôles) |
| REQ-004 | Consulter ses propres réservations | Should | Client | CR-02 §4, cahier V2 §2.3 |
| REQ-005 | Consulter les réservations (côté entreprise) | Must | Patron | CR-01/Q11 |
| REQ-006 | Payer en ligne la réservation | Should | Client | CR-01/Q07 |
| REQ-007 | Demander l'annulation d'une réservation (avec motif) | Could | Client | CR-01/Q04, CR-01 §3 |
| REQ-008 | Consulter les créneaux disponibles (dates/heures libres) avant de réserver | Must | Client | CR-01 §5, CR-03 §5 |
| REQ-009 | Traiter une annulation : calcul du remboursement selon le délai + confirmation | Could | Patron | CR-01 §1 |
| REQ-010 | Modifier une réservation (report, ajout / suppression de personnes) | Could | Patron | CR-01/Q25, CR-03/Q44 |
| REQ-011 | Créer un compte hôtel et consulter les créneaux disponibles | Could | Client (profil hôtel) | CR-03 §5 |
| REQ-012 | Réserver pour un hôtel (via le patron) : max 6 places, hors privatisation | Could | Patron | CR-03 §5, contrainte 02 |
| REQ-013 | Facturer l'hôtel en fin de mois (remise -15 %) | Could | Client (profil hôtel) | CR-03 §3 |
| REQ-014 | Interface en français et en anglais | Could | Client | CR-01 §3 |
| REQ-015 | Liens vers les réseaux sociaux (Facebook, Instagram) | Could | Client | CR-03/Q46 |

Les différentes règles métier sont :

Demande de réservation → attente de validation → confirmation → paiement  
                            \→ refus

Inscription (au moment de la réservation) →validation des données → création du compte → Notification par mail  
                     \→ invalide

Connexion → Vérification des rôles → Accès à la vue concernée (client, salarié ou patron)

Demande d’annulation → Envoi du motif + échange potentiel -> Rendez-vous annulé

Modification de la réservation (uniquement lorsque demande en attente) → Confirmation → Paiement

Pour la validation des données lors de la réservation :

- Nom, prénom, email, numéro de téléphone, type de réservation, nombre de personne (adulte, enfant), date de réservation

Pour l’inscription

- Mot de passe à 8 caractères minimum avec des caractères spéciaux.

Le parcours client est :

Réservation/Inscription → Connexion → Consulter, modifier, annuler sa réservation ou faire une nouvelle réservation

Le parcours patron est :

Connexion → Consultation des réservations → Confirmation, refus ou annulation d’une demande  
Connexion → Création d’un compte client  
Connexion → Création d’une réservation

Le parcours employé est :

Connexion → Consultations des réservations

Le parcours général :

Page d’accueil avec message de bienvenue, deux parcours possibles particulier et professionnel. Le parcours professionnel mène vers une connexion puis calendrier pour avoir les filtres adéquats. Le parcours client mène directement vers le calendrier avec créneaux, nombre de places et type de réservation disponibles. Le parcours professionnel ne donne pas accès au formulaire de réservation. Au clic sur le bouton réserver, apparition du formulaire de réservation. A la fin de la réservation, message de confirmation sur le site ainsi qu’un email de confirmation. Dans ce mail de confirmation avec les informations de la réservation, lien permettant de créer un compte client en renseignant le mot de passe (optionnel). Si une modification ou une annulation devait avoir lieu, le client peut accéder à son compte client pour effectuer l’action.

# 5. Besoins non fonctionnels

| ID | Exigence | Comment on la vérifie | Source |
|---|---|---|---|
| REQ-100 | Temps de réponse immédiat | Vérification du temps de traitement d’une requête. Celui-ci doit être à moins de 2 secondes. | ??? |
| REQ-101 | Exigence RGPD | Présence sur le site | |
| REQ-102 | Authentification en fonction des rôles de l’utilisateur | Accès aux interfaces correspondantes aux rôles. Accès bloqué aux fonctions des autres rôles. | |
| REQ-103 | Les failles de sécurité doivent être connues et corrigées. | Veille de sécurité et logs pour vérifier la présence de failles. Commit sur le git pour vérifier la correction des problèmes. | |
| REQ-104 | Pas de charte graphique imposée | - | |
| REQ-105 | S’adapte à tout type de navigateur et sur tout type d’appareil. | Affichage du site et essaie de diverses fonctionnalités sur divers navigateurs. | |
| REQ-106 | Respecter la RGAA | Test de l’accessibilité sur Lighthouse (outil d’inspection de Google) | |
| REQ-107 | Traduit en français et anglais. | Affichage du site avec un navigateurs dans une langue autre que le français. | |

# 6. Contraintes du projet

Nature : budget / délai / technique / réglementaire / humaine

| # | Contrainte | Nature | Source |
|---|---|---|---|
| 1 | Le client souhaite que la solution soit accessible sur leurs ordinateurs. | Technique | |
| 2 | La solution doit être accessible sur tout type d’appareil pour leurs propres clients | Technique | |
| 3 | Pas de budget déterminé | Budget | |
| 4 | Date de livraison : 21/08/2026 | Délai | |
| 5 | La solution envisagée est un site web responsive. | Technique | |
| 6 | Le projet est soumis à des règles RGPD chez nous, car récupération et hébergement des données clients. | Technique | |

# 7. Planning et jalons

Complétez les grandes étapes et dates clés du projet :

| Jalon / Livrable | Date prévisionnelle | Responsable |
|---|---|---|
| Livraison de l’application | [21/08/2026] | Equipe 200ping |

Diagramme de Gantt

# 8. Questions restées ouvertes

| # | Question | Posée le | Réponse | Hypothèse retenue en attendant |
|---|---|---|---|---|
| 1 | Les types de sorties sont-ils définis en avance en fonction du jour ? | 12/08/2026 | Non, créneau proposé en fonction des places | Non, ils ne sont pas définis en avance. |
| 2 | Possibilité d’avoir deux sorties baleines la matinée ? (Superposition des horaires de 30min pour 7h/10h) | 12/08/2026 | Oui, possibilité d’avoir des deux sorties baleines le matin | D’après les calculs, non |
| 3 | Historique de paiement ? Sous quel format ? | | | |
| 4 | Voulez-vous un système d’avoir ? (Pour le moment pas d’avoir, si annulation de la sortie le patron propose une autre date, si refus remboursement en physique) | | | |
