# Analyse d'impact — CR-001

**Demande du client :** remplacer le paiement intégral à la réservation par un acompte obligatoire, puis permettre le règlement différé du solde
**Source de la demande :** `docs/compte_rendu/compte-rendu-entretien-05.md`
**Reçue le :** 19/08/2026
**Rédigée par :** 200ping
**Document de référence analysé :** `docs/cahiers_des_charges/Cahier_des_charges_200ping_V4.md`

---

> **Interdiction de modifier le code avant que cette analyse soit complète.**
>
> La modification descend la chaîne dans cet ordre : cahier des charges → specs →
> UML → modèle de données → cas de test → tests → code.

---

## 1. Ce que le client demande, reformulé

Toute réservation d'un client particulier doit être confirmée par un acompte payé en ligne : 30 % du montant total pour une réservation standard et 50 % pour une privatisation. Le solde peut ensuite être payé en ligne grâce à un lien envoyé 24 heures avant le départ et utilisable jusqu'à 12 heures avant celui-ci, ou être réglé sur place. Le patron doit pouvoir enregistrer manuellement le paiement du solde sur place. Les annulations, absences et modifications doivent désormais tenir compte du montant initial, de l'acompte déjà encaissé et du solde restant, et le système doit produire un justificatif d'acompte puis une facture finale.

Le blocage temporaire et la libération des places en cas de paiement non finalisé restent inchangés. Les états de réservation à conserver sont « réservée », « payée » et « annulée » ; les statuts de paiement sont « acompte payé », « intégralement payé » et « remboursé ».

## 2. Questions posées au client

| # | Questions regroupées | Réponse retenue |
|---|---|---|
| 1 | Quel montant doit être payé à la réservation ? | 30 % du montant total pour une réservation standard ; 50 % pour une privatisation. |
| 2 | L'acompte est-il obligatoire et comment est-il payé ? | Oui, pour toute réservation concernée. Il est obligatoirement payé en ligne et confirme la réservation. |
| 3 | Le client peut-il payer immédiatement la totalité ? | Non en temps normal. Entre 24 h et 12 h avant le départ, il peut payer la totalité en ligne. |
| 4 | Quand et comment le solde est-il payé ? | Lien envoyé 24 h avant et expirant 12 h avant ; après expiration, paiement sur place. |
| 5 | Que se passe-t-il pour une réservation tardive ? | Entre 24 h et 12 h : totalité en ligne ou acompte en ligne puis solde sur place. À moins de 12 h : acompte en ligne puis solde sur place. |
| 6 | Qui enregistre un paiement sur place ? | Le patron, uniquement pour le solde. |
| 7 | Que se passe-t-il si le solde n'est pas payé ? | Le client ne participe pas, la réservation est annulée et le montant non payé reste dû lorsqu'une règle le prévoit. |
| 8 | Quels états et statuts faut-il conserver ? | Réservation : « réservée », « payée », « annulée ». Paiement : « acompte payé », « intégralement payé », « remboursé ». |
| 9 | Comment traiter une annulation client à moins de 48 h ? | Frais de 50 % du montant initial, acompte déjà payé déduit ; complément payable par lien valable 24 h ou sur place. |
| 10 | Que se passe-t-il en cas d'absence ? | Aucun remboursement. Q81, corrigée après l'entretien, est retenue comme décision la plus récente. |
| 11 | Que se passe-t-il si l'entreprise annule ? | Remboursement de 100 % des sommes déjà payées ou report accepté par le client. |
| 12 | Comment une modification du nombre de personnes agit-elle sur le paiement ? | L'acompte n'est pas recalculé ; le solde évolue. Si le montant payé dépasse le nouveau total, la différence est remboursée. |
| 13 | Quels documents faut-il produire ? | Un justificatif après l'acompte et une facture finale après paiement intégral. |

## 3. Impact — cahier des charges

### 3.1 Exigences fonctionnelles

