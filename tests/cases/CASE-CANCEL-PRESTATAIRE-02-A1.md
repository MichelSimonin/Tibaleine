# CASE-CANCEL-PRESTATAIRE-02-A1 — Choix explicite après annulation du prestataire

**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02-A1`
**Critère d'acceptation :** `AC-1`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CANCEL-PRESTATAIRE-02`
**Motif :** enregistrer l’annulation du créneau puis un choix exclusif du client.

## Cas

```gherkin
Étant donné une sortie annulée par le prestataire
Et une réservation concernée
Quand le client choisit explicitement le remboursement
Alors ce choix est enregistré
Et l’option de report n’est pas appliquée
Et le système interdit d’enregistrer simultanément les deux choix
```

## Test automatisé

**Nom attendu :** `test_CASE_CANCEL_PRESTATAIRE_02_A1_choix_exclusif`
