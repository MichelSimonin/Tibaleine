# CASE-PAY-11 — Réservation créée à moins de H-12

**Spécification :** `SPEC-PAY-BALANCE-02`
**Critère d'acceptation :** `AC-7`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation autorisée créée 8 heures avant le départ
Et un acompte confirmé en ligne
Quand le système détermine le mode de règlement du solde
Alors aucun lien de paiement en ligne du solde n’est proposé
Et le solde est indiqué comme payable uniquement sur place
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_11_reservation_moins_h12`
