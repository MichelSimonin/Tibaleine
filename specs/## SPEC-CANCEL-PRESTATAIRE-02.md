## SPEC-CANCEL-PRESTATAIRE-02 — Annulation de la réservation à l'initiative du prestataire

**Exigence :** REQ-017
**Statut :** modifiée (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2

### Règle

> En cas de mauvaises conditions météo, le prestataire envoie un avertissement
> la veille à 18 h, puis confirme l'annulation au moins 2 h avant le départ, par
> créneau. Les clients concernés sont prévenus automatiquement par SMS et/ou
> mail, au même moment. Chaque client choisit alors entre un **remboursement
> intégral des sommes déjà payées** (acompte seul, ou acompte + solde) et un
> **report accepté** sur un autre créneau (R-047, R-074, R-094). Contrairement
> à `SPEC-CANCEL-CLIENT-01`, le remboursement se calcule sur les sommes
> **effectivement payées**, pas sur le montant initial de la réservation —
> confirmé explicitement par le client.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas l'annulation à l'initiative du client → `SPEC-CANCEL-CLIENT-01`
- Ne couvre pas l'annulation à l'initiative du client avec avertissement → `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
- Ne couvre pas la réduction du nombre de participants → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une sortie prévue le 12 juillet à 10h00 comprenant 5 réservations
Et une réservation à 100 € dont seul l'acompte de 30 € a été payé
Et que nous sommes le 11 juillet à 18h00
Par cause de mauvais temps probable le lendemain matin, le prestataire
envoie un avertissement concernant une possible annulation des sorties
le lendemain matin
Le prestataire confirme l'annulation le lendemain (au moins 2 h avant le départ)
Alors tous les clients concernés sont prévenus automatiquement au même moment
Et le client de cette réservation choisit entre un remboursement intégral des
30 € déjà payés et un report accepté sur un autre créneau
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un client réserve des places après l'avertissement de 18h | Le nouveau client ne recevra pas un message par sms ou email mais un message d'alerte est affiché sur le site pour avertir les nouveaux clients que les horaires concernés peuvent être annulé |
| 2 | l'hôtel partenaire avait plusieurs places sur les créneaux annulés | L'hôtel n'est pas concerné par l'envoie de message et sera appelé directement par le prestataire. Les réservations annulés ne seront pas comptabilisé. |
| 3 | un client avait annulé sa réservation avant l'avertissement | Le client avait annulé sa réservation avant avertissement et intervention du prestataire. L'annulation sera géré comme une annulation classique à l'initiative du client. |
| 4 | le client n'a payé que l'acompte au moment de l'annulation par le prestataire | Le remboursement intégral porte sur l'acompte seul — aucun solde n'était dû puisque la sortie n'a pas eu lieu. |
| 5 | le client avait déjà payé le solde (réservation tardive, `SPEC-PAY-BALANCE-02`) au moment de l'annulation par le prestataire | Le remboursement intégral porte sur l'acompte et le solde. |
| 6 | le client choisit le report plutôt que le remboursement | La réservation est transférée sur un autre créneau ; les sommes déjà payées restent acquises à la nouvelle réservation, sans nouveau calcul d'acompte. |

### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Heure exacte de la décision d'annulation : « vers 5 h » (CR-04/Q54) vs « 2 h avant » — à confirmer.
- Exécution du remboursement : manuelle par le patron (R-49) ; seuls le calcul et la notification sont automatiques.
- Personnalisation du message et gestion d'une panne du service SMS → `SPEC-ALERT-01`.
- Cas limite 1 : un client ayant réservé après l'avertissement reçoit-il le message d'annulation ? (à préciser)
- Délai laissé au client pour choisir entre remboursement et report (cas limite 6) : non précisé.
- Mécanisme du report : comment le client indique-t-il son choix, et quel créneau lui est proposé ? Non détaillé par le cahier V5.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le prestataire peut envoyer son message d'avertissement à 18h la veille
- [ ] AC-2 — Le prestataire peut envoyer son message d'annulation au moins 2 h avant le départ (heure exacte à confirmer, CR-04/Q54)
- [ ] AC-3 — Les clients recoivent les messages d'avertissement et d'annulation
- [ ] AC-4 — Le prestataire peut annuler les réservations impactés.
- [ ] AC-5 — Le client choisit entre un remboursement intégral des sommes déjà payées et un report accepté sur un autre créneau.
- [ ] AC-6 — Le remboursement intégral porte sur toutes les sommes effectivement encaissées (acompte seul, ou acompte + solde), pas sur le montant initial de la réservation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| La « Règle » reprenait le barème client de SPEC-CANCEL-CLIENT-01 | corrigée | Remplacée par la règle prestataire (avertissement 18 h + annulation ≥ 2 h, remboursement 100 %) |
| Scénario Gherkin mal formé (« Étant donné une prévue… ») | corrigée | |
| Heure d'annulation : 5 h (scénario) vs 2 h avant (AC-2) — incohérence (CR-04/Q54 « à confirmer ») | à trancher | |
| « Intégralement remboursés » : l'exécution du remboursement reste manuelle (R-49) | à trancher | Préciser calcul automatique / exécution manuelle |
| Cas 1 : un client réservant après 18 h reçoit-il le message d'annulation ? | à trancher | |
| « Ce qui n'est pas défini » était vide | complétée | |
| Cahier des charges V5 : le remboursement intégral ne portait pas explicitement sur les sommes payées (acompte/solde) depuis l'introduction du paiement fractionné | tranchée | Confirmé par le client (« si annulation par le prestataire, on rembourse à 100 % de ce qu'il a payé ») — base de calcul différente de `SPEC-CANCEL-CLIENT-01` (montant initial) |
| Le report (alternative au remboursement) n'était pas explicite dans la spec d'origine alors qu'il figure dans R-047/R-074/R-094 | corrigée | Ajouté en Règle, cas limite 6 et AC-5 |
| Mécanisme du choix remboursement/report et du report lui-même non détaillé | à trancher | Cf. « Ce qui n'est pas défini » |

Les refus se reportent aussi dans `docs/journal.md`.
