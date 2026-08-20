# Cahier des charges — TI Baleine App

| Informations | Détails |
|---|---|
| **Nom du projet** | TI Baleine App |
| **Client / Maître d'ouvrage** | Ti Baleine Corp |
| **Rédacteur** | 200ping |
| **Date de rédaction** | 19/08/2026 |
| **Version** | V5.0 |
| **Destinataires** | Ti Baleine Corp |
| **Sources** | `compte-rendu-entretien-01.md`, `compte-rendu-entretien-02.md`, `compte-rendu-entretien-03.md`, `compte-rendu-entretien-04.md`, `compte-rendu-entretien-05.md`, `impact-CR-001.md` |

## Évolutions principales de la V4 à la V5

- remplacement du paiement intégral à la réservation par un acompte obligatoire en ligne ;
- acompte de 30 % du montant total pour une réservation standard et de 50 % pour une privatisation ;
- paiement différé du solde en ligne entre 24 heures et 12 heures avant le départ, puis sur place ;
- enregistrement manuel du paiement du solde sur place par le patron ;
- ajout des états « réservée », « réalisée » et « annulée » et des statuts de paiement « en attente de paiement », « acompte payé », « intégralement payé » et « remboursé » ;
- adaptation des annulations, absences et modifications au fonctionnement par acompte et solde ;
- génération d'un justificatif d'acompte puis d'une facture finale.

---

# 1. Contexte et objectifs du projet

## 1.1 Présentation

Ti Baleine est une entreprise qui organise des sorties d'observation des baleines et des dauphins ainsi que des privatisations pour d'autres types de sorties. L'entreprise dispose de deux bateaux de 12 et 24 places. Elle est composée du patron, d'un naturaliste et de deux skippers. Les sorties peuvent être organisées tous les jours de la semaine. Les clients cibles sont les touristes, les habitants locaux et les hôtels partenaires.

## 1.2 Origine du projet

Le projet répond à la difficulté de gérer les réservations, les échanges et les paiements principalement par WhatsApp. La solution attendue est une application web permettant aux clients de consulter les créneaux, réserver, payer et suivre leurs réservations en ligne, tout en facilitant la gestion par l'entreprise.

## 1.3 Objectifs

### Objectif principal

Permettre à l'entreprise d'organiser les sorties de manière plus structurée et de simplifier les échanges entre les clients et l'équipe.

### Objectifs secondaires

- fluidifier la création, la consultation, la modification et l'annulation des réservations ;
- sécuriser la réservation par un acompte obligatoire ;
- permettre le suivi de l'acompte, du solde et des remboursements ;
- réduire les tâches manuelles liées aux communications et aux paiements ;
- améliorer l'expérience client grâce à une réservation en ligne simple et sécurisée.

### Résultats attendus

- diminution de la charge de travail liée à l'organisation par WhatsApp ;
- amélioration de l'image et de la visibilité de l'entreprise ;
- réduction du risque de réservation non honorée grâce à l'acompte ;
- suivi clair des montants encaissés, restant dus et remboursés ;
- meilleure organisation de l'équipe et des places disponibles.

## 1.4 Enjeux

Les enjeux concernent l'amélioration potentielle du chiffre d'affaires, la sécurisation des encaissements, l'accès rapide aux informations par l'équipe et une meilleure qualité de service pour les clients.

# 2. Présentation de l'existant

## 2.1 Système actuel

Le fonctionnement actuel repose principalement sur WhatsApp pour la réservation, la communication, la planification et le suivi des clients. Le paiement est également géré avec des interventions manuelles. Ce fonctionnement présente des difficultés organisationnelles, un manque de traçabilité et un risque d'erreur dans le suivi des places et des paiements.

## 2.2 Environnement technique

Aucune infrastructure historique n'est imposée. L'application doit être hébergée sur le web. La stack et les services externes sont choisis par l'équipe selon les contraintes du projet et les décisions d'architecture documentées.

## 2.3 Utilisateurs concernés (personas)

- **Jean Bernard** — Patron
- **Maurice** — Employé
- **Claudette** — Cliente

Le patron dispose d'un accès complet à la gestion des réservations et des paiements. Les employés peuvent consulter les réservations selon leurs droits, sans les modifier. Les clients peuvent réserver, payer et consulter leurs propres réservations.

