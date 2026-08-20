## SPEC-AUTH-01-A1 — Amendement : authentification des hôtels

**Exigence :** REQ-002, REQ-003, REQ-102
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-AUTH-01`
**Motif :** aligner l’authentification sur le choix simple d’un utilisateur portant le rôle `hotel`.

### Règle applicable

Un hôtel est un utilisateur authentifié dont le rôle vaut `hotel`. Il n’existe pas de compte, de profil ou de mécanisme d’authentification séparé pour les hôtels.

Le rôle `hotel` permet à l’utilisateur :

- d’accéder à son compte ;
- de consulter ses propres réservations ;
- d’utiliser le parcours de réservation hôtel défini par `SPEC-BOOK-02-A1`.

Il ne donne aucun droit réservé au patron, aux employés ou à l’administration.

### Critères d’acceptation

- **AC-1** — Un utilisateur ayant le rôle `hotel` peut s’authentifier avec le mécanisme existant.
- **AC-2** — Un utilisateur ayant le rôle `hotel` ne voit que ses propres réservations.
- **AC-3** — Un utilisateur ayant le rôle `hotel` ne peut pas accéder aux fonctions réservées au patron ou aux employés.
- **AC-4** — Aucun second compte ou profil hôtel n’est nécessaire.

### Hors périmètre

Cet amendement n’ajoute aucun nouveau mécanisme d’authentification et ne modifie pas les droits des autres rôles.
