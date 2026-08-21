# Journal de projet — équipe `<NOM>`

Une entrée par jour, remplie au créneau 16h15. Aucune rubrique ne reste vide sans
justification.

Ce document est la seule trace de ce que vous avez **refusé** à l'IA, et de ce que
vos **acceptations ont changé**. Deux des trois questions obligatoires de la
présentation de J10 y trouvent leur réponse — ou n'en trouvent pas.

Une critique acceptée qui n'a rien changé est une acceptation fictive. À J9, une
autre équipe ira le vérifier dans votre dépôt.

---

## Gabarit d'entrée

```markdown
## J<n> — <date>

**Présents.** …

**Décisions.**

- …

**Critiques de l'IA acceptées.**

- <ce qu'elle a signalé> → <ce que nous avons changé> — <fichier ou sha court>

**Critiques de l'IA refusées, et pourquoi.**

- <ce qu'elle a signalé> → refusé, car <raison métier ou de conception>

**Erreurs produites par l'IA et détectées.**

- <ce qu'elle a produit> → <comment nous l'avons repéré> → <correction>

**Ce qui a été généré aujourd'hui.**

- <fichiers ou portions> — commits <sha courts>

**Questions ouvertes pour le client.**

- …
```

Le rattachement de la ligne « acceptées » à un fichier ou un commit n'est pas
décoratif : c'est ce qui permet de distinguer un arbitrage d'un acquiescement.

---

## J1 — 10/08/2026

**Présents.** Kery, Michel, Emie, Maxime

**Décisions.**

**Critiques de l'IA acceptées.**

- Aucune : l'IA n'intervient pas en J1.

**Critiques de l'IA refusées, et pourquoi.**

- Sans objet.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

- Rien.

## **Questions ouvertes pour le client.**

Réservation : infos client nécessaires (Q01), capacité des bateaux (Q02), canal de confirmation/annulation (Q03), délai d'annulation (Q04), tranches d'âge (Q14), min. 6 personnes par bateau (Q22), jours d'ouverture (Q23), réservation des deux bateaux ensemble (Q26).
Annulation côté entreprise : quand l'entreprise décide-t-elle d'annuler (Q05), ancien processus WhatsApp (Q06).
Paiement/remboursement : méthodes de paiement (Q07), comment se déroule un remboursement (Q15).
Généralités produit : météo consultée (Q08), appareils cibles (Q09), compte client (Q10), espace admin (Q11), nom de l'appli (Q12), privatisations le matin (Q13), budget — sans réponse (Q16), absence sans prévenir — sans réponse (Q17), réglementations (Q18), rôles/employés (Q19), heure limite veille — sans réponse (Q20), horaires identiques les deux bateaux — sans réponse (Q21), annulation entreprise — sans réponse (Q24), modification de réservation (Q25).


## J2 — 11/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

Symfony retenu comme stack (ADR-001)

**Critiques de l'IA acceptées.**

**Critiques de l'IA refusées, et pourquoi.**

- Sans objet.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

Cahier des charges V1 puis V2 (PDF + md).
ADR-001-stack rempli (choix de la stack).

## **Questions ouvertes pour le client.**

Prestataire externe d'hébergement (Q41), exigence RGPD (Q42), préférence navigateur (Q43), modification après paiement/supplément (Q44), charte graphique (Q45), réseaux sociaux à afficher (Q46), infos à afficher avant réservation (Q47).


## J3 — 12/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

**Critiques de l'IA acceptées.**

- Generation du diagramme de sequence et le MCD, source des besoins fonctionnels et une partie des besoins fonctionnels.

**Critiques de l'IA refusées, et pourquoi.**

- formattage en markdown qui a rajouté des elements aux cahiers des charges.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

- Generation du diagramme de sequence et le MCD, source des besoins fonctionnels et une partie des besoins fonctionnels.

## **Questions ouvertes pour le client.**


## J4 — 13/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

**Critiques de l'IA acceptées.**

- proposition de certaines regles metiers et des questions ambigues potentielles.

**Critiques de l'IA refusées, et pourquoi.**

- Filtrage des regles metiers fournis, car certaines fausses.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

- Generation du diagramme du MCD en mermaid, des regles metiers et des questions ambigues potentielles.

## **Questions ouvertes pour le client.**


## J5 — 14/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

**Critiques de l'IA acceptées.**

- propositions de certaines regles metiers acceptées.