# 3. Périmètre du projet

## 3.1 Inclus

- inscription et connexion des clients ;
- connexion du patron et des employés ;
- création d'une réservation par un client ou par le patron ;
- consultation des créneaux disponibles ;
- consultation des réservations ;
- demande et traitement d'une annulation ;
- modification d'une réservation par le patron ;
- paiement en ligne de l'acompte ;
- paiement du solde en ligne ou sur place selon l'échéance ;
- enregistrement du paiement du solde sur place par le patron ;
- suivi des états de réservation et des statuts de paiement ;
- envoi du lien de paiement du solde par courrier électronique ;
- remboursement et report selon les règles métier ;
- génération d'un justificatif d'acompte et d'une facture finale ;
- gestion des comptes et réservations des hôtels partenaires selon les règles existantes.

## 3.2 Exclu (hors périmètre)

| Élément écarté | Motif |
|---|---|
| Affichage en temps réel de la météo | Le patron consulte Météo 974 ; seule la gestion des alertes et annulations météo est intégrée. |
| Système d'avoir client | Le client choisit entre un remboursement et un report ; aucun avoir financier n'est demandé. |
| Remboursement automatique depuis l'application | Le remboursement reste traité par le patron selon le fonctionnement existant ; l'application en assure le calcul et la traçabilité. |
| Réglementations de sécurité maritime dans l'application | Le client n'a pas demandé la gestion de ces réglementations dans l'application. |
| Paiement de l'acompte sur place | L'acompte doit obligatoirement être payé en ligne. Seul le solde peut être enregistré comme payé sur place. |
| Recouvrement automatique des compléments impayés | Un complément non réglé reste enregistré comme impayé ; aucune procédure automatique de relance ou de recouvrement n'est demandée. |
| Modification du mécanisme de blocage des places | Le mécanisme temporaire existant est explicitement conservé. |

# 4. Besoins fonctionnels

Priorité : **Must / Should / Could / Won't**

| ID | Exigence | Priorité | Persona | Source |
|---|---|---|---|---|
| REQ-001 | Réserver une sortie en ligne en indiquant le type, la date, l'heure, le nombre d'adultes et d'enfants, l'adresse électronique et le téléphone. La réservation d'un client particulier est confirmée après paiement de l'acompte. | Must | Client | CR-01/Q01, CR-01/Q03, CR-05/Q67 à Q69 |
| REQ-002 | Créer un compte au moment de la réservation. | Should | Client | CR-03 §4 |
| REQ-003 | Se connecter et accéder à la vue correspondant au rôle : client, employé ou patron. | Must | Patron, employé, client | CR-02 §4 |
| REQ-004 | Consulter ses propres réservations, leur état et leur statut de paiement. | Should | Client | CR-02 §4, CR-05/Q77 à Q78 |
| REQ-005 | Consulter et gérer les réservations côté entreprise. | Must | Patron | CR-01/Q11, CR-05/Q75 |
| REQ-006 | Payer obligatoirement l'acompte en ligne, puis régler le solde en ligne ou sur place selon l'échéance. | Must | Client | CR-01/Q07, CR-05/Q64 à Q75 |
| REQ-007 | Demander l'annulation d'une réservation en fournissant un motif. | Could | Client | CR-01/Q04, CR-01 §3 |
| REQ-008 | Consulter les créneaux disponibles avant de réserver. | Must | Client | CR-01 §5, CR-03 §5 |
| REQ-009 | Traiter une annulation en calculant les frais ou le remboursement selon le délai, le montant initial et les sommes déjà payées. | Could | Patron | CR-01 §1, CR-05/Q79 à Q84 |
| REQ-010 | Modifier une réservation : report, ajout ou suppression de participants, sans recalculer l'acompte déjà payé. | Could | Patron | CR-01/Q25, CR-03/Q44, CR-05/Q85 à Q87 |
| REQ-011 | Créer un compte hôtel et consulter les créneaux disponibles. | Could | Hôtel | CR-03 §5 |
| REQ-012 | Réserver pour un hôtel, directement ou via le patron, dans la limite de 6 places et hors privatisation. | Could | Patron, hôtel | CR-03 §5, contrainte 02 |
| REQ-013 | Facturer l'hôtel en fin de mois avec une remise de 15 %. | Could | Hôtel | CR-03 §3 |
| REQ-014 | Proposer l'interface en français et en anglais. | Could | Client | CR-01 §3 |
| REQ-015 | Afficher des liens vers Facebook et Instagram. | Could | Client | CR-03/Q46 |
| REQ-016 | Envoyer un avertissement météo la veille à 18 h par SMS ou mail et afficher une alerte sur le site. | Must | Patron | CR-04/Q48, CR-04/Q52 |
| REQ-017 | Annuler une sortie par créneau, notifier automatiquement les clients et rembourser 100 % des sommes payées ou enregistrer un report accepté. | Must | Patron | CR-04/Q54 à Q57, CR-05/Q83 à Q84 |
| REQ-018 | Rembourser à 100 % les sommes payées par un client qui annule après avoir reçu l'avertissement météo. | Must | Client | CR-04/Q58, CR-05/Q84 |
| REQ-019 | Bloquer temporairement les places pendant la réservation et les libérer en cas de paiement non finalisé. | Should | Client | CR-04/Q61, CR-05/Q69 |
| REQ-020 | Vérifier la disponibilité des services externes et gérer leur indisponibilité. | Should | Patron | CR-04/Q63 |
| REQ-021 | Calculer un acompte égal à 30 % du montant total d'une réservation standard et à 50 % du montant total d'une privatisation. | Must | Client | CR-05/Q64 à Q66 |
| REQ-022 | Envoyer automatiquement le lien de paiement du solde 24 heures avant le départ et le rendre inutilisable 12 heures avant le départ. | Must | Client | CR-05/Q71 à Q74 |
| REQ-023 | Permettre au patron d'enregistrer le solde payé sur place et empêcher la participation si le solde exigible n'est pas réglé. | Must | Patron | CR-05/Q75 à Q76 |
| REQ-024 | Générer un justificatif après le paiement de l'acompte et une facture finale après le paiement intégral. | Must | Client, patron | CR-05/Q88 |
| REQ-025 | Conserver séparément l'état de la réservation et son statut global de paiement. | Must | Client, patron | CR-05/Q77 à Q78 |

