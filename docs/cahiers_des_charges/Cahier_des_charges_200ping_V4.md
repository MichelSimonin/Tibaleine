# Cahier des charges — TI Baleine App

| Informations | Détails |
|---|---|
| **Nom du projet** | TI Baleine App |
| **Client / Maître d'ouvrage** | Ti Baleine Corp |
| **Rédacteur** | 200ping |
| **Date de rédaction** | 14/08/2026 |
| **Version** | V4.0 |
| **Destinataires** | Ti Baleine Corp |
| **Sources** | `compte-rendu-entretien-01.md`, `compte-rendu-entretien-02.md`, `compte-rendu-entretien-03.md`, `compte-rendu-entretien-04.md` |

---

# 1. Contexte et objectifs du projet

## 1.1 Présentation

Entreprise Ti Baleine qui organise des sorties baleine et dauphin et possibilité de privatisation pour d'éventuelles autres types de sorties. L'entreprise dispose de deux bateaux de 12 et 24 places. C'est une petite entreprise composée du patron, d'un naturaliste et de deux skippers. Les horaires sont tous les jours de la semaine. Les clients cibles sont les touristes et les locaux.

## 1.2 Origine du projet

Le projet est lancé pour répondre à la problématique de la complexité pour son entrepreneur de gérer les réservations clients. Qui, actuellement, passe par l'intermédiaire de Whatsapp pour fonctionner et réserver. La solution, une interface capable de tout faire en ligne, permettant aux clients de réserver en ligne et supprimer cette dépendance.

## 1.3 Objectifs

### Objectif principal

L'objectif principal est de permettre à l'entreprise d'organiser les sorties de manière plus encadrée et de simplifier la communication client/entreprise.

### Objectifs secondaires

Fluidifier et améliorer la gestion des réservations clients, de même pour leur modification et annulation, la qualité du service client en proposant une toute nouvelle manière de réserver et également organisationnel pour l'équipe.

### Résultats attendus

Ce projet répond sur plusieurs niveaux :

- Diminuer la charge de travail des équipes pour l'organisation (tout fonctionne par Whatsapp)
- Fortifier et améliorer la vision de l'entreprise pour la clientèle
- Amélioration de l'expérience utilisateur par la réservation en ligne, simple et sécurisée

## 1.4 Enjeux

Les enjeux sont de meilleurs chiffres d'affaires potentiels pour l'entreprise, un accès plus facile aux informations pour les employés grâce à la nouvelle solution et une meilleure organisation.

# 2. Présentation de l'existant

## 2.1 Système actuel

Le système actuel fait utilisation Whatsapp, la réservation, la communication entre les clients/équipe, la planification, les réservations et le paiement en présentiel. Ce système possède plusieurs problèmes sur le plan organisationnel et matériel.

## 2.2 Environnement technique

Aucune infrastructure existante. Les technologies vont être choisies par l'équipe en fonction des enjeux et contraintes du projet. Le projet nécessitant d'être hébergé sur le web, un choix de stack sera fait selon les meilleures propositions.

## 2.3 Utilisateurs concernés (Personna)

- **Jean Bernard** — Patron
- **Maurice** — Employé
- **Claudette** — Cliente

Le patron a un accès complet sur la gestion des réservations, en revanche les employés peuvent consulter uniquement ces réservations. Les clients peuvent réserver leurs créneaux et les consulter.

# 3. Périmètre du projet

## 3.1 Inclus

- Inscription (client)
- Connexion (client et entreprise)
- Faire une réservation (client)
- Consultation de sa réservation (client)
- Consultations des réservations (entreprise)
- Demande d'annulation (client)
- Paiement en ligne (client)
- Création compte (patron)
- Création de réservation (patron)

## 3.2 Exclu (hors périmètre)

| Élément écarté | Motif |
|---|---|
| Affichage en temps réel de la météo | Consultation de Météo 974 par le patron, pas intéressé par la consultation de la météo directement sur le site |
| Système d'avoir client pour réservation | Si annulation le patron propose une autre date pour la sortie. Si refus du client, le patron rembourse le client en physique (à confirmer au prochain entretien) |
| Remboursement direct depuis l'application | Le patron doit rembourser sur son TPE en récupérant le numéro de carte |
| Réglementations de sécurité sur l'application | Le patron n'a pas de réglementation sur la sécurité. |
| Paiement en espèce, chèque, différé | Le patron voudrait arrêter le paiement sur place. Cela inclut le paiement par espèce, chèque et chèque différé. → CR-01 |

