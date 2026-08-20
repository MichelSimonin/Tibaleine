## SPEC-PAY-01 — Paiement de l'acompte en ligne

**Exigence :** REQ-006, REQ-021
**Statut :** refonte (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2
**Amendée par :** `SPEC-PAY-01-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-PAY-01-A1`.


### Règle

> Après avoir soumis sa demande de réservation, un client particulier paie
> **obligatoirement un acompte en ligne** : 30 % du montant total TTC pour
> une réservation standard, 50 % pour une privatisation (R-081, R-082). Le
> paiement de l'acompte confirme la réservation, qui passe à l'état
> « réservée », et bloque définitivement les places. Le solde restant n'est
> pas traité ici → `SPEC-PAY-BALANCE-02`.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le paiement du solde (lien H-24/H-12, paiement sur place) → `SPEC-PAY-BALANCE-02`
- Ne couvre pas le remboursement → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
- Ne couvre pas le paiement du supplément après ajout de participant → `SPEC-MODIF-01`
- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01` (sous réserve de la question ouverte hôtels, cahier V5 Q16)
- Ne couvre pas le blocage temporaire des places avant paiement → `SPEC-BOOK-03`
- Ne couvre pas la génération du justificatif d'acompte → `SPEC-JUSTIF-01`

### Scénarios nominaux

```gherkin
Étant donné une réservation standard d'un montant total de 260 €
Quand le client paie l'acompte en ligne (30 % = 78 €)
Alors le paiement de l'acompte est enregistré
Et la réservation passe à l'état « réservée »
Et le statut de paiement passe à « acompte payé »
Et les places sont définitivement bloquées

Étant donné une privatisation d'un montant total de 600 €
Quand le client paie l'acompte en ligne (50 % = 300 €)
Alors le paiement de l'acompte est enregistré
Et la réservation passe à l'état « réservée »
Et le statut de paiement passe à « acompte payé »
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le client n'a pas payé l'acompte dans les 15 minutes après le clic sur « Payer » | La place temporairement bloquée est libérée (`SPEC-BOOK-03`). Aucune réservation n'est créée. |
| 2 | le paiement de l'acompte échoue (carte refusée, service indisponible) | Le client est invité à réessayer ; aucune réservation n'est confirmée (pas d'état « réservée » sans acompte payé). |
| 3 | réservation hôtel | Hors périmètre : l'hôtel est confirmé exclu de l'acompte obligatoire, il paie en une fois chaque mois pour toutes ses réservations (cahier V5, question 16 tranchée ; `SPEC-BOOK-02`, `SPEC-FACT-01`). |
| 4 | l'acompte calculé comporte une fraction de centime | (À préciser) règle d'arrondi non définie (cahier V5, question 17). |

### Ce qui n'est pas défini

- Prestataire de paiement fixe (pas de prestataire fixe, ADR-001 : Stripe).
- Référence de la transaction.
- Règle d'arrondi si l'acompte comporte une fraction de centime (cahier V5, question 17).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un client particulier paie obligatoirement un acompte en ligne après avoir soumis sa réservation.
- [ ] AC-2 — L'acompte est de 30 % du montant total TTC pour une réservation standard, 50 % pour une privatisation.
- [ ] AC-3 — Le paiement de l'acompte confirme la réservation (état « réservée », statut « acompte payé ») et bloque définitivement les places.
- [ ] AC-4 — En cas de non-paiement de l'acompte sous 15 minutes, la place est libérée (renvoi `SPEC-BOOK-03`).
- [ ] AC-5 — En cas d'échec du paiement de l'acompte, aucune réservation n'est confirmée et le client est invité à réessayer.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| CR-05 remplace le paiement intégral unique par un acompte + solde différé | tranchée | Refonte complète suite au cahier des charges V5 et `docs/impacts/impact-CR-001.md` (§4) |
| La spec couvrait auparavant acompte et solde dans un seul flux | corrigée | Séparée en deux specs : `SPEC-PAY-01` (acompte, ce document) et `SPEC-PAY-BALANCE-02` (solde, nouvelle) |
| Cette spec s'applique-t-elle aux réservations hôtel ? | tranchée | Confirmé par le client : non, l'hôtel reste sur son fonctionnement existant (paiement groupé mensuel, `SPEC-FACT-01`), exclu de l'acompte obligatoire (cahier V5, question 16) |
| Règle d'arrondi de l'acompte non définie | à trancher | Renvoi cahier V5, question ouverte 17 |
| AC-4 dépend de `SPEC-BOOK-03` (délai 15 min) — AC non autonome | à trancher | Point déjà relevé avant la refonte, toujours valable |
| Prestataire de paiement non fixe (ADR-001 : Stripe) — comportement d'échec dépendant du prestataire | OK | Noté dans « Ce qui n'est pas défini » |

Les refus se reportent aussi dans `docs/journal.md`.