> **Précision concernant les hôtels :** l'acompte obligatoire ne s'applique pas aux réservations des hôtels. Celles-ci conservent la facturation en fin de mois et portent le statut « en attente de paiement » jusqu'à leur règlement intégral.

## 4.1 Règles métier

| # | Règle | Source |
|---|---|---|
| R-01 | Le client peut faire une réservation en ligne. | CR-01/Q01 |
| R-02 | Le client peut payer en ligne. | CR-01/Q07 |
| R-06 | Une sortie ne dépasse jamais la capacité de son bateau, soit 12 ou 24 places. | CR-01/Q02 |
| R-07 | Une réservation concerne au minimum 2 personnes et une sortie est maintenue à partir de 6 personnes par bateau. | CR-01 §3 ; CR-01/Q22 |
| R-08 | Pour une annulation client effectuée au moins 48 heures avant le départ, le barème existant reste applicable : remboursement de 100 % à plus de 7 jours et de 75 % entre 7 jours et 48 heures. À moins de 48 heures, R-92 s'applique. | CR-01 §1 et §3 ; CR-05/Q79, Q82 |
| R-09 | L'entreprise peut annuler pour cause météorologique ou technique, notifier les clients et proposer un remboursement ou un report. | CR-01/Q05 ; CR-02 §1 ; CR-05/Q83 |
| R-10 | Une seule sortie baleine peut être organisée par créneau. | CR-02 §1 ; CR-01/Q19 |
| R-11 | Le tarif enfant s'applique de 4 à 11 ans, le tarif adulte à partir de 12 ans et l'accès est interdit aux moins de 4 ans. | CR-01/Q14 |
| R-14 | Une réservation avec acompte payé peut être modifiée par le patron ; l'ajout augmente le solde et la suppression le diminue. | CR-03/Q44 ; CR-05/Q85 à Q87 |
| R-15 | Un hôtel bénéficie d'une remise de 15 % en fin de mois, peut réserver au maximum 6 places par créneau, ne peut pas réserver une privatisation et peut passer par le patron. | CR-03 §3 |
| R-16 | Le client peut faire une demande de réservation en ligne. | CR-01/Q03 |
| R-17 | Après la soumission du formulaire, le client particulier paie l'acompte en ligne ; ce paiement confirme la réservation. | CR-01/Q07 ; CR-05/Q67 à Q69 |
| R-18 | Les données saisies lors de l'inscription ou de la réservation doivent être validées : nom, prénom, email, téléphone, type de réservation, nombre de personnes et date. | CR-01/Q01, Q03 |
| R-19 | L'utilisateur accède à une vue correspondant à son rôle : client, employé ou patron. | CR-01/Q11, Q19 ; CR-03 §4 |
| R-20 | Le client peut faire une demande d'annulation. | CR-01 §1, Q04 |
| R-21 | Une demande d'annulation comporte un motif et peut donner lieu à un échange entre les parties. | CR-02/Q38 |
| R-22 | La réservation passe à l'état « annulée » à l'issue de son annulation. | CR-01 §3 ; CR-05/Q77 |
| R-23 | Une réservation précise l'email, le téléphone, le type de sortie, la date, l'heure et le nombre d'adultes et d'enfants. | CR-01/Q01, Q03 |
| R-24 | Une réservation doit concerner au minimum 2 personnes. | CR-01 §3 |
| R-25 | Le bateau Ti Kap ne peut pas accueillir plus de 12 passagers. | CR-01/Q02 |
| R-26 | Le bateau Grand Bleu ne peut pas accueillir plus de 24 passagers. | CR-01/Q02 |
| R-27 | Une sortie est maintenue à partir de 6 passagers minimum par bateau. | CR-01/Q22 ; CR-02 §1 |
| R-28 | Une même réservation peut concerner les deux bateaux dans le cas exceptionnel d'une privatisation. | CR-01/Q26 ; CR-02 §1 |
| R-29 | Une seule sortie baleine peut être organisée sur un même créneau en raison de la présence d'un seul naturaliste. | CR-01/Q19 ; CR-02 §1 |
| R-30 | Lorsque les deux bateaux sont mobilisés, leurs départs sont organisés à la même heure. | CR-02 §1 |
| R-31 | Les sorties peuvent être proposées tous les jours de la semaine. | CR-01/Q23 ; CR-02 §1 |
| R-32 | Les créneaux habituels sont 7 h, 10 h et 14 h. | CR-01 §3 |
| R-33 | Une sortie baleine dure 2 h 30. | CR-01 §3 |
| R-34 | Une sortie dauphin dure 2 h. | CR-01 §3 |
| R-35 | Une privatisation peut être organisée le matin, notamment pour proposer un brunch. | CR-01/Q13 ; CR-02 §1 |
| R-36 | Les enfants de moins de 4 ans ne sont pas autorisés. | CR-01/Q14 |
| R-37 | Les passagers de 4 à 11 ans relèvent du tarif enfant. | CR-01/Q14 |
| R-38 | Le tarif adulte s'applique à partir de 12 ans. | CR-01/Q14 |
| R-39 | Une sortie baleine coûte 65 € par adulte et 40 € par enfant. | CR-01 §3 |
| R-40 | Une sortie dauphin coûte 50 € par adulte et 30 € par enfant. | CR-01 §3 |
| R-41 | Une privatisation à la demi-journée coûte 600 € pour Ti Kap et 1 100 € pour Grand Bleu. | CR-01 §3 |
| R-42 | Pour un client particulier, l'acompte est toujours payé en ligne ; le solde est payé en ligne ou sur place selon l'échéance. | CR-01/Q07 ; CR-05/Q67, Q71 à Q75 |
| R-43 | Le paiement de l'acompte intervient après la soumission du formulaire de réservation. | CR-04/Q64 ; CR-05/Q67 |
| R-44 | L'entreprise peut annuler une sortie jusqu'à 2 heures avant le départ en raison des conditions météorologiques. | CR-01/Q05 ; CR-04/Q54 |
| R-45 | L'entreprise peut annuler une sortie la veille en cas de problème concernant un bateau. | CR-01/Q05 |
| R-46 | En cas d'annulation par l'entreprise, les clients concernés sont contactés par SMS ou email. | CR-04/Q49, Q56 |
| R-47 | En cas d'annulation par l'entreprise, la réservation passe à l'état « annulée » et le client choisit entre le remboursement intégral des sommes payées et un report accepté. | CR-04/Q56, Q59 ; CR-05/Q83 |
| R-48 | Lorsqu'une annulation client intervient plus de 48 heures avant le départ, un nouveau créneau peut être proposé si les conditions le permettent. Cette règle est complétée par R-80. | CR-02 §3 |
| R-49 | Le remboursement est traité par le patron à partir des informations de paiement et n'est pas exécuté automatiquement par l'application. | CR-01/Q15 ; CR-02 §1 |
| R-50 | Une demande de modification d'une réservation s'effectue par téléphone. | CR-01/Q25 ; CR-02 §3 |
| R-51 | Une réservation avec acompte payé peut être modifiée par le patron sous réserve du délai autorisé. | CR-03/Q44 ; CR-05/Q85 à Q87 |
| R-52 | L'ajout de participants augmente le montant courant et la différence est ajoutée au solde. | CR-03/Q44 ; CR-05/Q86 |
| R-53 | Les instructions de paiement du montant restant suivent les règles d'envoi du lien de solde ou du paiement sur place. | CR-03/Q44 ; CR-05/Q71 à Q75 |
| R-54 | Le retrait de participants diminue le solde sans recalculer l'acompte ; si les sommes payées dépassent le nouveau total, la différence est remboursée. | CR-03/Q44 ; CR-05/Q85 |
| R-55 | Un hôtel partenaire peut réserver des places pour une sortie baleine ou dauphin. | CR-03 §3 |
| R-56 | Un hôtel peut réserver au maximum 6 places par créneau. | CR-03 §3 |
| R-57 | Un hôtel ne peut pas réserver une privatisation. | CR-03 §3 |
| R-58 | Les réservations d'un hôtel sont facturées en fin de mois et portent le statut « en attente de paiement » jusqu'à leur règlement intégral. | CR-03 §3 ; CR-05/Q78 |
| R-60 | Un hôtel partenaire bénéficie d'une remise de 15 % sur le montant total facturé en fin de mois. | CR-03 §3 |
| R-61 | Une réservation pour un hôtel peut être créée par le patron à la suite d'un appel, d'un email ou d'un contact direct. | CR-03 §5 |
| R-62 | Une personne de l'hôtel gère la réservation, reçoit les informations et prévient les clients de l'hôtel. | CR-04/Q60 |
| R-63 | Une alerte sur le site prévient des mauvaises conditions météorologiques prévues pour le lendemain. | CR-04/Q52 |
| R-64 | Le contenu des messages d'alerte et d'annulation peut être personnalisé. | CR-04/Q49 |
| R-65 | Le SMS d'alerte ou d'annulation est envoyé depuis le numéro de l'entreprise. | CR-04/Q49 |
| R-66 | L'annulation suivant un avertissement est confirmée au moins 2 heures avant le début de la sortie. | CR-04/Q54 |
| R-67 | Le message d'avertissement et l'alerte sur le site sont envoyés à 18 h la veille. | CR-04/Q48 |
| R-68 | L'alerte indique que le client peut annuler sans frais. | CR-04/Q58 |
| R-69 | L'entreprise peut annuler un créneau complet et toutes les réservations associées. | CR-04/Q55 |
| R-70 | En cas d'annulation météo, le client revient vers l'entreprise pour choisir entre un remboursement et un report. | CR-04/Q59 |
| R-71 | Les messages et alertes sont disponibles en français et en anglais. | CR-04/Q51 ; CR-01 §3 |
| R-72 | En cas d'annulation, l'entreprise contacte directement l'hôtel par téléphone. | CR-04/Q60 |
| R-73 | Lors d'une annulation, les SMS ou emails sont envoyés automatiquement aux clients concernés, quelle que soit la cause. | CR-04/Q50, Q56 |
| R-74 | Une annulation à l'initiative de l'entreprise entraîne le remboursement de 100 % des sommes déjà payées ou un report accepté par le client. | CR-04/Q50, Q57 ; CR-05/Q83 |
| R-75 | En l'absence de confirmation d'annulation après l'avertissement, les sorties sont maintenues. | CR-04/Q48, Q53 |
| R-76 | Le client qui annule après l'avertissement météo est remboursé à 100 % des sommes payées. | CR-04/Q58 ; CR-05/Q84 |
| R-77 | Deux clients ne peuvent pas réserver simultanément la même place. | CR-04/Q61 |
| R-78 | Un badge « nouvelle place disponible » est affiché lorsqu'un créneau complet redevient disponible. | CR-04/Q62 |
| R-79 | Le paiement de l'acompte est déclenché uniquement après la soumission du formulaire. | CR-04/Q64 ; CR-05/Q67 |
| R-80 | Lorsqu'une annulation client intervient plus de 48 heures avant le départ, le client choisit avec l'entreprise entre un remboursement et un report. | CR-04/Q59 |
| R-81 | L'acompte d'une réservation standard est égal à 30 % du montant total. | CR-05/Q64 |
| R-82 | L'acompte d'une privatisation est égal à 50 % du montant total. | CR-05/Q65 |
| R-83 | Une réservation d'un client particulier ne peut pas être créée ou confirmée sans paiement en ligne de l'acompte. | CR-05/Q66 à Q69 |
| R-84 | Le paiement de l'acompte confirme la réservation et bloque définitivement les places ; les règles de blocage temporaire restent inchangées avant ce paiement. | CR-05/Q68 à Q69 |
| R-85 | Pour une réservation créée plus de 24 heures avant le départ, un lien de paiement du solde est envoyé 24 heures avant et expire 12 heures avant le départ. | CR-05/Q71 à Q72 |
| R-86 | Entre 24 heures et 12 heures avant le départ, le client peut payer la totalité en ligne ou payer l'acompte en ligne puis le solde sur place. | CR-05/Q70, Q73 |
| R-87 | À moins de 12 heures du départ, le client paie l'acompte en ligne et le solde sur place. | CR-05/Q74 |
| R-88 | Seul le patron peut enregistrer manuellement le solde comme payé sur place ; l'acompte ne peut jamais être enregistré de cette manière. | CR-05/Q75 |
| R-89 | Si le solde exigible n'est pas payé sur place, le client ne peut pas participer ou embarquer et la réservation est annulée. | CR-05/Q76 |
| R-90 | Une réservation possède l'un des états suivants : « réservée », « réalisée » ou « annulée ». | CR-05/Q77 |
| R-91 | Le statut global du paiement est « en attente de paiement », « acompte payé », « intégralement payé » ou « remboursé ». | CR-05/Q78 |
| R-92 | À moins de 48 heures du départ, les frais d'annulation client sont égaux à 50 % du montant initial. Les sommes déjà payées sont déduites. Un complément peut être payé par un lien valable 24 heures ou sur place ; s'il n'est pas payé, il reste impayé. | CR-05/Q79 à Q80 |
| R-93 | En cas d'absence le jour de la prestation, le client n'est pas remboursé et les sommes déjà encaissées sont conservées. | CR-05/Q81 |
| R-94 | Si l'entreprise annule, le client reçoit 100 % des sommes déjà payées ou accepte un report sur un autre créneau. | CR-05/Q83 |
| R-95 | En cas d'annulation météo, si seul l'acompte a été payé et que le client choisit le remboursement, cet acompte est remboursé intégralement. | CR-05/Q84 |
| R-96 | Les privatisations suivent les mêmes règles de solde, d'annulation, de remboursement et de modification que les réservations standards. | CR-05/Q65, §1 |
| R-97 | Lors d'une modification du nombre de participants, l'acompte déjà payé n'est pas recalculé ; seul le montant courant et le solde évoluent. | CR-05/Q85 à Q86 |
| R-98 | Les frais d'annulation restent calculés sur le montant initial de la réservation, même après une modification. | CR-05/Q87 |
| R-99 | Un justificatif est généré après le paiement de l'acompte et une facture finale après le paiement intégral. | CR-05/Q88 |
| R-100 | Les moyens de paiement acceptés restent ceux utilisés par l'entreprise ; pour un client particulier, l'acompte reste obligatoirement en ligne. | CR-05 §1 |
| R-101 | Lors de sa confirmation, une réservation passe à l'état « réservée ». Pour un client particulier, son statut est « acompte payé ». Pour un hôtel facturé en fin de mois, son statut est « en attente de paiement ». Le règlement complet fait passer le statut à « intégralement payé » sans modifier l'état de la réservation. Après la prestation, la réservation passe à l'état « réalisée ». Une annulation la fait passer à l'état « annulée ». | CR-05/Q68, Q77 à Q78 |

