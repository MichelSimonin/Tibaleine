## SPEC-BOOK-01 — Réservation d'un créneau d'un client lambda

**Exigence :** REQ-001
**Statut :** modifiée (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2

### Règle

> Un client peut réserver un créneau en fournissant son email, son nom, son
> prénom, la date et le type de sortie voulus et le nombre de personnes (adultes
> et enfants). La réservation n'est confirmée qu'après paiement de l'acompte
> (`SPEC-PAY-01`) ; elle passe alors à l'état « réservée », avec le statut de
> paiement « acompte payé ». Le règlement du solde (`SPEC-PAY-BALANCE-02`) ne
> change que le statut, pas l'état — celui-ci ne devient « réalisée » qu'après
> la prestation. Le client reçoit un email de confirmation et le patron est
> notifié.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la consultation des créneaux disponibles → `SPEC-DISP-01`
- Ne couvre pas une réservation via un compte professionnel (hôtel) → `SPEC-BOOK-02`
- Ne couvre pas le paiement de l'acompte → `SPEC-PAY-01`
- Ne couvre pas le paiement du solde → `SPEC-PAY-BALANCE-02`
- Ne couvre pas le blocage temporaire des places → règle CR-04/Q61 (voir cas limite 3), détaillé dans `SPEC-BOOK-03`

### Scénarios nominaux

```gherkin
Étant donné un créneau libre pour une sortie baleine le 12 juillet à 10h00 pour lequel il reste 4 places.
Quand le client réserve ce créneau
Il fournit son email, nom, prénom et le nombre de personnes (3 adultes et 1 enfant)
Il confirme et paie l'acompte ; la réservation passe en état « réservée » (si le paiement de l'acompte réussit).
Alors en confirmant, le client recevra un email de confirmation résumant les informations de sa réservation et comprenant un lien d'inscription (inscription optionnelle).
Le patron reçoit un sms qu'il y a eu une nouvelle réservation.

```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| #   | Situation                                                                                  | Comportement attendu                                                                                                                                                                       |
| --- | ------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| 1   | le client veut inclure une nouvelle personne alors que le créneau n'a plus assez de places | La demande est bloquée : le client doit réduire le nombre de personnes ou choisir un autre créneau.                                                                                        |
| 2   | le client tente de réserver moins de 2 h avant le départ                                   | La réservation est bloquée (réservation impossible à moins de 2 h du départ).                                                                                                              |
| 3   | plusieurs clients tentent de réserver le même créneau                                      | La place est bloquée temporairement dès l'arrivée sur le formulaire ; délai de 15 min au paiement, au-delà la place se libère (CR-04/Q61). La première réservation payée prend les places. |
| 4   | un client réserve après l'avertissement météo de 18 h                                      | Il ne reçoit pas de SMS/mail d'avertissement, mais une alerte s'affiche sur le site (SPEC-ALERT-01).                                                                                       |

### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Fonctionnement de la liste d'attente des réservations.
- Règle d'arrondi si l'acompte comporte une fraction de centime (cahier V5, question ouverte 17) → `SPEC-PAY-01`.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client peut remplir les données du formulaire de demande de réservation.
- [ ] AC-2 — Le client peut envoyer le formulaire et reçoit un retour par mail.
- [ ] AC-3 — Le patron reçoit la notification de réservation.
- [ ] AC-4 — Le nombre de places disponibles pour une activité se met à jour après le paiement de l'acompte, qui bloque définitivement les places (renvoi `SPEC-PAY-01` AC-3).

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| AC-4 et AC-5 supposent que le patron valide/refuse la demande, mais le scénario marque cette validation « A CONFIRMER » | tranchée | Décision d'équipe : pas de validation du patron. Le client paie directement après avoir soumis sa réservation. AC-4 et AC-5 supprimés en conséquence. |
| Le blocage temporaire des places (CR-04/Q61, 15 min) n'était pas représenté alors que le cas 1 évoquait une demande « bloquée » | corrigée | Cas limite 3 complété |
| Cas limite 2 incohérent : « réserver à 1 h du départ » vs « bloqué 2 h avant » | corrigée | Délai unifié : 2 h |
| Nommage des états : « Validé » (scénario) vs « confirmée » (MCD V2) | tranchée | Révisé suite au cahier V5 (R-90/R-91/R-101) : les états sont désormais **« réservée » \| « réalisée » \| « annulée »** — pas de « payée ». Le statut de paiement (« en attente de paiement » \| « acompte payé » \| « intégralement payé » \| « remboursé ») évolue séparément de l'état ; la réservation reste « réservée » quel que soit le statut de paiement, jusqu'à ce que la prestation ait effectivement lieu (« réalisée »). `docs/mcd/mcd-V2.dbml` doit être mis à jour en conséquence (actuellement `en_attente \| confirmée \| refusée \| payée \| annulée`). |
| Langue de l'email de confirmation non précisée (FR/EN, R-71) | à trancher | Renvoi `SPEC-LANG-01` |
| AC-3 ne précise pas si la notification au patron intervient dès la soumission de la demande ou seulement après paiement réussi — la Portée exclut le paiement (« → SPEC-PAY-01 »), ce qui laissait planer une ambiguïté | tranchée | Décision d'équipe : la notification (SMS + espace administrateur) intervient après le paiement de l'**acompte** (état « réservée »), pas après le solde. Cohérent avec `CASE-BOOK-08`, à relire pour préciser qu'il s'agit de l'acompte et non du paiement intégral. |
| Le cahier des charges V5 (`impact-CR-001.md`) remplace le paiement intégral unique par acompte + solde différé | tranchée | Refonte : la réservation passe à « réservée » après l'acompte. Voir `SPEC-PAY-01`, `SPEC-PAY-BALANCE-02`. |
| `docs/impacts/impact-CR-001.md` (§1) et une première version de cette spec citaient encore un état « payée » — le cahier V5 a été corrigé après coup (commit `34b2152`, modèle réservée/réalisée/annulée + 4 statuts) sans que l'analyse d'impact ne soit mise à jour en miroir | corrigée | Repéré par relecture croisée (retour ChatGPT sur une révision antérieure de cette spec) ; `impact-CR-001.md` reste daté sur ce point et ne doit plus être pris comme source pour le modèle d'état |

Les refus se reportent aussi dans `docs/journal.md`.
