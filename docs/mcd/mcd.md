# MCD — Modèle Conceptuel de Données

| Informations            | Détails                                        |
| ----------------------- | ---------------------------------------------- |
| **Projet**              | TI Baleine App                                 |
| **Équipe**              | 200ping                                        |
| **Source**              | `Cahier_des_charges_200ping_V2.md` (V2.0), `compte-rendu-entretien-01.md` (CR-01), `compte-rendu-entretien-02.md` (CR-02) |
| **Date**                | 12/08/2026                                     |
| **Décision associée**   | `adr/ADR-001-stack.md` (persistance : Doctrine) |

> **Règle de construction :** ce MCD est issu **uniquement** du cahier des charges
> et, pour les éléments qu'il ne précisait pas, des comptes-rendus d'entretien
> (CR-01, CR-02) qui en sont la source. Chaque élément cite son passage d'origine.
> Rien n'est ajouté sans source.
>
> **Rôles (décision équipe, corrigée le 12/08/2026) :** trois rôles —
> `utilisateur` (client), `employe` (salarié : consultation seule) et
> `administrateur` (patron : accès complet, dont modification).

---

## 1. Concepts du cahier retenus

| Concept | Justification (cahier) |
|---|---|
| **Utilisateur** | « Inscription », « Connexion (client et entreprise) », « Notification par mail », « Vérification des rôles » |
| **Sortie** (créneau réservable) | « organise des sorties baleine et dauphin et possibilité de privatisation pour d'éventuelles autres types de sorties », « Les clients peuvent réserver leurs créneaux », « Les horaires sont tous les jours de la semaine » |
| **Bateau** | « L'entreprise dispose de deux bateaux de 12 et 24 places » |
| **Réservation** | « Faire une réservation », « Attente de validation → Confirmation / Refus → Paiement », « Demande d'annulation », « Modification … uniquement possible lorsque la demande est encore en attente » |
| **Paiement** | « Paiement en ligne (client) », « Confirmation → Paiement » |
| **Tarif** | CR-01 §3 : « 65 € adulte 40 € enfant pour baleine, 50 € adulte et 30 € enfant pour dauphin. Privatisation … 600 € ti kap et 1 100 € pour grand bleu » |
| **Hotel** | CR-03 §3 : « rajouter une clientèle hôtel qui pourrait réserver des créneaux baleines ou dauphins et payer en fin de mois » ; remise -15 %, max 6 places/créneau, pas de privatisation |

La **demande d'annulation** et la **modification** ne sont pas des entités : ce
sont des règles portées par la `Réservation` (état + motif), voir §5.

---

## 2. Entités et attributs

### UTILISATEUR

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique (convention MCD) |
| Nom | décision équipe 12/08/2026 (reprise du MCD LucidChart) |
| Prénom | décision équipe 12/08/2026 (reprise du MCD LucidChart) |
| Email | « Notification par mail », « Connexion » ; CR-01/Q01 (email demandé à la réservation) |
| Mot de passe | « Connexion » — *nullable* dans le MCD LucidChart (mot de passe optionnel, à confirmer) |
| Téléphone | CR-01/Q03 : « Le client laisse son numéro de téléphone lors de la réservation. Appel si annulation. » |
| Rôle | décision équipe (corrigée le 12/08/2026) : `utilisateur` (client) / `employe` (salarié, consultation seule) / `administrateur` (patron, accès complet) — « Vérification des rôles → Accès à la vue concernée (client, salarié ou patron) » |

### SORTIE  *(créneau réservable)*

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| Type | « sorties baleine et dauphin et possibilité de privatisation pour d'éventuelles autres types de sorties » (baleine, dauphin, privatisation…) ; CR-01/Q01 |
| Date | « Les horaires sont tous les jours de la semaine » ; CR-01/Q23 (tous les jours) |
| Horaire de départ | CR-01 §3 : créneaux 7 h, 10 h et 14 h |
| Durée | CR-01 §3 : 2 h 30 (baleine), 2 h (dauphin) |

