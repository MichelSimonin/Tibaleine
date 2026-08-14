# Revue et corrections des diagrammes — Projet Ti Baleine

## Statut de la modélisation

Les diagrammes existants constituent une **V1 provisoire exploitable**. Ils ne peuvent pas encore être considérés comme validés, car certaines règles métier sont contradictoires ou attendent une réponse du client.

Les fichiers sources des diagrammes ne sont pas modifiés par ce document. Les corrections ci-dessous devront être appliquées après validation des questions prioritaires.

## 1. Diagramme de cas d’utilisation

Fichier examiné : `docs/cas_utilisation/Tibaleine cas d'utilisation.drawio`.

### Corrections nécessaires

1. Ajouter une frontière représentant le système **Ti Baleine App**.
2. Remplacer « Nouvelle réservation » par **Réserver une sortie**.
3. Utiliser des flèches UML pointillées portant les stéréotypes `<<include>>` et `<<extend>>`.
4. Traiter l’authentification comme une précondition lorsque cela est plus lisible, au lieu de répéter systématiquement le cas « Authentification ».
5. Ne pas représenter la modification en ligne comme définitive tant que son canal n’est pas confirmé par le client.
6. Retirer le paiement en ligne associé à l’hôtel : les CR indiquent une facturation en fin de mois.
7. Séparer le cas « Consulter une réservation » des actions **Confirmer**, **Refuser** et **Annuler**.
8. Ajouter pour le patron le cas **Traiter une demande de réservation**, spécialisé en confirmation ou refus.
9. Ajouter le cas **Affecter les passagers à un bateau** uniquement après clarification de son moment et de son responsable.
10. Préciser si le client peut demander une annulation depuis le site ou seulement par téléphone.

### Éléments pouvant être conservés

- Les acteurs `Client`, `Hôtel`, `Employé` et `Patron`.
- La consultation des créneaux.
- La création d’une réservation par le patron.
- La consultation des réservations par l’employé.
- La création d’un compte hôtel, sous réserve de confirmer le fonctionnement des comptes.

## 2. MCD

Fichiers examinés : `docs/mcd/mcd-V1.md` et `docs/mcd/mcd-V1.dbml`.

### Corrections prioritaires

#### Relation entre une sortie et les bateaux

Le modèle impose actuellement qu’une sortie soit organisée sur un seul bateau. Or les CR indiquent qu’une réservation peut exceptionnellement concerner les deux bateaux.

Correction envisagée : remplacer la clé étrangère directe portée par `Sortie` par une association entre `Sortie` et `Bateau`, après clarification de la répartition des passagers.

#### Relation entre réservation et utilisateur

Le modèle impose un compte utilisateur à chaque réservation. L’existence et le caractère obligatoire du compte client restent contradictoires entre les CR et le cahier des charges.

Correction envisagée : attendre la décision client, puis choisir entre :

- un compte obligatoire ;
- un compte facultatif avec coordonnées portées par la réservation ;
- une réservation sans compte.

#### Paiements et remboursements

Le modèle autorise au maximum un paiement par réservation. Cela ne permet pas de représenter :

- le paiement initial ;
- un supplément après ajout de participant ;
- un remboursement ;
- plusieurs tentatives de paiement ;
- l’historique des opérations ;
- la facturation mensuelle des hôtels.

Correction envisagée : modéliser plusieurs **transactions de paiement** par réservation, avec au minimum un type, un montant, un statut, une date et une référence externe. Cette correction dépend de la réponse concernant l’historique des paiements.

#### Modification d’une réservation

Le MCD indique qu’une modification est possible uniquement lorsque la réservation est `en_attente`. CR-03/Q44 autorise pourtant une modification après paiement.

Correction envisagée : ne pas inscrire cette restriction dans le modèle tant que les statuts et délais autorisés ne sont pas confirmés.

#### Enfants de moins de quatre ans

Le MCD indique que leur accès est interdit, alors que les extractions des CR les présentent comme gratuits ou non comptés. Cette règle doit être retirée du modèle jusqu’à confirmation.