# 4. Besoins fonctionnels

Priorité : **Must / Should / Could / Won't**

| ID | Exigence | Priorité | Persona | Source |
|---|---|---|---|---|
| REQ-001 | Réserver une sortie en ligne (type, date/heure, nb adultes + enfants, email, téléphone) — par le client ou l'hôtel | Must | Client | CR-01/Q01, CR-01/Q03 |
| REQ-002 | Créer un compte au moment de la réservation | Should | Client | CR-03 §4 |
| REQ-003 | Se connecter et accéder à la vue selon le rôle (client, salarié, patron) | Must | Patron, employé, client | CR-02 §4 |
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
| REQ-016 | Envoyer un avertissement météo la veille à 18h (SMS/mail) et afficher une alerte sur le site | Must | Patron | CR-04/Q48, CR-04/Q52 |
| REQ-017 | Annuler une sortie (décision du prestataire) : par créneau, notification automatique, remboursement 100 % | Must | Patron | CR-04/Q54, CR-04/Q56, CR-04/Q57 |
| REQ-018 | Rembourser à 100 % un client qui annule après avoir reçu l'avertissement | Must | Client | CR-04/Q58 |
| REQ-019 | Bloquer temporairement une place pendant la réservation (15 min au paiement) | Should | Client | CR-04/Q61 |
| REQ-020 | Vérifier la disponibilité des services externes et gérer leur indisponibilité | Should | Patron | CR-04/Q63 |

## 4.1 Règles métier

