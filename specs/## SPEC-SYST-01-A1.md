## SPEC-SYST-01-A1 — Amendement : traitement des confirmations de paiement

**Exigence :** REQ-020
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-SYST-01`
**Motif :** préciser le comportement système minimal face aux répétitions et aux échecs de confirmation.

### Règle applicable

Une confirmation reçue du prestataire de paiement est identifiée par sa référence externe et traitée de manière idempotente.

- La première confirmation valide applique l’opération attendue.
- Une confirmation répétée avec la même référence retourne le résultat existant sans rejouer l’opération.
- Une confirmation invalide ou échouée ne crée aucun paiement confirmé et ne modifie pas la réservation comme si elle était payée.
- En l’absence de confirmation valide, le paiement reste en attente ou échoué selon le résultat connu.
- Une nouvelle réception de la même référence reste sûre et ne peut pas créer de doublon.

Ces règles s’appliquent à l’acompte, au solde et à l’enregistrement d’un règlement hôtel lorsqu’une référence externe est utilisée.

### Critères d’acceptation

- **AC-1** — Une même référence externe n’applique jamais deux fois une opération financière.
- **AC-2** — Une confirmation invalide ne produit aucun statut payé.
- **AC-3** — Une répétition après une confirmation réussie renvoie le résultat déjà enregistré.
- **AC-4** — Une opération sans confirmation valide n’est pas considérée comme encaissée.

### Hors périmètre

Cet amendement ne définit pas de supervision des services externes et ne modifie pas la gestion des pannes SMS ou e-mail.