| Exigence | Impact | Action |
|---|---|---|
| REQ-001 | modifiée | Préciser que la réservation d'un client particulier n'est confirmée et les places définitivement attribuées qu'après paiement de l'acompte. |
| REQ-006 | modifiée | Remplacer « payer en ligne la réservation » par le paiement en ligne obligatoire de l'acompte, puis le règlement du solde en ligne ou sur place. |
| REQ-009 | modifiée | Calculer les frais d'annulation tardive sur le montant initial, déduire l'acompte et gérer un éventuel complément ou remboursement. |
| REQ-010 | modifiée | Ne pas recalculer l'acompte lors d'un ajout ou retrait de participant ; modifier seulement le solde et rembourser l'éventuel trop-perçu. |
| REQ-017 | précisée | En cas d'annulation par l'entreprise, rembourser toutes les sommes déjà encaissées, y compris un acompte seul, ou enregistrer le report accepté. |
| REQ-018 | précisée | Le remboursement à 100 % pendant l'avertissement porte sur toutes les sommes effectivement payées. |
| REQ-019 | inchangée | Le client confirme que le blocage temporaire et la libération des places ne changent pas. |
| REQ-021 *(nouvelle)* | ajoutée | Calculer l'acompte : 30 % du montant total pour une réservation standard et 50 % pour une privatisation. |
| REQ-022 *(nouvelle)* | ajoutée | Envoyer le lien de paiement du solde 24 h avant le départ, le rendre inutilisable 12 h avant et informer le client du paiement sur place après expiration. |
| REQ-023 *(nouvelle)* | ajoutée | Permettre au patron d'enregistrer le règlement du solde sur place et empêcher la participation si le solde exigible n'est pas réglé. |
| REQ-024 *(nouvelle)* | ajoutée | Générer un justificatif après l'acompte et une facture finale après paiement intégral. |
| REQ-025 *(nouvelle)* | ajoutée | Afficher et conserver séparément l'état de la réservation et le statut global de son paiement. |

### 3.2 Périmètre et règles métier

| Élément du V4 | Impact | Action |
|---|---|---|
| §3.2 « Paiement en espèce, chèque, différé » | modifié | Le paiement sur place n'est plus totalement exclu : seul le solde peut être payé sur place. Les moyens acceptés restent ceux déjà utilisés par l'entreprise. |
| R-17 et R-79 | modifiées | Le paiement déclenché après le formulaire porte d'abord sur l'acompte obligatoire. |
| R-42 | modifiée | Le client particulier paie obligatoirement l'acompte en ligne ; le solde peut être payé en ligne ou sur place. |
| R-49 | inchangée sous réserve | Le CR05 ne demande pas explicitement d'automatiser l'exécution des remboursements ; le patron peut donc conserver le traitement existant. |
| R-51 | modifiée | Une réservation avec acompte payé, et non nécessairement intégralement payée, peut être modifiée par le patron. |
| R-52 et R-53 | modifiées | L'ajout de participants augmente le solde ; il ne déclenche plus nécessairement un lien de supplément immédiat séparé. |
| R-54 | modifiée | Le retrait diminue le solde ; remboursement seulement si les sommes déjà payées dépassent le nouveau total. |
| R-74 | précisée | L'annulation par l'entreprise rembourse 100 % des sommes encaissées ou donne lieu à un report accepté. |
| R-81 à R-94 *(nouvelles)* | ajoutées | Ajouter les règles CR05 sur les taux d'acompte, les fenêtres 24 h/12 h, le paiement sur place, les états/statuts, l'annulation tardive, l'absence sans remboursement, les modifications et les justificatifs. |
| Sources du cahier | modifiées | Ajouter `compte-rendu-entretien-05.md` dans les sources et produire une nouvelle version du cahier des charges. |

## 4. Impact — spécifications