> Note : les numéros R-03, R-04, R-05, R-12, R-13 et R-59 n'apparaissent pas dans le document source historique.

# 5. Besoins non fonctionnels

| ID | Exigence | Comment on la vérifie | Source |
|---|---|---|---|
| REQ-100 | Le temps de réponse doit rester inférieur à 2 secondes avec une connexion 4G dans les parcours principaux. | Mesure du temps de traitement des requêtes de consultation, réservation et paiement. | Aucune source |
| REQ-101 | L'application doit respecter le RGPD. | Vérification des mentions, du traitement et de la protection des données personnelles. | CR-03/Q42 |
| REQ-102 | L'authentification et les autorisations dépendent du rôle de l'utilisateur. | Vérification des accès client, employé et patron et du blocage des fonctions interdites. | CR-01/Q11 ; CR-03 §4 |
| REQ-103 | Les failles de sécurité connues doivent être suivies et corrigées. | Veille de sécurité, journaux et historique Git des corrections. | Aucune source |
| REQ-104 | Aucune charte graphique n'est imposée. | Validation visuelle par le client. | CR-03/Q45 |
| REQ-105 | L'application doit fonctionner sur les navigateurs et appareils courants. | Tests sur plusieurs navigateurs, ordinateurs, tablettes et téléphones. | CR-01/Q09 ; CR-03/Q43 |
| REQ-106 | L'application doit respecter le RGAA. | Audit d'accessibilité, notamment avec Lighthouse. | Aucune source |
| REQ-107 | Les contenus destinés aux clients doivent être disponibles en français et en anglais. | Test avec les deux langues sur l'interface, les alertes et les messages. | CR-01 §3 ; CR-04/Q51 |
| REQ-108 | Les opérations financières doivent être traçables et ne pas être enregistrées deux fois. | Vérification de l'historique des acomptes, soldes, remboursements et traitements répétés d'un même retour de paiement. | CR-05/Q77 à Q88 ; impact CR-001 |

