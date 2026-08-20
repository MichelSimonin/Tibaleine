## SPEC-HOTEL-01-A1 — Amendement : représentation d’un hôtel

**Exigence :** REQ-011
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-HOTEL-01`
**Motif :** supprimer l’ambiguïté entre un hôtel, un compte hôtel et un utilisateur.

### Règle applicable

Un hôtel est représenté par un utilisateur dont le rôle vaut `hotel`. Un même utilisateur hôtel porte son identité, accède à ses réservations et bénéficie des règles métier propres aux hôtels.

Ces règles métier sont :

- au maximum 6 participants par réservation ;
- aucune privatisation ;
- aucun acompte à la réservation ;
- paiement selon la facturation mensuelle définie par `SPEC-FACT-01-A1`.

### Critères d’acceptation

- **AC-1** — Le système reconnaît une réservation hôtel à partir du rôle `hotel` de son utilisateur.
- **AC-2** — Les limites et conditions hôtel sont appliquées sans créer une entité ou un profil hôtel séparé.
- **AC-3** — Le patron peut identifier l’utilisateur hôtel associé à chaque réservation.

### Hors périmètre

Cet amendement n’ajoute pas de fiche hôtel, d’établissement secondaire ni de données métier supplémentaires.
