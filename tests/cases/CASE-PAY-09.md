# CASE-PAY-09 — Lien du solde entre H-24 et H-12

**Spécifications :** `SPEC-PAY-BALANCE-02`, `SPEC-PAY-BALANCE-02-A1`
**Critères d'acceptation :** `SPEC-PAY-BALANCE-02/AC-1`, `AC-2`, `AC-3`; `SPEC-PAY-BALANCE-02-A1/AC-2`, `AC-3`
**Statut :** applicable

## Cas

```gherkin
Étant donné une réservation créée plus de 24 heures avant le départ
Quand l’échéance H-24 est atteinte
Alors un lien de paiement du solde est envoyé au client
Et ce lien permet de démarrer un paiement avant H-12
Quand l’échéance H-12 est atteinte sans tentative en cours
Alors le lien devient inutilisable
Et aucune nouvelle tentative en ligne ne peut être initiée

Étant donné une tentative de paiement du solde commencée avant H-12
Quand sa confirmation valide arrive après H-12
Alors cette tentative est confirmée une seule fois
```

## Test automatisé

**Nom attendu :** `test_CASE_PAY_09_lien_solde_h24_h12`