> Une sortie baleine par créneau (CR-02 §1, CR-01/Q19) ; question ouverte n°1 du
> cahier : les types ne sont **pas** définis en avance en fonction du jour
> (hypothèse retenue).

### BATEAU

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| Nom | CR-01 §3 : Ti Kap et Grand Bleu |
| Capacité | « deux bateaux de 12 et 24 places » ; CR-01/Q02 : Ti Kap = 12 places, Grand Bleu = 24 places |

### RÉSERVATION

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| État | « Attente de validation → Confirmation / Refus » + « Demande d'annulation » : `en_attente`, `confirmée`, `refusée`, `annulée` |
| Motif d'annulation | « Demande d'annulation → Envoi du motif » (renseigné uniquement si annulation) |
| Nombre d'adultes | CR-01/Q01 : « nombre de personnes (+ nombre d'adultes et d'enfants) » |
| Nombre d'enfants | CR-01/Q01 ; tranche d'âge enfant : 4-11 ans (CR-01/Q14, décision équipe 12/08/2026) |

> Minimum 2 personnes par réservation (CR-01 §3) ; minimum 6 personnes sur le
> bateau, pour les deux bateaux (CR-01/Q22, CR-02 §1).

### PAIEMENT

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| Montant | calculé à partir de la table `Tarif` (CR-01 §3) |

> Paiement **uniquement en ligne** (CR-01/Q07), « pas de prestataire fixe »
> (CR-01 §3 ; l'ADR-001 prévoit Stripe). Remboursement géré par le patron et
> crédité sur la carte bancaire du paiement (CR-02 §1). Statut et référence de la
> transaction non précisés : voir [questions encore ouvertes](#73-questions-encore-ouvertes).

### TARIF

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| Type de sortie | CR-01 §3 : baleine, dauphin, privatisation |
| Catégorie | CR-01/Q14 + décision équipe : adulte (12 ans et +), enfant (4-11 ans) ; sans objet pour la privatisation |
| Bateau | CR-01 §3 : tarif de privatisation par bateau (600 € Ti Kap / 1 100 € Grand Bleu) |
| Montant | CR-01 §3 : 65/40 € baleine, 50/30 € dauphin |

### HOTEL

| Attribut | Justification |
|---|---|
| Identifiant | identifiant technique |
| Utilisateur (compte) | CR-03 §3 : création d'un compte hôtel ; un hôtel correspond à un compte utilisateur |
| Remise | CR-03 §3 : « remise de -15 % sur la totalité en fin de mois » |
| Places max | CR-03 contrainte 02 : « 6 places maximum par créneau pour l'hôtel » |
| Paiement fin de mois | CR-03 §3 : « payer en fin de mois » |

> ⚠️ Le paiement en fin de mois de l'hôtel est un **paiement différé**, que le
> cahier des charges V2 exclut pour les clients (« Paiement en espèce, chèque,
> différé »). À clarifier : l'exclusion concerne-t-elle uniquement les clients
> particuliers ? (voir §7.3)

---

## 3. Associations et cardinalités

| Association | Entité (card.) | Entité (card.) | Signification |
|---|---|---|---|
| **effectue** | UTILISATEUR (0,n) | RÉSERVATION (1,1) | un utilisateur effectue 0..n réservations ; une réservation est effectuée par un seul utilisateur |
| **concerne** | RÉSERVATION (1,1) | SORTIE (0,n) | une réservation concerne une seule sortie (créneau) ; une sortie est concernée par 0..n réservations |
| **donne lieu à** | RÉSERVATION (0,1) | PAIEMENT (1,1) | une réservation donne lieu à 0..1 paiement ; un paiement règle une seule réservation |
| **est organisée sur** | SORTIE (1,1) | BATEAU (0,n) | une sortie est organisée sur un seul bateau ; un bateau accueille 0..n sorties |
| **est tarifé en** | BATEAU (0,1) | TARIF (1,1) | un bateau a au plus un tarif de privatisation ; un tarif de privatisation concerne un seul bateau |
| **a pour profil hôtel** | UTILISATEUR (0,1) | HOTEL (1,1) | un utilisateur a au plus un profil hôtel ; un hôtel correspond à un seul compte utilisateur |

---

## 4. Schéma des tables (DBML)

Le modèle de données est décrit en **DBML** dans [`mcd.dbml`](mcd.dbml) : un
fichier texte à ouvrir dans dbdiagram.io ou via l'extension « Database Markup
Language » de VS Code. Les relations y sont exprimées en `ref` avec les
cardinalités (0,n / 1,n / 1,1), cf. aussi les cardinalités Merise du §3.

Tables : `Utilisateur`, `Bateau`, `Sortie`, `Reservation`, `Paiement`, `Tarif`, `Hotel`.

---

## 5. Règles métier portées par le modèle

Chacune est issue du cahier :

1. **Cycle de vie d'une réservation** : `en_attente` → `confirmée` / `refusée` ;
   une réservation confirmée est suivie d'un paiement. (« Attente de validation →
   Confirmation / Refus → Paiement »)
2. **Annulation** : une réservation peut être annulée sur demande du client avec
   envoi d'un motif. (« Demande d'annulation → Envoi du motif → … → Rendez-vous
   annulé »)
