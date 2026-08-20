## SPEC-BOOK-03-A1 — Amendement : expiration et concurrence d’une réservation

**Exigence :** REQ-019
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-BOOK-03`
**Motif :** aligner la réservation sur l’acompte et préciser le comportement à l’expiration du délai.

### Règle applicable

La place est bloquée pendant 15 minutes à l’ouverture du formulaire. Le passage au paiement ouvre un second délai de 15 minutes.

Si l’acompte est confirmé dans le délai applicable, la réservation passe à l’état `réservée`, son statut de paiement devient `acompte payé` et les places restent acquises.

À l’expiration du délai de paiement :

- les places sont libérées si aucune tentative de paiement n’a été commencée ;
- aucune nouvelle tentative de paiement ne peut être commencée avec cette réservation expirée ;
- une tentative commencée avant l’expiration peut encore être confirmée selon les règles d’unicité de `SPEC-PAY-01-A1` ;
- si les places ont entre-temps été attribuées, aucune seconde réservation ne peut être confirmée pour les mêmes places.

En cas de demandes concurrentes sur les dernières places disponibles, une seule opération de blocage ou de confirmation peut réussir.

### Critères d’acceptation

- **AC-1** — Une place est bloquée pendant 15 minutes à compter de l’ouverture du formulaire.
- **AC-2** — Le passage au paiement applique un second délai de 15 minutes.
- **AC-3** — La confirmation de l’acompte rend la réservation `réservée` avec le statut `acompte payé`, et non `payée`.
- **AC-4** — Après expiration, aucune nouvelle tentative ne peut être initiée avec la réservation expirée.
- **AC-5** — Une tentative commencée avant l’expiration peut être confirmée une seule fois.
- **AC-6** — Lorsque deux clients demandent simultanément la dernière place, au maximum une réservation est confirmée et l’autre reçoit un refus de disponibilité.

### Hors périmètre

Cet amendement ne modifie pas les deux délais de 15 minutes et n’ajoute pas de file d’attente.