| # | Règle | Source |
|---|---|---|
| R-01 | Le client peut faire une réservation en ligne | CR-01/Q01 |
| R-02 | Le client peut payer en ligne | CR-01/Q07 |
| R-06 | Une sortie ne dépasse jamais la capacité de son bateau (12 ou 24 places) | CR-01/Q02 |
| R-07 | Minimum 2 personnes par réservation ; minimum 6 personnes par bateau | CR-01 §3 ; CR-01/Q22 |
| R-08 | Annulation client possible jusqu'à 48 h avant le départ ; remboursement 100 % (> 7 j), 75 % (7 j → 48 h), 50 % (< 48 h) | CR-01 §1 et §3 |
| R-09 | Annulation côté entreprise (météo 2 h avant, problème bateau la veille) : par téléphone + proposition de report | CR-01/Q05 ; CR-02 §1 |
| R-10 | Une seule sortie baleine par créneau | CR-02 §1 ; CR-01/Q19 |
| R-11 | Tarif enfant 4-11 ans, adulte à partir de 12 ans ; accès interdit aux moins de 4 ans | CR-01/Q14 |
| R-14 | Modification après paiement (ajout de personne < 2 h avant) : possible par le patron + mail pour le supplément ; suppression = circuit remboursement | CR-03/Q44 |
| R-15 | Clientèle hôtel : remise -15 % en fin de mois, 6 places max/créneau, pas de privatisation, résa possible sans passer par le site | CR-03 §3 |
| R-16 | Le client peut faire une demande de réservation en ligne | CR1 - Q03 |
| R-17 | Le client peut payer en ligne une fois la réservation confirmée | CR1 - Q07 |
| R-18 | Les données saisies lors de l'inscription/réservation doivent être validées (nom, prénom, email, numéro de téléphone, type de réservation, nombre de personnes, date) | CR1 - Q01, Q03 |
| R-19 | L'utilisateur accède à une vue spécifique selon son rôle (client, salarié, patron) | CR1 - Q11, Q19 ; CR3 - Section 4 |
| R-20 | Le client peut faire une demande d'annulation | CR1 - Section 1, Q04 |
| R-21 | Une demande d'annulation nécessite l'envoi d'un motif, avec un échange potentiel entre les parties | CR2 - Q38 |
| R-22 | Le rendez-vous est annulé à l'issue de la demande d'annulation | CR1 - Section 3 ; CR2 - Section 3 |
| R-23 | Une réservation doit préciser l'adresse électronique et le numéro de téléphone du client, le type de sortie, la date, l'heure et le nombre d'adultes et d'enfants. | CR-01/Q01 et Q03 |
| R-24 | Une réservation doit concerner au minimum 2 personnes. | CR-01/§3 |
| R-25 | Le bateau Ti Kap ne peut accueillir plus de 12 passagers. | CR-01/Q02 |
| R-26 | Le bateau Grand Bleu ne peut accueillir plus de 24 passagers. | CR-01/Q02 |
| R-27 | Une sortie est maintenue à partir de 6 passagers minimum par bateau. | CR-01/Q22 ; CR-02/§1 |
| R-28 | Une même réservation peut concerner les deux bateaux, notamment dans le cas exceptionnel d'une privatisation. | CR-01/Q26 ; CR-02/§1 |
| R-29 | Une seule sortie baleine peut être organisée sur un même créneau, car l'entreprise ne dispose que d'un naturaliste. | CR-01/Q19 ; CR-02/§1 |
| R-30 | Lorsque les deux bateaux sont mobilisés, leurs départs sont organisés au même horaire. | CR-02/§1 |
| R-31 | Les sorties peuvent être proposées tous les jours de la semaine. | CR-01/Q23 ; CR-02/§1 |
| R-32 | Les créneaux habituels de départ sont 7 h, 10 h et 14 h. | CR-01/§3 |
| R-33 | Une sortie baleine dure 2 h 30. | CR-01/§3 |
| R-34 | Une sortie dauphin dure 2 h. | CR-01/§3 |
| R-35 | Une privatisation peut être organisée le matin, notamment pour proposer un brunch. | CR-01/Q13 ; CR-02/§1 |
| R-36 | Les enfants de moins de 4 ans ne sont pas autorisés. | CR-01/Q14 |
| R-37 | Les passagers âgés de 4 à 11 ans relèvent du tarif enfant. | CR-01/Q14 |
| R-38 | À partir de 12 ans, le tarif adulte s'applique. | CR-01/Q14 |
| R-39 | Pour une sortie baleine, le tarif est de 65 € par adulte et de 40 € par enfant. | CR-01/§3 |
| R-40 | Pour une sortie dauphin, le tarif est de 50 € par adulte et de 30 € par enfant. | CR-01/§3 |
| R-41 | Pour une privatisation à la demi-journée, le tarif est de 600 € pour Ti Kap et de 1 100 € pour Grand Bleu. | CR-01/§3 |
| R-42 | Le paiement d'un client particulier s'effectue uniquement en ligne. | CR-01/Q07 |
| R-43 | Le paiement en ligne intervient après la soumission du formulaire de réservation. | *(aucune source)* |
| R-44 | L'entreprise peut annuler une sortie jusqu'à 2 heures avant le départ en raison des conditions météorologiques. | CR-01/Q05 ; CR-04/Q54 |
| R-45 | L'entreprise peut annuler une sortie la veille en cas de problème concernant un bateau. | CR-01/Q05 |
| R-46 | En cas d'annulation par l'entreprise, tous les clients concernés sont contactés par un sms ou un email général envoyé par l'entreprise. | CR-04/Q56 ; CR-04/Q49 |
| R-47 | En cas d'annulation par l'entreprise, la réservation passe en « Annulé ». Le client peut revenir vers l'entreprise pour transmettre ses préférences entre un remboursement ou un report. | CR-04/Q59 ; CR-04/Q56 |
| R-48 | Lorsqu'une annulation client intervient plus de 48 heures avant le départ, un nouveau créneau peut être proposé si les conditions le permettent. *(Amendé par R-80)* | CR-02/§3 |
| R-49 | Un remboursement est traité par le patron à partir des informations de la carte bancaire et n'est pas effectué automatiquement depuis l'application. | CR-01/Q15 ; CR-02/§1 |
| R-50 | Une demande de modification d'une réservation s'effectue par téléphone. | CR-01/Q25 ; CR-02/§3 |
| R-51 | Une réservation déjà payée peut être modifiée par le patron, sous réserve du respect du délai de modification. | CR-03/Q44 et §1 |
| R-52 | Après paiement, l'ajout de participants entraîne le paiement d'un supplément. | CR-03/Q44 et §1 |
| R-53 | Le lien ou les instructions de paiement du supplément sont transmis par courrier électronique. | CR-03/Q44 et §1 |
| R-54 | Après paiement, le retrait de participants entraîne un remboursement calculé selon les conditions d'annulation. | CR-03/Q44 et §1 |
| R-55 | Un hôtel partenaire peut réserver des places pour une sortie baleine ou dauphin. | CR-03/§3 |
| R-56 | Un hôtel peut réserver au maximum 6 places par créneau. | CR-03/§3 |
| R-57 | Un hôtel ne peut pas réserver une sortie de type privatisation. | CR-03/§3 |
| R-58 | Les réservations d'un hôtel sont facturées en fin de mois. | CR-03/§3 |
| R-60 | Un hôtel partenaire bénéficie d'une remise de 15 % sur le montant total facturé en fin de mois. | CR-03/§3 |
| R-61 | Une réservation pour un hôtel peut être créée directement par le patron à la suite d'un appel, d'un courrier électronique ou d'un autre contact direct. | CR-03/§5 |
| R-62 | Une personne de l'hôtel est chargée du groupe de personnes (gère la réservation, reçoit le message d'alerte et d'annulation, informe les clients de l'hôtel). | CR-04/Q60 |
| R-63 | Alerte sur le site/application pour prévenir des mauvaises conditions météorologiques du lendemain pour les clients qui pourraient réserver. | CR-04/Q52 |
| R-64 | L'alerte/message doit pouvoir être personnalisable (message personnalisé pour expliquer la raison). | CR-04/Q49 |
| R-65 | Le SMS (alerte ou annulation) doit être envoyé depuis le numéro de téléphone de l'entreprise. | CR-04/Q49 |
| R-66 | L'annulation suite à un avertissement est effective 2 h avant le début de la sortie. | CR-04/Q54 |
| R-67 | Le message d'alerte et l'alerte sur le site sont envoyés à 18 h. | CR-04/Q48 ; CR-04 contrainte 04 |
| R-68 | L'alerte doit préciser que le client peut annuler sa réservation sans frais. | CR-04/Q58 |
| R-69 | Si il y a annulation à cause de la météo, l'annulation de créneau est possible pour simplifier le processus administratif (ex. le créneau de 7H/10H/14H avec X réservations peut être annulé = annulation de toutes les réservations pour ce créneau). | CR-04/Q55 ; CR-04 contrainte 05 |
| R-70 | Si il y a annulation à cause de la météo c'est au client de revenir vers le prestataire pour effectuer un remboursement ou reporter la date de sortie à une date ultérieure. | CR-04/Q59 |
| R-71 | Message et alerte en français et en anglais pour les étrangers. | CR-04/Q51 ; CR-01/§3 |
| R-72 | En cas d'annulation, l'entreprise contacte directement l'hôtel par téléphone. | CR-04/Q60 ; CR-04 contrainte 09 |
| R-73 | Si il y a une annulation tout se fait en automatique, le SMS/mail est envoyé aux clients concernés (causes météo, causes techniques, causes humaines). | CR-04/Q56 ; CR-04/Q50 |
| R-74 | L'annulation à l'initiative du prestataire engendre un remboursement à 100 % (problèmes météos, problèmes humains et techniques). | CR-04/Q57 ; CR-04/Q50 |
| R-75 | Si il n'y a pas d'annulation après le message d'avertissement les sorties sont maintenues. | CR-04/Q48 ; CR-04/Q53 |
| R-76 | Si un client annule sa réservation durant la phase d'avertissement (après 18 h la veille de la sortie), le remboursement est de 100 %. | CR-04/Q58 ; CR-04 contrainte 08 |
| R-77 | Empêcher une réservation d'un même créneau par deux ou plusieurs personnes. | CR-04/Q61 |
| R-78 | Afficher un badge « nouvelle place disponible » sur le calendrier lorsqu'un créneau complet devient à nouveau disponible. | CR-04/Q62 |
| R-79 | Déclencher le paiement uniquement après soumission du formulaire de réservation. | CR-04/Q64 |
| R-80 | Lorsqu'une annulation client intervient plus de 48 heures avant le départ, le client revient vers le prestataire pour choisir entre un remboursement ou un report du créneau. | CR-04/Q59 |