3. **Modification** : uniquement possible quand l'état est `en_attente`.
   (« La modification est uniquement possible lorsque la demande est encore en
   attente. »)
4. **Capacité** : une sortie ne dépasse jamais la capacité du bateau (12 ou 24
   places). (« deux bateaux de 12 et 24 places »)
5. **Accès par rôle** : `utilisateur` (client) réserve et consulte ses propres
   réservations ; `employe` (salarié) consulte les réservations sans pouvoir
   modifier ; `administrateur` (patron) accès complet (consulter + modifier).
   (décision équipe corrigée le 12/08/2026 + « Vérification des rôles »)

Règles complémentaires confirmées dans les entretiens (CR-01, CR-02) :

6. **Annulation client** : possible jusqu'à 48 h avant le départ. Remboursement
   total au-delà de 7 jours, 75 % entre 7 jours et 48 h, 50 % à partir de 48 h
   puis annulation. (CR-01 §1 et §3)
7. **Annulation entreprise** : décidée 2 h avant le départ (météo) ou la veille
   (problème de bateau), par téléphone, avec proposition de report. (CR-01/Q05, CR-02 §1)
8. **Places** : minimum 2 personnes par réservation, minimum 6 personnes par
   bateau, maximum = capacité du bateau. (CR-01 §3, CR-01/Q02)
9. **Sortie baleine** : une seule sortie baleine par créneau. (CR-02 §1, CR-01/Q19)
10. **Âge** : tarif enfant de 4 à 11 ans, tarif adulte à partir de 12 ans ; les
    moins de 4 ans n'ont ni tarif, l'accès leur étant interdit. (CR-01/Q14,
    décision équipe 12/08/2026)
