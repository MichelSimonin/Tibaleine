## SPEC-PAY-01 — Paiement en ligne

**Exigence :** REQ-006
**Statut :** revue IA faite
**Version :** v1

### Règle

> Après confirmation de sa demande de réservation, un client particulier paie sa
> réservation **en ligne**. Une fois le paiement effectué, la réservation passe à
> l'état « payée » et les places sont définitivement réservées.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le remboursement → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
- Ne couvre pas le paiement du supplément après ajout de participant
- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01`

### Scénarios nominaux

```gherkin
Étant donné une réservation de 260 €
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
| 2 | le paiement échoue (carte refusée, service indisponible) | Le client est invité à réessayer ; la réservation n'est pas marquée « payée ». |
| 3 | le paiement est différé (hôtel) | Hors périmètre : les hôtels paient en fin de mois (SPEC-FACT-01). |

### Ce qui n'est pas défini

- Prestataire de paiement fixe (pas de prestataire fixe, ADR-001 : Stripe).
- Référence de la transaction.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un client particulier peut payer en ligne après sa réservation.
- [ ] AC-2 — La réservation passe à l'état « payée » après paiement.
- [ ] AC-3 — Les places sont mises à jour après le paiement.
- [ ] AC-4 — En cas de non-paiement sous 15 minutes, la place est libérée.
- [ ] AC-5 — En cas d'échec du paiement (carte refusée, service indisponible), la réservation n'est pas marquée « payée » et le client est invité à réessayer.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Cas limite 2 : « la réservation reste en attente » — incohérent avec la Règle (« après confirmation… paie ») et le workflow confirmée → payée du MCD | corrigée | La réservation n'est pas marquée « payée » ; cas couvert par AC-5 |
| Le blocage 15 min (cas 1) et `SPEC-BOOK-03` ne sont pas référencés dans la portée | à trancher | Ajouter le renvoi |
| AC-4 dépend de SPEC-BOOK-03 (délai 15 min) — AC non autonome | à trancher | |
| Prestataire de paiement non fixe (ADR-001 : Stripe) — comportement d'échec dépendant du prestataire | OK | Noté dans « Ce qui n'est pas défini » |
| Spec marquée « validé » avec ces points ouverts : reconsidérer le statut | à trancher | |

Les refus se reportent aussi dans `docs/journal.md`.