> Note : les numéros R-03, R-04, R-05, R-12, R-13 et R-59 n'apparaissent pas dans le document source.

# 5. Besoins non fonctionnels

| ID | Exigence | Comment on la vérifie | Source |
|---|---|---|---|
| REQ-100 | Temps de réponse immédiat | Vérification du temps de traitement d'une requête. Celui-ci doit être à moins de 2 secondes pour une connexion en 4G. | Aucune source |
| REQ-101 | Exigence RGPD | Présence sur le site | CR-03/Q42 |
| REQ-102 | Authentification en fonction des rôles de l'utilisateur | Accès aux interfaces correspondantes aux rôles. Accès bloqué aux fonctions des autres rôles. | CR-01/Q11 ; CR-03/§4 |
| REQ-103 | Les failles de sécurité doivent être connues et corrigées. | Veille de sécurité et logs pour vérifier la présence de failles. Commit sur le git pour vérifier la correction des problèmes. | Aucune source |
| REQ-104 | Pas de charte graphique imposée | — | CR-03/Q45 |
| REQ-105 | S'adapte à tout type de navigateur et sur tout type d'appareil. | Affichage du site et essai de diverses fonctionnalités sur divers navigateurs. | CR-01/Q09 ; CR-03/Q43 |
| REQ-106 | Respecter la RGAA | Test de l'accessibilité sur Lighthouse (outil d'inspection de Google) | Aucune source |
| REQ-107 | Traduit en français et anglais. | Affichage du site avec un navigateur dans une langue autre que le français. | CR-01/§3 ; CR-04/Q51 ; CR-04 contrainte 12 |

