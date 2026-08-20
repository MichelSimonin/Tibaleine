# CASE-CONS-03-A1 — Le patron voit acompte, solde et mode prévu

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** `AC-4`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-CONS-03`
**Motif :** exposer au patron les informations nécessaires au suivi du solde.

## Cas

```gherkin
Étant donné une réservation de 260 € avec un acompte de 78 € encaissé
Et un solde de 182 € prévu sur place
Quand le patron consulte la réservation
Alors il voit l’acompte encaissé de 78 €
Et le solde restant de 182 €
Et le mode de paiement prévu « sur place »
Et l’état et le statut de paiement sont affichés séparément
```

## Test automatisé

**Nom attendu :** `test_CASE_CONS_03_A1_patron_voit_solde_mode`