| Spécification | Impact | Ce qui change exactement |
|---|---|---|
| SPEC-BOOK-01 | modifiée | La soumission mène au paiement de l'acompte. La réservation est confirmée après son succès et passe à l'état « réservée », pas directement « payée ». |
| SPEC-BOOK-02 | à clarifier | Q66 indique que le système d'acompte concerne toutes les réservations, mais les hôtels sont actuellement facturés en fin de mois sans paiement immédiat. |
| SPEC-BOOK-03 | inchangée | Les deux périodes de blocage de 15 minutes et la libération des places sont explicitement conservées. |
| SPEC-PAY-01 | refonte | Remplacer le paiement intégral unique par l'acompte, le solde, les deux taux, les fenêtres temporelles, les paiements en ligne/sur place, les échecs et les statuts globaux. |
| SPEC-PAY-BALANCE-02 *(nouvelle)* | ajoutée | Décrire l'envoi du lien 24 h avant, son expiration 12 h avant, les réservations tardives et l'enregistrement du solde sur place. |
| SPEC-CONS-01 | modifiée | Le patron doit voir l'acompte, le solde, le mode de règlement et pouvoir marquer le solde payé sur place. |
| SPEC-CANCEL-CLIENT-01 | modifiée | Les 50 % sont calculés sur le montant initial ; les sommes déjà payées sont déduites ; un complément peut rester dû. Ajouter le cas d'absence sans remboursement. |
| SPEC-CANCEL-PRESTATAIRE-02 | modifiée | Le remboursement intégral porte sur toutes les sommes encaissées et le report accepté devient une issue alternative explicite. |
| SPEC-CANCEL-CLIENT-AVERTISSEMENT-03 | modifiée | Si seul l'acompte a été encaissé, son remboursement intégral suffit à réaliser le remboursement à 100 %. |
| SPEC-MODIF-01 | refonte | Figer l'acompte déjà payé, recalculer le solde sur le nouveau total, rembourser le trop-perçu et conserver le montant initial pour les frais d'annulation. |
| SPEC-FACT-01 | inchangée sous réserve | La facturation mensuelle des hôtels reste inchangée uniquement si le client confirme qu'ils sont exclus de l'acompte obligatoire. |
| SPEC-SYST-01 | modifiée | Étendre la gestion des services externes à l'envoi planifié du mail, à la création/expiration du lien et aux webhooks des paiements partiels. |
| SPEC-JUSTIF-01 *(nouvelle)* | ajoutée | Définir le contenu, la numérotation et la génération du justificatif d'acompte et de la facture finale. |

## 5. Impact — conception

| Artefact | Impact | Ce qui change |
|---|---|---|
| `docs/adr/ADR-002-paiement.md` | modifié | Stripe reste utilisable, mais la décision doit couvrir plusieurs encaissements, les liens expirables, les webhooks, le paiement sur place et les remboursements partiels. |
| `docs/adr/ADR-003-cycle-de-vie-reservation.md` | à remplacer | La décision `payée \| annulée` est contredite par les trois états confirmés : `réservée \| payée \| annulée`. |
| `docs/adr/ADR-004-notifications.md` | modifié | Ajouter le mail automatique du solde, son contenu minimal et le comportement en cas d'échec d'envoi. |
| `docs/adr/ADR-005-blocage-places.md` | inchangé | Le mécanisme de blocage actuel est maintenu. Le paiement réussi à considérer devient celui de l'acompte. |
| `docs/adr/ADR-006-persistance.md` | modifié | Prévoir plusieurs opérations financières par réservation et leur idempotence. |
| `docs/uml/sequences/v2/reservationV2.puml` | modifié | Remplacer le paiement intégral par le calcul et l'encaissement de l'acompte, puis créer la réservation « réservée ». |
| `docs/uml/sequences/v2/annulation.puml` | modifié | Ajouter le montant initial, les sommes déjà payées, le complément éventuel, l'absence sans remboursement et l'alternative remboursement/report. |
| Séquence « paiement du solde » *(nouvelle)* | ajoutée | Représenter le déclenchement à H-24, l'expiration à H-12, le paiement en ligne et la saisie manuelle sur place. |
| Séquence « modification » *(nouvelle ou à compléter)* | ajoutée | Recalculer le total et le solde sans modifier l'acompte déjà encaissé. |
| MCD / MLD V2 | refonte partielle | Passer de 0..1 paiement à 0..n opérations par réservation ; séparer état de réservation et statut financier. |
| `docs/architecture.md` | modifié | Ajouter la planification temporelle H-24/H-12, le service de mail, la gestion des liens et la génération des documents. |

### État et données nouvelles

La demande introduit bien un **état nouveau** : `réservée`. Elle ne peut donc pas être absorbée par le code sans modifier l'ADR-003, le MCD, le MLD, les séquences et les tests.

Elle introduit aussi des **données nouvelles** :

- montant initial de la réservation, conservé même après modification ;
- montant courant après modification et solde restant ;
- type d'opération (`acompte`, `solde`, `complément`, `remboursement`) ;
- mode de paiement (`en_ligne`, `sur_place`) et date d'encaissement ;
- statut global du paiement (`acompte_payé`, `intégralement_payé`, `remboursé`) ;
- lien de paiement du solde, date d'envoi, date d'expiration et état d'utilisation ;
- trace du justificatif d'acompte et de la facture finale.