# 6. Contraintes du projet

Nature : budget / délai / technique / réglementaire / humaine

| # | Contrainte | Nature | Source |
|---|---|---|---|
| 1 | Le client souhaite que la solution soit accessible sur leurs ordinateurs. | Technique | CR-01/Q09 |
| 2 | La solution doit être accessible sur tout type d'appareil pour leurs propres clients. | Technique | CR-01/Q09 |
| 3 | Pas de budget déterminé | Budget | CR-01/Q16 ; CR-02/§3 |
| 4 | Date de livraison : 21/08/2026 | Délai | Aucune source |
| 5 | La solution envisagée est un site web responsive. | Technique | CR-01/Q09 |
| 6 | Le projet est soumis à des règles RGPD chez nous, car récupération et hébergement des données clients. | Technique | CR-03/Q42 |

# 7. Planning et jalons

| Jalon / Livrable | Date prévisionnelle | Responsable |
|---|---|---|
| Livraison de l'application | 21/08/2026 | Équipe 200ping |

# 8. Questions restées ouvertes

| # | Question | Posée le | Réponse | Hypothèse retenue en attendant |
|---|---|---|---|---|
| 1 | Les types de sorties sont-ils définis en avance en fonction du jour ? | 12/08/2026 | Non, créneau proposé en fonction des places | Non, ils ne sont pas définis en avance. |
| 2 | Possibilité d'avoir deux sorties baleines la matinée ? (superposition des horaires de 30 min pour 7h/10h) | 12/08/2026 | Oui, possibilité d'avoir des deux sorties baleines le matin | D'après les calculs, non |
| 3 | Historique de paiement ? Sous quel format ? | — | — | — |
| 4 | En cas d'annulation, proposez-vous systématiquement un report ? Si le client refuse, comment et par quel moyen effectuez-vous le remboursement ? Souhaitez-vous proposer un avoir ? | prioritaire | — | — |
| 5 | Voulez-vous pouvoir valider chaque demande de réservation ? | prioritaire | Oui, car évite d'avoir à déplacer ou rembourser si pas créneau possible | — |
| 6 | Voulez-vous pouvoir rajouter un bateau ? | — | — | — |
| 7 | Avez-vous un formatage pour la référence d'une réservation ? | — | — | — |
| 8 | À quelle étape les passagers sont-ils affectés à un bateau : lors de la demande, à la confirmation, après le paiement ou avant le départ ? Qui réalise cette affectation ? | prioritaire | — | — |
| 9 | Pouvez-vous refuser une demande de réservation ? Et comment ? | prioritaire | — | — |
| 10 | Le client peut annuler sur le site sa réservation sur site ou par téléphone ? | — | — | — |
| 11 | Les enfants de moins de 4 ans sont-ils refusés à bord ? | prioritaire | — | — |
| 12 | Le client peut-il demander ou effectuer une modification en ligne, ou doit-il obligatoirement contacter l'entreprise par téléphone ? Qui valide ensuite la modification ? | prioritaire | — | — |
| 13 | La suppression d'un participant entraîne-t-elle toujours un remboursement ? Si oui, quel barème s'applique et qui réalise le remboursement ? | — | — | — |
| 14 | Si une réservation est en attente et que le client ne paie pas mais vient, comment faire ? | — | régler sur place | — |
| 15 | Le patron peut-il refuser une demande de réservation ? Pour quels motifs, à quelle étape et par quel moyen le client est-il informé ? | — | — | — |
