## SPEC-PAY-BALANCE-02-A1 — Amendement : sécurisation du paiement du solde

**Exigence :** REQ-022, REQ-023
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-PAY-BALANCE-02`
**Motif :** supprimer le risque de double encaissement entre le paiement en ligne et le paiement sur place.

### Règle applicable

Chaque tentative de paiement du solde en ligne possède une référence externe unique. Une même référence ne peut être confirmée qu’une fois.

L’échéance H-12 interdit de commencer une nouvelle tentative en ligne. Elle n’annule pas une tentative valablement commencée avant H-12 : si cette tentative est confirmée ensuite, sa confirmation reste recevable et est enregistrée une seule fois.

Avant d’enregistrer un paiement sur place, le patron doit vérifier qu’aucun paiement en ligne du solde n’est déjà :

- confirmé ;
- ou en cours de confirmation.

Si une tentative en ligne est en cours, l’enregistrement sur place est bloqué jusqu’à son résultat. Si le solde est déjà confirmé en ligne, aucun second encaissement ne peut être enregistré.

### Critères d’acceptation

- **AC-1** — Une confirmation répétée de la même référence externe ne crée qu’un paiement.
- **AC-2** — Une tentative commencée avant H-12 peut être confirmée après H-12.
- **AC-3** — Après H-12, aucune nouvelle tentative de paiement en ligne ne peut être initiée.
- **AC-4** — Le paiement sur place est refusé lorsqu’une tentative en ligne est en cours ou déjà confirmée.
- **AC-5** — Le statut `intégralement payé` n’est appliqué qu’une fois le solde effectivement confirmé.

### Hors périmètre

Cet amendement n’ajoute ni nouveau moyen de paiement, ni relance supplémentaire, ni mécanisme automatique de rapprochement bancaire.
