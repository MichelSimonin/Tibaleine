# CASE-PAY-01-A1 — Enregistrement d’un acompte en ligne

**Spécification :** `SPEC-PAY-01`
**Critère d'acceptation :** `AC-2`
**Statut :** applicable
**Version :** A1
**Amende :** `CASE-PAY-01`
**Motif :** le paiement enregistré est un acompte et non nécessairement le montant total.

## Cas

```gherkin
Étant donné une réservation standard d’un montant de 260 €
Quand le prestataire confirme l’acompte de 78 € avec une référence externe unique
Alors un paiement de 78 € est enregistré
Et aucun paiement de 260 € n’est enregistré
Et la réservation conserve un solde de 182 €
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_01_A1_enregistrement_acompte`