La cardinalité actuelle `Reservation 0..1 — 1 Paiement` est insuffisante. Une réservation doit pouvoir porter plusieurs opérations financières. Le statut global doit être calculé à partir de ces opérations ou stocké séparément sur la réservation avec une règle de synchronisation explicite.

## 6. Impact — tests

| Cas de test | Impact |
|---|---|
| CASE-BOOK-01, CASE-BOOK-03, CASE-BOOK-04, CASE-BOOK-08 | modifiés : la confirmation et la notification suivent le paiement de l'acompte |
| CASE-BOOK-06, CASE-BOOK-07, CASE-PAY-04 | inchangés sur les délais de blocage ; adapter le vocabulaire au paiement de l'acompte |
| CASE-PAY-01 | modifié : enregistre un acompte, pas le montant total |
| CASE-PAY-02 | modifié : après l'acompte, état « réservée » ; état « payée » seulement après solde |
| CASE-PAY-03 | modifié : les places deviennent définitivement réservées après l'acompte |
| CASE-PAY-05 | modifié : distinguer échec de l'acompte et échec du solde |
| CASE-CANCEL-CLIENT-01 à 03 | modifiés : frais sur montant initial, déduction des sommes payées et complément éventuel |
| CASE-CANCEL-PRESTATAIRE-01 à 03 | modifiés : remboursement des sommes encaissées ou report accepté |
| CASE-CANCEL-CLIENT-AVERTISSEMENT-01 à 04 | modifiés : remboursement de l'acompte lorsqu'il est la seule somme encaissée |
| CASE-MODIF-02 à 04 | modifiés : acompte figé, solde recalculé, trop-perçu remboursé |
| CASE-PAY-06 *(nouveau)* | acompte standard égal à 30 % du montant total |
| CASE-PAY-07 *(nouveau)* | acompte de privatisation égal à 50 % du montant total |
| CASE-PAY-08 *(nouveau)* | aucune réservation confirmée si l'acompte échoue ou n'est pas payé |
| CASE-PAY-09 *(nouveau)* | lien envoyé à H-24 et refusé à partir de H-12 |
| CASE-PAY-10 *(nouveau)* | réservation entre H-24 et H-12 : totalité en ligne ou acompte puis solde sur place |
| CASE-PAY-11 *(nouveau)* | réservation à moins de H-12 : acompte en ligne et solde sur place |
| CASE-PAY-12 *(nouveau)* | le patron enregistre le solde payé sur place |
| CASE-PAY-13 *(nouveau)* | solde non payé : participation refusée et réservation annulée |
| CASE-PAY-14 *(nouveau)* | transitions cohérentes entre « réservée », « payée » et « annulée » |
| CASE-CANCEL-CLIENT-04 *(nouveau)* | absence : aucune somme encaissée n'est remboursée |
| CASE-MODIF-05 *(nouveau)* | le montant payé dépasse le nouveau total : remboursement de la différence |
| CASE-JUSTIF-01 *(nouveau)* | justificatif généré après paiement de l'acompte |
| CASE-JUSTIF-02 *(nouveau)* | facture finale générée après paiement intégral |

Les tests PHP correspondants doivent être modifiés ou créés avec les mêmes identifiants. La matrice `docs/traceability.md` devra ensuite être régénérée avec `tools/traceability.sh`.

## 7. Impact — code

Le dépôt analysé ne contient pas encore de code applicatif (`src/`, contrôleurs, entités ou migrations). Les composants ci-dessous sont donc à créer ou à adapter lors de l'implémentation, après mise à jour des documents précédents.

