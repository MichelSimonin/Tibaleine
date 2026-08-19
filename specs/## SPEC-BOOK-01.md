## SPEC-BOOK-01 — Réservation d'un créneau d'un client lambda

**Exigence :** REQ-001
**Statut :** revue IA faite
**Version :** v1

### Règle

> Un client peut réserver un créneau en fournissant son email, son nom, son
> prénom, la date et le type de sortie voulus et le nombre de personnes (adultes
> et enfants). La réservation est enregistrée, le client reçoit un
> email de confirmation et le patron est notifié.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la consultation des créneaux disponibles → `SPEC-DISP-01`
- Ne couvre pas une réservation via un compte professionnel (hôtel) → `SPEC-BOOK-02`
- Ne couvre pas le paiement en ligne → `SPEC-PAY-01`
- Ne couvre pas le blocage temporaire des places → règle CR-04/Q61 (voir cas limite 3)

### Scénarios nominaux

```gherkin
Étant donné un créneau libre pour une sortie baleine le 12 juillet à 10h00 pour lequel il reste 4 places.
Quand le client réserve ce créneau
Il fournit son email, nom, prénom et le nombre de personnes (3 adultes et 1 enfant)
Il confirme et peut désormais payer sa réservation et celle-ci passe en état "Payée" (si le paiement réussis).
Alors en confirmant, le client recevra un email de confirmation résumant les informations de sa réservation et comprenant un lien d'inscription (inscription optionelle).
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

- Fonctionnement des paiements si le client ne veut pas payer en ligne.
- Fonctionnement de la liste d'attente des réservations.
- Validation (acceptation / refus) de la demande par le patron : à confirmer (question ouverte cahier V4 §8).
- Réservation validée mais non payée au moment du départ : question ouverte (cahier V4 §8).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client peut remplir les données du formulaire de demande de réservation.
- [ ] AC-2 — Le client peut envoyer le formulaire et reçoit un retour par mail.
- [ ] AC-3 — Le patron reçoit la notification de réservation.
- [ ] AC-4 — Le nombre de place disponible pour une activité se met à jour après le paiement d'une réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA                                                                                                                | Décision   | Motif                                                                                                                                                              |
| ------------------------------------------------------------------------------------------------------------------------------- | ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| AC-4 et AC-5 supposent que le patron valide/refuse la demande, mais le scénario marque cette validation « A CONFIRMER »         | tranchée   | Décision d'équipe : pas de validation du patron avant paiement, le client paie directement après avoir soumis sa réservation. AC-4 et AC-5 retirés en conséquence. |
| Le blocage temporaire des places (CR-04/Q61, 15 min) n'était pas représenté alors que le cas 1 évoquait une demande « bloquée » | corrigée   | Cas limite 3 complété                                                                                                                                              |
| Cas limite 2 incohérent : « réserver à 1 h du départ » vs « bloqué 2 h avant »                                                  | corrigée   | Délai unifié : 2 h                                                                                                                                                 |
| Nommage des états : « Validé » (scénario) vs « confirmée » (MCD V2)                                                             | à trancher | Aligner sur le MCD (confirmée)                                                                                                                                     |
| Langue de l'email de confirmation non précisée (FR/EN, R-71)                                                                    | à trancher | Renvoi `SPEC-LANG-01`                                                                                                                                              |

Les refus se reportent aussi dans `docs/journal.md`.
