## SPEC-HOTEL-01 — Compte hôtel et consultation des créneaux

**Exigence :** REQ-011
**Statut :** brouillon
**Version :** v1

### Règle

> Un hôtel partenaire dispose d'un compte lui permettant de consulter les
> créneaux disponibles et de suivre ses réservations.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la création d'une réservation hôtel → `SPEC-BOOK-02`
- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01`
- Ne couvre pas les alertes/annulations (l'hôtel est prévenu par téléphone) → `SPEC-CANCEL-02` (cas 2), `SPEC-ALERT-01`

### Scénarios nominaux

```gherkin
Étant donné un hôtel partenaire
Quand le patron crée un compte hôtel
Alors l'hôtel peut se connecter et consulter les créneaux disponibles

Étant donné un hôtel connecté
Quand il consulte ses réservations
Alors il voit les réservations liées à son compte
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | un même hôtel veut plusieurs comptes | Un seul compte par hôtel (un hôtel correspond à un utilisateur). |
| 2 | l'hôtel tente de réserver directement (sans le patron) | La réservation hôtel passe par le patron (SPEC-BOOK-02) — le compte hôtel est en lecture/consultation. |
| 3 | l'hôtel consulte un créneau après un avertissement météo | L'alerte est-elle visible pour le compte hôtel ? (à préciser — l'hôtel est appelé par téléphone, SPEC-CANCEL-02 cas 2) |

### Ce qui n'est pas défini

- Comment distinguer un compte hôtel d'un compte client ordinaire : le MCD V2 ne porte pas de rôle « hôtel » (la table `Hotel` a été retirée). À trancher : ajouter un rôle/flag ou considérer le compte hôtel comme un compte client standard.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un compte hôtel peut être créé.
- [ ] AC-2 — L'hôtel peut consulter les créneaux disponibles.
- [ ] AC-3 — L'hôtel peut consulter ses réservations.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