11. **Mot de passe** : 8 caractères minimum avec caractères spéciaux.
    (cahier des charges V2 mis à jour — « Pour l'inscription »)
12. **Modification après paiement** : si signalée assez tôt (moins de 2 h avant
    le départ), le patron peut modifier la réservation et envoyer un mail pour le
    paiement du supplément (ajout de personne) ; une suppression de personne suit
    le même circuit que le remboursement. (CR-03/Q44)
13. **Clientèle hôtel** : remise -15 % sur le total en fin de mois ; maximum
    6 places par créneau ; pas de réservation de type privatisation ; réservation
    possible sans passer par le site (via le patron). (CR-03 §3, contraintes 02/03)

---

## 6. Ce qui n'est **pas** modélisé (et pourquoi)

| Élément | Raison |
|---|---|
| Météo en temps réel | exclue du périmètre (« Affichage en temps réel de la météo ») |
| Avoir client / remboursement | exclus du périmètre |
| Paiement en espèce, chèque, différé | exclus du périmètre (seul le paiement en ligne est retenu) |

---

## 7. Questions sans réponse : réponses issues des entretiens

### 7.1 Questions ouvertes du cahier (section 10)

| # | Question (cahier §10) | Réponse trouvée dans les entretiens | Source |
|---|---|---|---|
| 1 | Les types de sorties sont-ils définis en avance en fonction du jour ? | Pas de réponse explicite. Hypothèse conservée : non, ils ne sont pas définis en avance. | — |
| 2 | Possibilité d'avoir deux sorties baleines la matinée ? (superposition des horaires 7h/10h) | « Une sortie baleine par créneau. » → une seule sortie baleine par créneau (donc pas deux le matin). Encore listée comme question importante à confirmer dans CR-02 §8. | CR-02 §1 ; CR-01/Q19 |

### 7.2 Questions ouvertes du MCD résolues

| # | Question (v1 du MCD) | Réponse (entretiens) | Impact sur le modèle |
|---|---|---|---|
| 1 | Identité du client : nom / prénom / téléphone ? | Téléphone confirmé : « Le client laisse son numéro de téléphone lors de la réservation. » Nom/prénom jamais demandés. | + `Téléphone` sur `UTILISATEUR` ; nom/prénom non retenus |
| 2 | Nombre de personnes par réservation ? | « nombre de personnes (+ nombre d'adultes et d'enfants) » ; min 2 personnes/réservation ; min 6 personnes/bateau. | + `Nb adultes`, `Nb enfants` sur `RÉSERVATION` ; règles min 2 / min 6 |
| 3 | Montant, statut et référence du paiement ? | Paiement uniquement en ligne ; montant dérivable des tarifs ; remboursement sur la carte du paiement par le patron ; pas de prestataire fixe. | + `Montant` (calculé) sur `PAIEMENT` ; statut/référence à préciser |
| 4 | Nom du bateau ? | « 2 bateaux ti kap et grand bleu » : Ti Kap = 12 places, Grand Bleu = 24 places. | + `Nom` sur `BATEAU` |
| 5 | Date/heure de création et modification de la réservation ? | Jamais évoquées. | reste ouvert (7.3) |

### 7.3 Questions encore ouvertes

| # | Question | Pourquoi elle reste ouverte |
|---|---|---|
| 1 | Statut et référence du paiement ? | « pas de prestataire fixe » (CR-01 §3) ; ADR-001 prévoit Stripe |
| 2 | Date/heure de création et modification de la réservation ? | jamais évoquées |
| 3 | Types de sorties définis en avance en fonction du jour ? | pas de réponse explicite (cahier §10-Q1) |
| 4 | Paiement de l'hôtel en fin de mois : le cahier V2 exclut le « paiement différé » — l'exclusion concerne-t-elle uniquement les clients particuliers ? | conflit cahier V2 / CR-03 à lever |

### 7.4 Décisions de l'équipe (12/08/2026)

| # | Sujet | Décision |
|---|---|---|
| 1 | Compte client | **Oui, il y aura un compte client.** L'inscription/connexion client du cahier est conservée ; la réponse CR-01/Q10 (« pas de compte client pour le moment ») est obsolète. |
| 2 | Âge des passagers | Tarif enfant de **4 à 11 ans**, tarif adulte à partir de **12 ans** ; **pas de tarif ni d'accès pour les moins de 4 ans**. La mention CR-02 §1 (4-12 ans) est écartée. |
| 3 | Identité du client | Nom et prénom ajoutés à `Utilisateur` (reprise du MCD LucidChart, 12/08/2026). |
| 4 | Mot de passe | Rendu **optionnel** (nullable) dans le MCD LucidChart — à confirmer. |
| 5 | Clientèle hôtel | Modélisée en **table `Hotel` séparée** (liée à `Utilisateur`), avec remise -15 %, 6 places max et paiement fin de mois. (CR-03, décision équipe 12/08/2026) |
| 6 | Rôles | Trois rôles : `utilisateur` (client), `employe` (salarié — **consultation seule**, pas de modification) et `administrateur` (patron — accès complet). Corrige le PS initial « 2 rôles » (12/08/2026). |
