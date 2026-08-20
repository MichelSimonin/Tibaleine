## SPEC-BOOK-02-A1 — Amendement : réservation par un hôtel

**Exigence :** REQ-012
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-BOOK-02`
**Motif :** clarifier la confirmation, l’état et le paiement d’une réservation hôtel.

### Règle applicable

Une réservation hôtel peut être créée directement par un utilisateur ayant le rôle `hotel`, ou être saisie par le patron pour cet utilisateur.

Lors de sa création :

- la réservation est immédiatement à l’état `réservée` ;
- son statut de paiement est `en attente de paiement` ;
- aucun acompte n’est demandé ;
- aucune validation supplémentaire du patron n’est requise ;
- le patron est informé de la nouvelle réservation.

La réservation reste soumise à une limite de 6 participants et ne peut pas privatiser une sortie.

Son règlement relève uniquement de la facturation mensuelle définie par `SPEC-FACT-01-A1`.

### Critères d’acceptation

- **AC-1** — Une réservation valide créée par un hôtel est immédiatement enregistrée à l’état `réservée`.
- **AC-2** — Son statut de paiement initial est `en attente de paiement`.
- **AC-3** — Aucun acompte et aucune confirmation manuelle du patron ne bloquent la réservation.
- **AC-4** — Une réservation de plus de 6 participants est refusée.
- **AC-5** — Une demande de privatisation par un hôtel est refusée.
- **AC-6** — Le patron reçoit l’information de création de la réservation.

### Hors périmètre

Cet amendement ne crée pas de paiement hôtel à l’avance ni de nouveau circuit de validation.
