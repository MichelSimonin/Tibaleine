# CASE-JUSTIF-02 — Facture finale après paiement intégral

**Spécification :** `SPEC-JUSTIF-01`
**Critères d'acceptation :** `AC-2`, `AC-3`
**Statut :** applicable

## Cas

```gherkin
Plan du scénario: facture finale après règlement du solde
Étant donné une réservation dont l’acompte est payé
Quand le solde est confirmé par <canal>
Alors le statut de paiement devient « intégralement payé »
Et une facture finale est générée et mise à disposition du client

Exemples:
| canal |
| paiement en ligne |
| paiement sur place enregistré par le patron |
```

## Test automatisé

**Nom attendu :** `test_CASE_JUSTIF_02_facture_finale_tous_canaux`
