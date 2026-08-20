# CASE-CANCEL-CLIENT-AVERTISSEMENT-04-A1 — Trace d’envoi réussi

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03-A1`
**Critère d'acceptation :** `AC-1`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-CLIENT-AVERTISSEMENT-04`
**Motif :** exiger une trace d’envoi réussi plutôt qu’une preuve de réception.

## Cas

```gherkin
Étant donné un avertissement associé à un client, sa réservation et sa sortie
Quand le service confirme que l’envoi a réussi
Alors cette trace est enregistrée et peut être retrouvée
Et aucun accusé de lecture ni de réception opérateur n’est exigé
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_CLIENT_AVERTISSEMENT_04_A1_trace_envoi_reussi`
