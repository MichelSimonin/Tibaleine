# CASE-PAY-14 — Aucun lien de solde avant H-24

**Référence :** cahier V5 `REQ-022`, `R-85`
**Statut :** applicable
**Priorité :** critique
**Nom attendu :** `test_CASE_PAY_14_aucun_lien_solde_avant_h24`

## Cas

Avant H-24, aucun lien de paiement du solde n'est créé. À H-24, le lien devient disponible jusqu'à son expiration à H-12.

## Résultat attendu

Le début de la fenêtre de paiement en ligne est strictement respecté.
