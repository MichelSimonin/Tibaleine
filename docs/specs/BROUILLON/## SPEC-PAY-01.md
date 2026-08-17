## SPEC-PAY-01 — Paiement en ligne

**Exigence :** REQ-006
**Statut :** brouillon
**Version :** v1

### Règle

> Après confirmation de sa demande de réservation, un client particulier paie sa
> réservation **en ligne**. Une fois le paiement effectué, la réservation passe à
> l'état « payée » et les places sont définitivement réservées.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le remboursement → `SPEC-CANCEL-01`, `SPEC-CANCEL-02`, `SPEC-CANCEL-03`
- Ne couvre pas le paiement du supplément après ajout de participant → `SPEC-MODIF-01`
- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01`

### Scénarios nominaux

```gherkin
Étant donné une réservation confirmée de 260 €
Quand le client paie en ligne
Alors le paiement est enregistré
Et la réservation passe à l'état « payée »
Et les places sont décomptées de la capacité du bateau
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le client n'a pas payé dans les 15 minutes après le clic sur « Payer » | La place temporairement bloquée est libérée et redevient disponible. |
| 2 | le paiement échoue (carte refusée, service indisponible) | Le client est invité à réessayer ; la réservation reste « confirmée », pas « payée ». |
| 3 | la réservation est validée mais non payée au moment du départ | Question ouverte (voir cahier V4 §8) — à traiter au prochain entretien. |
| 4 | le paiement est différé (hôtel) | Hors périmètre : les hôtels paient en fin de mois (SPEC-FACT-01). |

### Ce qui n'est pas défini

- Prestataire de paiement fixe (pas de prestataire fixe, ADR-001 : Stripe).
- Référence de la transaction.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un client particulier peut payer en ligne après confirmation.
- [ ] AC-2 — La réservation passe à l'état « payée » après paiement.
- [ ] AC-3 — Les places sont mises à jour après le paiement.
- [ ] AC-4 — En cas de non-paiement sous 15 minutes, la place est libérée.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
