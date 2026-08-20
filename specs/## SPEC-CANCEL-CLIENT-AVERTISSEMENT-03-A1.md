## SPEC-CANCEL-CLIENT-AVERTISSEMENT-03-A1 — Amendement : annulation après avertissement

**Exigence :** REQ-018
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
**Motif :** définir la preuve de l’avertissement, l’exécution du remboursement et le devenir de la réservation.

### Règle applicable

Le client bénéficie de cette règle lorsqu’un envoi réussi de l’avertissement est tracé pour sa réservation et la sortie concernée. Cette trace d’envoi suffit ; aucun accusé de lecture ou de réception opérateur n’est exigé.

Si le client annule après cet avertissement, il a droit au remboursement intégral des sommes effectivement encaissées, que la sortie soit ensuite annulée ou maintenue.

Le patron initie le remboursement. Celui-ci n’est enregistré comme effectué qu’après sa confirmation, et une même confirmation ne peut être enregistrée qu’une fois.

La réservation d’origine reste à l’état `annulée`. Si la sortie est finalement maintenue et que le client souhaite participer, il doit effectuer une nouvelle réservation.

### Critères d’acceptation

- **AC-1** — Le système peut retrouver un envoi réussi de l’avertissement associé au client, à sa réservation et à la sortie.
- **AC-2** — Une annulation postérieure à cet envoi produit un remboursement de 100 % des sommes encaissées.
- **AC-3** — Le patron peut initier le remboursement calculé.
- **AC-4** — Une confirmation répétée du même remboursement n’en crée pas un second.
- **AC-5** — Le maintien ultérieur de la sortie ne réactive pas la réservation annulée.

### Hors périmètre

Cet amendement n’ajoute ni accusé de lecture, ni accusé de réception SMS ou e-mail, ni réinscription automatique.
