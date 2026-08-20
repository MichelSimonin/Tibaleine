# CASE-FACT-04 — Aucune facture mensuelle pour un client ordinaire

**Spécification :** `SPEC-FACT-01-A1`
**Critère d'acceptation :** `AC-2`
**Statut :** applicable

## Cas

```gherkin
Étant donné un client ordinaire avec plusieurs réservations dans le même mois
Quand le traitement mensuel de facturation hôtel est exécuté
Alors aucune facture mensuelle hôtel n’est créée pour ce client
```

## Test automatisé

**Nom attendu :** `test_CASE_FACT_04_aucune_facture_mensuelle_client`
