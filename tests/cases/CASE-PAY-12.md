# CASE-PAY-12 — Solde sur place enregistré par le patron

**Spécifications :** `SPEC-PAY-BALANCE-02`, `SPEC-PAY-BALANCE-02-A1`
**Critères d'acceptation :** `SPEC-PAY-BALANCE-02/AC-4`, `AC-5`, `AC-8`; `SPEC-PAY-BALANCE-02-A1/AC-4`, `AC-5`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation « réservée » avec le statut « acompte payé »
Et aucune tentative de paiement en ligne en cours ou confirmée
Quand le patron enregistre le règlement du solde sur place
Alors un paiement de solde est enregistré
Et le statut devient « intégralement payé »
Et l’état de la réservation reste « réservée »
Et cette fonction ne permet pas d’enregistrer manuellement un acompte

Plan du scénario: paiement sur place refusé pendant ou après un paiement en ligne
Étant donné une tentative en ligne du solde <situation>
Quand le patron tente d’enregistrer le même solde sur place
Alors l’enregistrement sur place est refusé

Exemples:
| situation |
| en cours |
| déjà confirmée |
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_12_solde_sur_place_patron`
