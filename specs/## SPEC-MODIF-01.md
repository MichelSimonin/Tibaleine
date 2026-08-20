## SPEC-MODIF-01 — Modification d'une réservation

**Exigence :** REQ-010
**Statut :** refonte (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2
**Amendée par :** `SPEC-MODIF-01-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-MODIF-01-A1`.


### Règle

> Une réservation à l'état « réservée » (acompte payé, quel que soit le
> statut de paiement) peut être modifiée par le patron (report, ajout ou
> suppression de participants), sur demande par téléphone. **L'acompte déjà
> payé n'est jamais recalculé** (R-097) : seuls le montant courant et le
> solde restant évoluent. L'ajout de participants augmente le montant
> courant ; la différence est **ajoutée au solde** (pas de complément
> d'acompte séparé — décision client confirmée), payable selon les règles
> habituelles du solde (`SPEC-PAY-BALANCE-02`). La suppression de
> participants diminue le montant courant ; si les sommes déjà payées
> dépassent le nouveau total, la différence est remboursée. **Le montant
> initial de la réservation reste la référence pour le calcul des frais
> d'annulation**, même après modification (R-098).

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le paiement de l'acompte → `SPEC-PAY-01`
- Ne couvre pas le paiement du solde (y compris la différence après ajout) → `SPEC-PAY-BALANCE-02`
- Ne couvre pas le calcul des frais d'annulation sur le montant initial → `SPEC-CANCEL-CLIENT-01`
- Ne couvre pas le report après annulation météo → `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`

### Scénarios nominaux

```gherkin
Étant donné une réservation « réservée » de 100 € (montant initial), acompte de 30 € payé
Quand le patron ajoute 1 participant, portant le montant courant à 150 €
Alors l'acompte de 30 € n'est pas recalculé
Et le solde restant passe de 70 € à 120 €
Et le montant initial (100 €) reste inchangé pour un futur calcul de frais d'annulation

Étant donné une réservation « réservée » de 150 € (montant courant), dont 150 € ont déjà été payés (acompte + solde)
Quand le patron supprime 1 participant, ramenant le montant courant à 100 €
Alors le solde restant devient négatif (50 € de trop-perçu)
Et les 50 € de trop-perçu sont remboursés au client
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | ajout de participant moins de 2 h avant le départ | La modification n'est pas possible (délai dépassé, cf. `SPEC-BOOK-01` cas limite 2). |
| 2 | suppression de participant, sommes déjà payées inférieures au nouveau total | Le solde restant est simplement recalculé à la baisse ; pas de remboursement. |
| 3 | suppression de participant, sommes déjà payées supérieures au nouveau total | Le trop-perçu est remboursé au client. |
| 4 | modification d'une réservation à l'état « réservée » | Possible uniquement par le patron, sous réserve du délai. |
| 5 | la modification dépasse la capacité du bateau | La modification est refusée. |
| 6 | ajout de participant après modification préalable (montant initial déjà différent du montant courant) | Les frais d'annulation restent calculés sur le montant **initial** d'origine, jamais sur le montant courant modifié (R-098). |

### Ce qui n'est pas défini

- Modification en ligne par le client (question ouverte : le client doit-il obligatoirement passer par téléphone ?).
- Mécanisme exact de paiement de la différence après ajout : rattachée au lien de solde existant, ou déclenche-t-elle l'envoi d'un nouveau lien immédiat ? Le cahier V5 ne le précise pas explicitement (R-052/R-053 restent généraux).
- Délai de remboursement du trop-perçu après suppression (cas limite 3).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Une demande de modification s'effectue par téléphone.
- [ ] AC-2 — Le patron peut modifier une réservation à l'état « réservée ».
- [ ] AC-3 — L'acompte déjà payé n'est jamais recalculé lors d'une modification.
- [ ] AC-4 — Un ajout de participant augmente le solde restant du montant de la différence (pas de complément d'acompte séparé).
- [ ] AC-5 — Une suppression de participant diminue le solde restant ; si les sommes payées dépassent le nouveau total, le trop-perçu est remboursé.
- [ ] AC-6 — Le montant initial de la réservation reste la référence pour le calcul des frais d'annulation, même après modification.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Spec entièrement réécrite suite au cahier des charges V5 (R-097, R-098) et à `docs/impacts/impact-CR-001.md` (§4, « refonte ») | tranchée | L'ancien modèle (réservation « payée », supplément payé par lien mail immédiat) ne correspond plus au fonctionnement acompte/solde |
| L'ajout de participant pourrait suivre deux mécanismes (complément d'acompte ou ajout au solde) | tranchée | Décision client confirmée en session : toujours ajouté au solde, jamais de choix ni de complément d'acompte séparé |
| Mécanisme précis de paiement de la différence après ajout (nouveau lien immédiat ou rattaché au solde existant) | à trancher | R-052/R-053 restent généraux sur ce point |
| État « payée » remplacé par « réservée » dans toute la spec (cf. correction transverse sur `SPEC-BOOK-01`) | tranchée | Cohérence avec le modèle R-90/R-91/R-101 |

Les refus se reportent aussi dans `docs/journal.md`.