**Critiques de l'IA refusées, et pourquoi.**

- Filtrage des regles metiers fournis, car certaines fausses.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

- Génération du diagramme du MCD en mermaid, des règles metiers et des questions ambigues potentielles.

## **Questions ouvertes pour le client.**

Avertissement 18h la veille (Q48), canal d'envoi (Q49), motifs d'annulation (Q50), contenu du message (Q51), alerte sur le site (Q52), réservations possibles après avertissement (Q53), moment de l'annulation définitive (Q54), annulation par créneau (Q55), notification automatique (Q56), remboursement à 100% si annulation entreprise (Q57), remboursement si client annule après avertissement (Q58), choix remboursement/report (Q59), gestion des hôtels — appel téléphonique conservé (Q60), blocage temporaire des places 15 min (Q61), badge nouvelle place (Q62), disponibilité des services externes (Q63).


## J6 — 17/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

Première vague de specs par domaine écrite dans docs/specs/BROUILLON/
SPEC-CONS-01, SPEC-DISP-01, SPEC-FACT-01, SPEC-SYST-01, SPEC-HOTEL-01, SPEC-LANG-01 sorties du dossier BROUILLON (validées).
SPEC-COMM-01 supprimée du périmètre.

**Critiques de l'IA acceptées.**

Revue IA appliquée avec corrections sur SPEC-HOTEL-01 et SPEC-LANG-01
Revue IA appliquée sur SPEC-AUTH-01, SPEC-CONS-01, SPEC-DISP-01, SPEC-FACT-01, SPEC-PAY-01, SPEC-SYST-01

**Critiques de l'IA refusées, et pourquoi.**

- 

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

Specs par domaine, modèle de compte-rendu, traceability + CR4, modèle de case, CASE-CANCEL-CLIENT-*, renommage spec cancel.

## **Questions ouvertes pour le client.**


## J8 — 18/08/2026

**Présents.**Michel, Emie, Maxime

**Décisions.**

Cahier des charges V4 intégré.
Rédaction massive de cas de test (ALERT, AUTH, BOOK, CANCEL-CLIENT, CANCEL-CLIENT-AVERTISSEMENT, CANCEL-PRESTATAIRE, CONS, DISP).
Premiers plans de délégation écrits (ALERT-01, AUTH-01, CONS-01, DISP-01, BOOK, CANCEL-CLIENT-*, ADR manquants).
Réorganisation de fichiers (renommage, replacement dans le bon dossier).

**Critiques de l'IA acceptées.**

Cas manquants ajoutés pour SPEC-ALERT-01, SPEC-AUTH-01, SPEC-CONS-01, SPEC-DISP-01, avec décisions d'équipe documentées dans leur Revue IA.
Alignement des références spec/AC sur CASE-CANCEL-CLIENT-01/02.
Renumérotation propre de CASE-CANCEL-CLIENT-AVERTISSEMENT-01 à 04.

**Critiques de l'IA refusées, et pourquoi.**

- Rien

**Erreurs produites par l'IA et détectées.**

Suppression d'un « fichier cancel 06 (erreur) » — le commit le dit explicitement.
Plusieurs commits de correction dans la foulée : fix: Correction des CASE, fix: Correction des specs avec références éronnées, fix: Correction d'un tas de problèmes (référence, noms, fichiers manquants)
Deux restaurations de fichiers perdus pendant des merges

**Ce qui a été généré aujourd'hui.**

Cahier des charges V4.
Cas de test pour ALERT-01, AUTH-01, BOOK-01 à 07, CANCEL-CLIENT-01 à 04, CANCEL-CLIENT-AVERTISSEMENT-01 à 04, CANCEL-PRESTATAIRE, CONS-01, DISP-01.
Premiers plans de délégation.
Entités/services de test « en dur ».

## **Questions ouvertes pour le client.**

Taux d'acompte 30%/50% (Q64-Q66), obligation de l'acompte (Q67-Q69), fenêtre de paiement du solde H-24/H-12 (Q70-Q74), enregistrement du solde sur place par le patron (Q75), non-paiement du solde → pas d'embarquement (Q76), états/statuts à conserver (Q77-Q78), barème d'annulation à moins de 48h (Q79-Q80), absence (Q81), annulation ≥48h — conditions existantes conservées (Q82), annulation entreprise (Q83-Q84), modification du nombre de participants (Q85-Q87), justificatifs/facture (Q88).


