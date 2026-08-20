## SPEC-PAY-01-A1 — Amendement : unicité du paiement de l’acompte

**Exigence :** REQ-006, REQ-021
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-PAY-01`
**Motif :** empêcher qu’une confirmation répétée produise plusieurs paiements ou plusieurs réservations de places.

### Règle applicable

Chaque tentative de paiement en ligne possède une référence externe unique fournie par le prestataire de paiement.

La confirmation d’une même référence est traitée une seule fois. Toute confirmation répétée doit retourner le résultat déjà obtenu sans :

- enregistrer un second paiement ;
- modifier une seconde fois le statut de paiement ;
- réserver ou décrémenter une seconde fois les places.

Un utilisateur ayant le rôle `hotel` n’est pas soumis au paiement d’un acompte ; son règlement relève de `SPEC-FACT-01-A1`.

### Critères d’acceptation

- **AC-1** — Deux confirmations portant la même référence externe créent au maximum un paiement.
- **AC-2** — Les places ne sont réservées qu’une fois pour cette confirmation.
- **AC-3** — Une confirmation échouée ne fait pas passer la réservation à un statut payé.
- **AC-4** — Aucun acompte n’est demandé à un utilisateur ayant le rôle `hotel`.

### Hors périmètre

Cet amendement n’ajoute ni nouveau moyen de paiement ni nouveau parcours de relance.
