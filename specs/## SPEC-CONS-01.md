## SPEC-CONS-01 — Consultation des réservations

**Exigence :** REQ-004, REQ-005
**Statut :** brouillon | revue IA faite
**Version :** v1

### Règle

> Un client consulte ses propres réservations. Le patron (administrateur)
> consulte toutes les réservations. L'employé consulte les réservations en
> lecture seule, sans pouvoir les modifier.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas l'accès par rôle → `SPEC-AUTH-01`
- Ne couvre pas l'annulation → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
- Ne couvre pas la modification (hors périmètre V1 — spec supprimée)

### Scénarios nominaux

```gherkin
Étant donné un client connecté ayant 2 réservations
Quand il consulte ses réservations
Alors il voit uniquement ses 2 réservations

Étant donné un employé connecté
Quand il consulte les réservations
Alors il voit toutes les réservations en lecture seule

Étant donné l'administrateur connecté
Quand il consulte les réservations
Alors il voit toutes les réservations avec les actions de gestion
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un client tente de voir la réservation d'un autre client | Accès refusé (il ne voit que ses propres réservations). |
| 2 | l'employé tente de modifier une réservation | Action bloquée (lecture seule). |
| 3 | aucun résultat | Le client voit un message « aucune réservation ». |

### Ce qui n'est pas défini

- Historique des paiements affiché dans la consultation (question ouverte du cahier).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le client ne voit que ses propres réservations.
- [ ] AC-2 — L'employé voit toutes les réservations en lecture seule.
- [ ] AC-3 — L'administrateur voit toutes les réservations avec les actions de gestion.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Un client peut-il consulter ses réservations sans compte ? (le mot de passe est optionnel — comment identifie-t-il ses réservations ?) | tranchée | Résolu par la décision prise sur `SPEC-AUTH-01` : accès via un lien de connexion envoyé par email, à usage unique (pas de mot de passe requis). |
| L'employé voit-il toutes les réservations ou un sous-ensemble ? (CR-02 §4 : « consulter uniquement ces réservations ») | tranchée | Décision d'équipe : l'employé voit toutes les réservations, en lecture seule (pas de modification possible). |
| Les « actions de gestion » de l'administrateur ne sont pas listées | à trancher | |
| Les réservations annulées restent-elles visibles dans la consultation (historique) ? | à trancher | Cas limite manquant |
| Filtres / tri (date, statut, bateau) non définis | à trancher | |
| AC-1 à AC-3 vérifiables | OK | |

Les refus se reportent aussi dans `docs/journal.md`.
