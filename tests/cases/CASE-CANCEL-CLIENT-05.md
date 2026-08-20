# CASE-CANCEL-CLIENT-05 — Refus d’une nouvelle annulation impossible

**Spécification :** `SPEC-CANCEL-CLIENT-01-A1`
**Critère d'acceptation :** `AC-6`
**Statut :** applicable

## Cas

```gherkin
Plan du scénario: annulation refusée selon l’état de la réservation
Étant donné une réservation <situation>
Quand le client demande son annulation
Alors la demande est refusée
Et aucun nouveau remboursement ni complément n’est créé

Exemples:
| situation |
| déjà annulée |
| réalisée |
| dont le départ est passé |
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_05_annulation_etat_terminal_refusee`