## J9 — 19/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

Compte-rendu d'entretien 05 ajouté.
Cahier des charges V5 intégré — changement majeur de la journée : acompte/solde demandé par le client.
Analyse d'impact impact-CR-001.md ajoutée.
ADR-006-persistance rédigé.
Delegations manquantes complétées.

**Critiques de l'IA acceptées.**

Corrections de CASE-BOOK-07/CASE-BOOK-08.
Rédaction de BOOK-08 + matrice + correction des BOOK réservation.
Corrections générales sur les SPECS.
Ajout de REQ-107/REQ-14 aux specs AUTH et LANG.
Ajout d'une notification d'une réservation client au patron.

**Critiques de l'IA refusées, et pourquoi.**

- Rien

**Erreurs produites par l'IA et détectées.**

Les 3 bugs de CASE-BOOK-07/08 : mauvaise référence d'AC (AC-04 cité au lieu d'AC-02), backtick manquant dans le nom de test attendu, et checklist encore rédigée pour CASE_BOOK_06 au lieu de 07.

**Ce qui a été généré aujourd'hui.**

Compte-rendu d'entretien 05, cahier des charges V5, impact-CR-001.md, ADR-006-persistance.md.
Delegations manquantes, corrections CASE-BOOK-07/08, notification patron.
Renommage/placement des entités et services de test placeholder

## **Questions ouvertes pour le client.**


## J10 — 20/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

Modèle d'état/statut acompte-solde finalisé dans le MCD/MLD V3.
Refonte de 11 specs + 2 nouvelles pour l'acompte/solde.
Question 16 tranchée : l'hôtel est exclu de l'acompte obligatoire.
MCD/MLD V3 complétés : rôle hotel, montant_courant, idempotence des paiements, facture hôtel multi-réservations.
Mécanisme d'amendement -A1 adopté : 12 specs amendées et 78 cas de test correspondants.
ADR-007 créé pour remplacer ADR-003.
Initialisation de PHPUnit, scripts et rapport de test.
Premier document de présentation de conception, architecture + Docker documentés.

**Critiques de l'IA acceptées.**

Ajustement des 78 cas après la première vague.
Correction des delegation-SPEC-BOOK-01/02/03.md.
Corrections MCD/MLD après une première passe.

**Critiques de l'IA refusées, et pourquoi.**

La proposition d'ajouter un champ profil séparé pour l'hôtel (en plus de role) et celle d'un remboursement Stripe déclenché automatiquement par l'application ont été explicitement écartées au profit de role = hotel seul et d'un remboursement strictement manuel initié par le patron.
Correction proposée pour tools/traceability.sh a été rejetée.

**Erreurs produites par l'IA et détectées.**

CASE-PAY-01-A1 citait SPEC-PAY-01-A1/AC-1, un critère qui ne correspond pas au scénario testé.
CASE-CONS-01-A1/CASE-CONS-03-A1 citaient SPEC-PAY-BALANCE-02/AC-8, causant un faux positif de couverture dans la matrice de traçabilité.
delegation-SPEC-BOOK-01/02/03.md : titres en placeholder, tableaux « Après » vides, décalage de lignes — copies de gabarit jamais terminées.
tools/traceability.sh : CDC pointait encore vers la V4, regex tronquant les -A1 — repéré, non corrigé.

**Ce qui a été généré aujourd'hui.**

MCD/MLD V3 complet (rôle hôtel, montant_courant, idempotence, facture hôtel), MPD en puml.
13 specs de la refonte acompte/solde + 12 amendements -A1.
78 cas de test (27 amendements + 20 nouveaux + stubs historiques).
ADR-007 (et ADR-008, à vérifier si committé).
12 plans de délégation -A1 + réparation des 3 plans BOOK-0x.
Initialisation PHPUnit, script et rapport de test, document architecture/Docker, première version de présentation de conception.

## **Questions ouvertes pour le client.**


## J11 — 21/08/2026

**Présents.**Kery, Michel, Emie, Maxime

**Décisions.**

**Critiques de l'IA acceptées.**

- propositions et reformulation de certaines délégations acceptées.

**Critiques de l'IA refusées, et pourquoi.**

- Certains délégations crés en entier refusé, car incorrect.

**Erreurs produites par l'IA et détectées.**

- Sans objet.

**Ce qui a été généré aujourd'hui.**

- Fichier de délégation

## **Questions ouvertes pour le client.**

