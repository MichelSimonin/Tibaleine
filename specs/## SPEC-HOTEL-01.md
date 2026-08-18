## SPEC-HOTEL-01 — Compte hôtel et consultation des créneaux

**Exigence :** REQ-011
**Statut :** revue IA faite
**Version :** v1

### Règle

> Un hôtel partenaire dispose d'un compte lui permettant de consulter les créneaux disponibles et de suivre ses réservations.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la création d'une réservation hôtel → `SPEC-BOOK-02`
- Ne couvre pas la facturation hôtel en fin de mois → `SPEC-FACT-01`
- Ne couvre pas les alertes/annulations (l'hôtel est prévenu par téléphone) → `SPEC-CANCEL-PRESTATAIRE-02` (cas 2), `SPEC-ALERT-01`

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

### Ce qui n'est pas défini

- Gestion des comptes multiples pour un même hôtel (un compte = un hôtel).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas de test.

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
| La spec suppose un « compte hôtel » distinct alors que le MCD V2 ne porte aucun rôle « hôtel » (table `Hotel` retirée le 14/08/2026) | à trancher | Ajouter un rôle/flag « hôtel » ou considérer un compte client standard |
| Qui crée le compte hôtel ? Le scénario dit « Quand le patron crée un compte hôtel » — l'hôtel peut-il s'inscrire lui-même ? | corrigée | Décision : le patron crée le compte hôtel (l'hôtel ne s'inscrit pas lui-même). |
| Cas limite 1 (« un seul compte par hôtel ») contredit « Ce qui n'est pas défini » (« gestion des comptes multiples… ») | à trancher | Incohérence interne à lever |
| Portée incomplète : ni `SPEC-DISP-01` (consultation des créneaux) ni `SPEC-AUTH-01` (connexion) ne sont référencés | à trancher | Compléter la portée |
| AC-1 « Un compte hôtel peut être créé » non vérifiable tant que le créateur (patron/hôtel) et la nature du compte ne sont pas définis | à trancher | |

Les refus se reportent aussi dans `docs/journal.md`.
