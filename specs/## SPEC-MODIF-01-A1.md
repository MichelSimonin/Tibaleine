## SPEC-MODIF-01-A1 — Amendement : montants après modification

**Exigence :** REQ-010
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-MODIF-01`
**Motif :** rendre explicites le montant courant, le solde et le traitement d’un trop-perçu.

### Règle applicable

Une réservation distingue les valeurs suivantes :

- le `montant initial`, fixé lors de la réservation et conservé comme référence pour les frais d’annulation ;
- le `montant courant`, égal au prix de la réservation après ses modifications ;
- l’`acompte`, qui reste figé après son paiement ;
- le `solde restant`, recalculé à partir du montant courant et des sommes déjà encaissées.

Le client demande la modification par téléphone et le patron l’enregistre.

En cas d’ajout de participants, le montant courant augmente et la différence est intégrée au solde restant. Aucun complément d’acompte séparé et aucun nouveau paiement immédiat ne sont créés : la différence suit le parcours normal du solde défini par `SPEC-PAY-BALANCE-02-A1`.

En cas de suppression de participants, le montant courant diminue. Si les sommes encaissées dépassent ce nouveau montant, le solde reste à zéro et la différence devient un trop-perçu à rembourser. Le patron initie ce remboursement, qui n’est enregistré qu’une fois après confirmation.

### Critères d’acceptation

- **AC-1** — Une modification change le montant courant sans modifier le montant initial.
- **AC-2** — L’acompte déjà payé n’est jamais recalculé.
- **AC-3** — Un ajout de participants augmente le solde sans créer de complément d’acompte ni de paiement immédiat séparé.
- **AC-4** — Une suppression recalcule le solde sans jamais produire un solde négatif.
- **AC-5** — Si les sommes encaissées dépassent le montant courant, la différence est identifiée comme trop-perçu et le patron peut initier son remboursement.
- **AC-6** — Une confirmation répétée du même remboursement n’enregistre pas un second remboursement.
- **AC-7** — La modification est refusée si elle dépasse la capacité disponible ou le délai autorisé.

### Hors périmètre

Cet amendement n’ajoute pas de modification en ligne par le client et ne change pas les règles de calcul des frais d’annulation.