# 6. Contraintes du projet

Nature : budget / délai / technique / réglementaire / humaine / métier / financière

| # | Contrainte | Nature | Source |
|---|---|---|---|
| 1 | La solution doit être accessible sur les ordinateurs de l'entreprise. | Technique | CR-01/Q09 |
| 2 | La solution doit être accessible sur tout type d'appareil courant pour les clients. | Technique | CR-01/Q09 |
| 3 | Aucun budget n'est déterminé. | Budget | CR-01/Q16 ; CR-02 §3 |
| 4 | La date de livraison prévue est le 21/08/2026. | Délai | Planning projet |
| 5 | La solution est un site web responsive. | Technique | CR-01/Q09 |
| 6 | Le projet traite et héberge des données personnelles et doit respecter le RGPD. | Réglementaire | CR-03/Q42 |
| 7 | Pour un client particulier, l'acompte est obligatoirement payé en ligne. | Financière / métier | CR-05/Q67 |
| 8 | Pour un client particulier, une réservation standard nécessite un acompte de 30 % et une privatisation un acompte de 50 %. | Financière / métier | CR-05/Q64 à Q65 |
| 9 | Une réservation d'un client particulier n'existe pas sans acompte payé. | Métier | CR-05/Q66 à Q69 |
| 10 | Le paiement en ligne du solde est disponible uniquement entre 24 heures et 12 heures avant le départ. | Temporelle / financière | CR-05/Q71 à Q74 |
| 11 | Après expiration du lien, le solde est payé sur place et enregistré par le patron. | Métier / financière | CR-05/Q72, Q75 |
| 12 | Le client ne peut pas participer si le solde exigible n'est pas payé. | Métier | CR-05/Q76 |
| 13 | Le montant initial doit être conservé pour le calcul des frais d'annulation après modification. | Financière / données | CR-05/Q87 |
| 14 | L'acompte déjà encaissé ne doit pas être recalculé après modification de la réservation. | Financière / données | CR-05/Q85 à Q86 |
| 15 | Le système doit conserver une trace distincte de chaque acompte, solde, complément et remboursement. | Technique / financière | CR-05/Q77 à Q88 ; impact CR-001 |

