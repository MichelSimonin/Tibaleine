## SPEC-CANCEL-CLIENT-01 — Annulation de la réservation à l'initiative du client

**Exigence :** REQ-007, REQ-009
**Statut :** modifiée (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2
**Amendée par :** `SPEC-CANCEL-CLIENT-01-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-CANCEL-CLIENT-01-A1`.


### Règle

Une phrase, à l'indicatif, qui dit ce qui doit être vrai. Pas de « le système
pourrait », pas de « idéalement ».

> Les frais d'annulation à l'initiative du client se calculent sur le
> **montant initial** de la réservation (pas sur les sommes déjà payées) :
> 0 % à plus de 7 jours du départ, 25 % entre 7 jours et 48 h, 50 % à moins
> de 48 h (R-092). Les sommes déjà encaissées (acompte, et solde s'il a été
> réglé) sont déduites de ces frais. Si les frais dépassent les sommes déjà
> payées, le client doit un complément ; sinon, le trop-perçu lui est
> remboursé.

### Ce qui est confirmé vs. inféré

Le client n'a explicitement confirmé cette base de calcul (« montant initial,
sommes payées déduites, complément éventuel ») que pour la tranche à moins de
48 h (exemple chiffré : 100 € de réservation, 30 € d'acompte payé, annulation
<48h → 50 € de frais → 20 € restant dus). Son extension aux deux autres
tranches (25 % entre 7j et 48h, 0 % à plus de 7 jours) est une **inférence**
pour garder le barème cohérent — elle n'a pas été demandée mot pour mot au
client. Voir Revue IA.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas l'annulation à l'initiative du prestataire → `SPEC-CANCEL-PRESTATAIRE-02`
- Ne couvre pas l'annulation à l'initiative du client avec avertissement → `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
- Ne couvre pas la réduction du nombre de participants → `SPEC-<DOM>-0x`

### Scénarios nominaux

```gherkin
Étant donné une réservation d'un montant initial de 100 €
Et un acompte de 30 € déjà payé (aucun solde réglé)
Et une sortie prévue le 12 juillet à 10h00
Et que nous sommes le 11 juillet à 09h00 (moins de 48 h avant le départ)
Quand le client annule sa réservation
Alors les frais d'annulation sont de 50 € (50 % du montant initial de 100 €)
Et les 30 € déjà payés sont déduits de ces frais
Et le client doit un complément de 20 €
Et la réservation passe à l'état « annulée »
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu. C'est la partie qui
distingue une spécification d'une intention.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | annulation exactement 48h00 avant le départ | L'annulation entre dans le cadre « moins de 48 h » : 50 % du montant initial en frais, sommes déjà payées déduites, complément éventuel dû. |
| 2 | annulation après l'heure de départ | L'annulation est impossible après l'heure de départ. (État « effectué » non prévu au MCD V2 — à statuer.) |
| 3 | réservation déjà annulée | Une réservation dans l'état « annulée » ne donne pas accès au bouton pour annuler. |
| 4 | réservation d'un montant nul (offerte) | Le client peut annuler une réservation d'un montant nul. Le processus est géré par le patron, qui verra que la réservation était offerte. |
| 5 | absence du client le jour de la prestation (pas d'annulation formelle) | Aucun remboursement : les sommes déjà encaissées (acompte, solde) sont conservées intégralement (R-093). |
| 6 | frais d'annulation supérieurs aux sommes déjà payées | Un complément reste dû par le client, payable par lien ou sur place (mécanisme exact non précisé — voir « Ce qui n'est pas défini »). |
| 7 | frais d'annulation inférieurs aux sommes déjà payées | Le trop-perçu est remboursé au client. |

### Ce qui n'est pas défini

Assumé et daté. Une zone grise déclarée vaut mieux qu'une zone grise ignorée.

- Aucune validation orale que « annuler à 48 h pile » entre dans le cadre 7 j-48 h ou moins de 48 h.
- Aucune mention de prestation offerte lors des échanges avec le client (cas limite 4).
- Exécution du remboursement : manuelle par le patron (R-49) — la spec ne précise pas qui déclenche le remboursement effectif.
- Mécanisme exact d'encaissement du complément dû (cas limite 6) : lien de paiement automatique, saisie manuelle sur place, ou les deux — le client a répondu « payé par un lien ou sur place » sans trancher le déclenchement (cahier V5, question ouverte 3).
- L'extension de la base « montant initial, sommes déduites, complément éventuel » aux tranches 7j-48h et >7j n'est pas confirmée mot pour mot par le client (voir note sous la Règle).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client peut remplir les données du formulaire de demande d'annulation 
- [ ] AC-2 — Le client peut envoyer le formulaire et reçoit un retour
- [ ] AC-3 — Le client peut annuler sa réservation moins de 48 heures avant le départ ; les frais (50 % du montant initial) sont calculés, les sommes déjà payées déduites, un complément éventuel identifié.
- [ ] AC-4 — Le client peut annuler sa réservation 7 jours à 48 heures avant le départ ; les frais (25 % du montant initial) sont calculés selon le même principe.
- [ ] AC-5 — Le client peut annuler sa réservation plus de 7 jours avant le départ ; les sommes déjà payées sont intégralement remboursées.
- [ ] AC-6 — Le patron est informé de l'annulation du client
- [ ] AC-7 — Après l'annulation, le client peut formuler une nouvelle demande de réservation (pas de report automatique).
- [ ] AC-8 — En cas d'absence le jour de la prestation sans annulation formelle, aucun remboursement n'est effectué.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Coquille « 50£ » au lieu de « 50 % » (cas limite 1) | corrigée | |
| État « Effectué » (cas limite 2) absent du MCD V2 | à trancher | Ajouter l'état ou redéfinir le comportement |
| AC-5 évoquait un « report » alors que l'annulation à l'initiative du client n'en prévoit pas | corrigée | Reformulée |
| L'exécution du remboursement (manuelle, R-49) n'est pas précisée | à trancher | Vaut aussi pour l'encaissement d'un complément dû |
| Barème cohérent avec CR-01 §1 (100 % / 75 % / 50 %) | OK | Base de calcul changée depuis (montant initial, cf. ci-dessous) |
| Cahier des charges V5 (CR-05, `impact-CR-001.md`) : les frais se calculent sur le montant initial, pas sur les sommes payées ; un complément peut rester dû si l'acompte seul ne couvre pas les frais | tranchée | Confirmé par le client avec un exemple chiffré (100 €/30 €/50 €/20 €) pour la tranche <48h uniquement |
| L'extension de cette base de calcul aux tranches 7j-48h et >7j n'a pas été explicitement demandée au client | à trancher | Inférée pour la cohérence interne du barème — à confirmer avant implémentation |
| Cas d'absence sans remboursement (R-093) absent de la spec d'origine | corrigée | Ajouté en cas limite 5 et AC-8 |
| Mécanisme d'encaissement du complément dû non précisé (« lien ou sur place ») | à trancher | Cahier V5, question ouverte 3 |

Les refus se reportent aussi dans `docs/journal.md`.
