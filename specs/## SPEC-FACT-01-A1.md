## SPEC-FACT-01-A1 — Amendement : facturation mensuelle des hôtels

**Exigence :** REQ-013
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-FACT-01`
**Motif :** distinguer l’émission d’une facture de son règlement et limiter la facture mensuelle aux hôtels.

### Périmètre

La facture mensuelle concerne uniquement les utilisateurs ayant le rôle `hotel`. Les clients ordinaires restent soumis au parcours de paiement et aux justificatifs qui leur sont propres.

### Règle applicable

À la fin du mois, le patron établit pour chaque hôtel une facture regroupant ses réservations facturables du mois. La remise hôtel de 15 % s’applique selon les règles déjà définies.

Une réservation annulée et non due n’est pas incluse dans cette facture.

L’émission de la facture ne constitue pas un paiement : les réservations concernées restent au statut `en attente de paiement` tant que le règlement de l’hôtel n’a pas été reçu.

Lorsque le règlement intégral de la facture est reçu, le patron l’enregistre. Les réservations couvertes passent alors au statut `intégralement payé`. Cet enregistrement ne doit produire qu’un seul règlement, même si la confirmation est répétée.

### Critères d’acceptation

- **AC-1** — Une facture mensuelle regroupe uniquement les réservations facturables d’un même hôtel et d’un même mois.
- **AC-2** — Une facture mensuelle n’est jamais générée pour un client ordinaire.
- **AC-3** — L’émission de la facture ne modifie pas le statut de paiement des réservations.
- **AC-4** — Seul l’enregistrement du règlement intégral fait passer les réservations couvertes à `intégralement payé`.
- **AC-5** — Une confirmation répétée du même règlement ne crée pas un second paiement.

### Hors périmètre

Cet amendement ne prévoit ni paiement hôtel à l’avance ni automatisation obligatoire de l’émission de la facture.