# 7. Planning et jalons

| Jalon / Livrable | Date prévisionnelle | Responsable |
|---|---|---|
| Cahier des charges V5 | 19/08/2026 | Équipe 200ping |
| Mise à jour des spécifications, modèles et tests | 20/08/2026 | Équipe 200ping |
| Livraison de l'application | 21/08/2026 | Équipe 200ping |

# 8. Questions restées ouvertes

| # | Question | Posée le | Réponse connue | Hypothèse retenue en attendant |
|---|---|---|---|---|
| 1 | Les types de sorties sont-ils définis à l'avance selon le jour ? | 12/08/2026 | Non, le créneau est proposé selon les places. | Les types ne sont pas prédéfinis par jour. |
| 2 | Deux sorties baleine peuvent-elles avoir lieu le même matin malgré le chevauchement des créneaux de 7 h et 10 h ? | 12/08/2026 | Le client indique que oui, mais les contraintes de durée et de naturaliste semblent l'empêcher. | Une seule sortie baleine à la fois jusqu'à validation contraire. |
| 3 | Sous quel format l'historique des paiements doit-il être présenté ? | — | Les statuts sont définis, pas le format de l'historique. | Afficher chronologiquement chaque opération financière. |
| 6 | Le patron doit-il pouvoir ajouter un nouveau bateau ? | — | — | Fonction non prévue. |
| 7 | Quel format doit utiliser la référence d'une réservation ? | — | — | Référence technique unique générée automatiquement. |
| 8 | À quelle étape les passagers sont-ils affectés à un bateau et par qui ? | — | — | Affectation par le patron avant le départ. |
| 9 | Le patron peut-il refuser une demande de réservation déjà accompagnée d'un acompte ? | — | Le paiement de l'acompte confirme automatiquement la réservation. | Aucun refus manuel après encaissement, hors annulation de la sortie. |
| 10 | Le client annule-t-il depuis le site ou uniquement par téléphone ? | — | — | Demande possible depuis le site avec motif, puis traitement par le patron. |
| 15 | Pour quels motifs et à quelle étape le patron peut-il refuser une réservation ? | — | — | Aucun refus après paiement réussi de l'acompte. |
| 16 | L'acompte obligatoire s'applique-t-il aussi aux réservations des hôtels, actuellement facturées en fin de mois ? | 19/08/2026 | Non. Les hôtels restent facturés en fin de mois avec le statut « en attente de paiement ». | Le fonctionnement des hôtels reste inchangé. |
| 17 | Quelle règle d'arrondi faut-il appliquer lorsque l'acompte comporte une fraction de centime ? | 19/08/2026 | — | Arrondi monétaire au centime le plus proche, à valider. |
| 18 | Quel contenu exact doit comporter le mail du lien de paiement du solde ? | 19/08/2026 | Il doit avertir du paiement sur place après expiration. | Contenu fonctionnel minimal en français et en anglais. |
| 19 | Quel format, quelle numérotation et quelles mentions doivent comporter le justificatif d'acompte et la facture finale ? | 19/08/2026 | — | Documents PDF avec références uniques, à valider. |
| 20 | Les échéances de 24 heures et 12 heures sont-elles calculées à la minute exacte et dans quel fuseau horaire ? | 19/08/2026 | — | Calcul à la minute dans le fuseau horaire local de la prestation. |
| 21 | En cas d'absence, un éventuel solde non encore payé reste-t-il dû en plus de l'absence de remboursement ? | 19/08/2026 | Q81 confirme uniquement qu'aucun remboursement n'est effectué. | Les sommes encaissées sont conservées ; aucun complément n'est recouvré sans confirmation. |
| 22 | Quels moyens de paiement sont acceptés pour régler le solde sur place ? | 19/08/2026 | Les moyens de paiement restent « les mêmes qu'actuellement », sans liste explicite. | Le patron utilise les moyens déjà disponibles dans l'entreprise. |
| 23 | Le statut « remboursé » doit-il distinguer un remboursement partiel d'un remboursement total ? | 19/08/2026 | Quatre statuts seulement ont été demandés, sans distinction entre remboursement partiel et total. | Conserver le montant remboursé dans l'historique, même si le statut global reste « remboursé ». |

# 9. Validation du document

Ce cahier des charges V5 intègre le compte rendu d'entretien n°5 et l'analyse d'impact CR-001. Les hypothèses de la section 8 doivent être confirmées par le client. Toute modification touchant le paiement, les annulations ou le modèle de données doit rester traçable depuis les exigences et règles métier de ce document.