| Composant | Impact |
|---|---|
| Domaine Réservation | Ajouter les trois états, le montant initial, le montant courant, le solde et les transitions autorisées. |
| Domaine Paiement | Gérer plusieurs opérations par réservation, les taux 30 %/50 %, les statuts et les modes en ligne/sur place. |
| Intégration Stripe | Créer des paiements partiels et liens expirables, traiter les webhooks de façon idempotente et permettre les remboursements partiels/totaux. |
| Planificateur | Déclencher l'envoi du lien à H-24 et son expiration à H-12 en tenant compte du fuseau horaire de la sortie. |
| Notifications | Envoyer le mail du solde et prévenir clairement du paiement sur place après expiration. |
| Interface client | Afficher acompte, solde, échéance du lien, statut financier et documents téléchargeables. |
| Interface patron | Afficher les sommes encaissées/restantes et enregistrer uniquement le solde payé sur place. |
| Annulation / absence | Calculer les frais sur le montant initial, déduire les paiements et interdire tout remboursement en cas d'absence. |
| Modification | Figer l'acompte, recalculer le solde et rembourser seulement le trop-perçu. |
| Documents | Générer le justificatif d'acompte et la facture finale, avec références uniques. |
| Persistance / migrations | Créer les nouvelles colonnes/tables et migrer les paiements existants sans perdre leur historique. |

## 8. Effets de bord identifiés

- Le V4 exclut le paiement sur place alors que le CR05 l'autorise pour le solde : le périmètre doit être corrigé avant toute implémentation.
- Q66 (« toutes les réservations ») entre en conflit avec la facturation mensuelle des hôtels. Hypothèse temporaire : le fonctionnement hôtel reste inchangé jusqu'à confirmation explicite.
- Q81 indique désormais « aucun remboursement » en cas d'absence, tandis que d'autres paragraphes du CR05 parlent encore de 50 % du montant initial. Pour cette analyse, Q81, corrigée en dernier, prévaut.
- Il faut distinguer l'état métier de la réservation du statut financier : une réservation peut être « annulée » avec un complément encore impayé.
- Une réservation modifiée nécessite de conserver le montant initial pour les frais et le montant courant pour le solde.
- Un paiement reçu au moment exact de l'expiration du lien exige une règle d'idempotence afin d'éviter un double encaissement en ligne et sur place.
- Les fenêtres H-24 et H-12 doivent utiliser un fuseau horaire défini ; le CR ne précise pas si elles se calculent à la minute exacte.
- Les règles d'arrondi des acomptes produisant des fractions de centime ne sont pas définies.
- Le contenu légal, la numérotation et le format du justificatif et de la facture ne sont pas définis.
- Le traitement d'un complément d'annulation jamais payé est tracé comme impayé, mais aucune relance ni procédure de recouvrement n'est demandée.
- Le paiement du solde sur place implique de définir les moyens acceptés, la preuve de saisie, l'auteur et la date de l'opération.
- L'échec du mail à H-24 ne doit pas supprimer la dette ni empêcher le patron de voir qu'un solde reste dû.

## 9. Ce que nous ne ferons pas dans le temps restant

- Modifier le mécanisme de blocage temporaire des places, explicitement conservé par le client.
- Automatiser le recouvrement d'un complément d'annulation restant impayé.
- Changer les moyens de paiement existants au-delà de l'autorisation du solde sur place.
- Modifier la facturation des hôtels sans réponse explicite sur leur inclusion dans l'acompte obligatoire.
- Ajouter des relances multiples après l'expiration du lien de paiement.
- Concevoir une nouvelle charte graphique pour les justificatifs et factures ; seul un format fonctionnel minimal sera prévu.

## 10. Ordre d'exécution retenu

| # | Étape | Qui |
|---|---|---|
| 1 | Valider l'exception éventuelle des hôtels et la règle d'absence | Client + 200ping |
| 2 | Produire le cahier des charges V5 et mettre à jour la traçabilité des REQ/règles | Analyste 200ping |
| 3 | Réviser les spécifications impactées et créer les deux nouvelles specs | Analyste 200ping |
| 4 | Remplacer l'ADR-003 et mettre à jour les ADR paiement, notifications et persistance | Équipe 200ping |
| 5 | Mettre à jour les séquences UML, le MCD, le DBML et le MLD | Conception 200ping |
| 6 | Modifier/créer les cas de test et régénérer la matrice de traçabilité | QA 200ping |
| 7 | Écrire ou adapter les tests automatisés pour obtenir les échecs attendus | QA + développement |
| 8 | Implémenter les migrations et le domaine réservation/paiement | Développement |
| 9 | Implémenter Stripe, le planificateur, les notifications et les interfaces | Développement |
| 10 | Implémenter les justificatifs/factures puis faire les tests de non-régression | Développement + QA |
