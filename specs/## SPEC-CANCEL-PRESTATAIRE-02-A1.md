## SPEC-CANCEL-PRESTATAIRE-02-A1 — Amendement : choix entre remboursement et report

**Exigence :** REQ-017
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-CANCEL-PRESTATAIRE-02`
**Motif :** préciser l’action du client et le rôle du patron après une annulation du prestataire.

### Règle applicable

Après l’annulation d’une sortie par le prestataire, chaque client concerné choisit l’une des deux options suivantes :

1. **Remboursement** : le remboursement porte sur toutes les sommes effectivement encaissées. Après le choix du client, le patron initie le remboursement. Celui-ci est enregistré comme effectué uniquement après confirmation et une seule fois.
2. **Report** : le patron propose ou enregistre un nouveau créneau accepté par le client. Les sommes déjà encaissées et le statut de paiement sont conservés sur la réservation reportée ; aucun remboursement n’est initié.

Les deux choix sont exclusifs. Le choix d’un report ne déclenche donc pas de remboursement.

Pour une réservation hôtel non réglée, aucun remboursement n’est nécessaire : elle est exclue de la facture mensuelle et le patron contacte directement l’hôtel.

### Critères d’acceptation

- **AC-1** — Le client peut choisir soit le remboursement, soit le report, mais pas les deux.
- **AC-2** — Si le client choisit le remboursement, le patron peut initier le remboursement de toutes les sommes encaissées.
- **AC-3** — Une confirmation répétée du même remboursement n’est enregistrée qu’une fois.
- **AC-4** — Si le client choisit le report, le patron enregistre un créneau accepté et aucun remboursement n’est initié.
- **AC-5** — Après le report, la réservation revient à l’état `réservée` et conserve ses sommes encaissées ainsi que son statut de paiement.
- **AC-6** — Une réservation hôtel annulée et non réglée est exclue de la facture mensuelle.

### Hors périmètre

Cet amendement ne crée pas de sélection automatique du nouveau créneau et ne modifie pas les horaires d’avertissement ou d’annulation déjà définis.
