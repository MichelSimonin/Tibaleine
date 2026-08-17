## SPEC-AUTH-01 — Compte, connexion et accès par rôle

**Exigence :** REQ-002, REQ-003
**Statut :** validé
**Version :** v1

### Règle

> Un utilisateur peut créer un compte (au moment de la réservation), se
> connecter, puis accéder à une vue selon son rôle : `utilisateur` (client,
> consultation et gestion de ses propres réservations), `employe` (consultation
> seule) ou `administrateur` (patron, accès complet).

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la création d'une réservation → `SPEC-BOOK-01`, `SPEC-BOOK-02`
- Ne couvre pas la consultation des réservations → `SPEC-CONS-01`
- Ne couvre pas la gestion des créneaux disponibles → `SPEC-DISP-01`

### Scénarios nominaux

```gherkin
Étant donné un visiteur sur le site
Quand il réserve une sortie en fournissant email, nom, prénom et téléphone, 
un mail lui est envoyé pour lui donner la possibilité de créer un compte.
Le visiteur associe un mot de passe avec son email.
Alors un compte client est créé avec le rôle « utilisateur »
Et le client peut se connecter avec son email et le mot de passe.

Étant donné un employé connecté
Quand il ouvre l'espace de gestion
Alors il consulte les réservations en lecture seule

Étant donné l'administrateur connecté
Quand il ouvre l'espace de gestion
Alors il a accès complet (consulter, modifier, annuler)
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | email déjà utilisé | La création de compte est refusée (email unique). |
| 2 | mot de passe absent (optionnel) | Le compte est créé sans mot de passe (nullable — décision équipe 12/08/2026). |
| 3 | mot de passe trop court ou sans caractère spécial | L'inscription est refusée (8 caractères minimum + caractères spéciaux). |
| 4 | un client tente d'accéder à la vue patron | Accès bloqué (vue non autorisée pour son rôle). |

### Ce qui n'est pas défini

- Réinitialisation d'un mot de passe oublié (non évoqué en entretien).
- Désactivation d'un compte utilisateur.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un visiteur peut créer un compte au moment de la réservation.
- [ ] AC-2 — Un client peut se connecter avec son email.
- [ ] AC-3 — L'employé accède aux réservations en lecture seule.
- [ ] AC-4 — L'administrateur accède à toutes les fonctions.
- [ ] AC-5 — Un rôle ne peut pas accéder aux fonctions d'un autre rôle.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