### Éléments pouvant être conservés

- Les bateaux `Ti Kap` et `Grand Bleu` avec leurs capacités.
- Les concepts `Réservation`, `Sortie`, `Bateau`, `Tarif` et `Paiement`.
- Les nombres d’adultes et d’enfants dans une réservation.
- Les tarifs des sorties baleine, dauphin et privatisation.
- Le profil hôtel et ses contraintes métier, sous réserve du mode exact de facturation.

## 3. Diagramme de séquence — Réservation

Fichier examiné : `docs/uml/sequences/reservation.puml`.

### Corrections nécessaires

1. Ne pas vérifier « minimum 6 personnes » comme condition d’acceptation d’une réservation individuelle. Une réservation exige au minimum 2 personnes ; les 6 passagers concernent le maintien ou le départ du bateau.
2. Ajouter une branche `alt` pour le refus de la demande par le patron.
3. Préciser le motif et la notification du refus après réponse du client.
4. Ajouter une branche correspondant à l’échec ou à l’abandon du paiement.
5. Ne conserver la validation manuelle de chaque demande que si le client confirme ce fonctionnement.
6. Ajouter l’affectation au bateau seulement après clarification du processus de répartition.
7. Clarifier la création du compte : avant, pendant ou après la réservation, et caractère obligatoire ou facultatif.

## 4. Diagramme de séquence — Annulation

Fichier examiné : `docs/uml/sequences/annulation.puml`.

### Corrections nécessaires

1. Retirer le remboursement automatique déclenché par le système auprès du prestataire de paiement.
2. Représenter le remboursement comme une action effectuée manuellement par le patron sur son TPE, sauf nouvelle décision du client.
3. Ne pas figer le barème applicable à moins de 48 heures avant clarification de la contradiction entre CR-01/Q04 et CR-01/§1.
4. Préciser si une demande en ligne annule immédiatement la réservation ou nécessite une validation du patron.
5. Préciser si un report est systématiquement proposé avant le remboursement.
6. Préciser si le motif d’annulation est obligatoire.
7. Distinguer l’annulation demandée par le client de l’annulation décidée par l’entreprise.

## 5. Diagramme de séquence — Réservation hôtel

Fichier examiné : `docs/uml/sequences/reservation-hotel.puml`.

### Corrections nécessaires

1. Clarifier si un hôtel peut réserver lui-même depuis son compte ou uniquement passer par le patron.
2. Conserver la limite de 6 places par créneau.
3. Conserver l’interdiction de privatisation.
4. Conserver la remise de 15 % et la facturation en fin de mois.
5. Ajouter éventuellement la génération d’une facture mensuelle après clarification du format attendu.
6. Ne pas ajouter de paiement en ligne individuel pour chaque réservation d’hôtel.

## 6. Diagramme de séquence — Consultation des réservations

Fichier examiné : `docs/uml/sequences/consultation-reservations.puml`.

Ce diagramme est le plus stable. Il peut être conservé si le rôle de l’employé reste limité à la consultation.

Points à confirmer :

- les informations visibles par l’employé ;
- la possibilité éventuelle d’ajouter des filtres ;
- l’interdiction effective de toute modification par l’employé.

## Ordre recommandé des corrections

1. Obtenir les réponses aux questions prioritaires.
2. Corriger le cycle de vie et les statuts de la réservation.
3. Corriger le MCD, notamment les relations avec `Utilisateur`, `Bateau` et `Paiement`.
4. Corriger le diagramme de cas d’utilisation.
5. Corriger les séquences de réservation et d’annulation.
6. Mettre à jour les séquences hôtel et consultation.
7. Générer de nouvelles images et effectuer une dernière vérification croisée avec les CR et le CDC V3.

## Conclusion

Les diagrammes actuels doivent porter la mention **« V1 provisoire — en attente de validation client »**. Ils peuvent servir de support au prochain entretien, mais ne doivent pas encore être présentés comme la modélisation définitive du projet.
