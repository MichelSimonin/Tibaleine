## SPEC-LANG-01 — Interface et messages en français et en anglais

**Exigence :** REQ-014
**Statut :** brouillon
**Version :** v1

### Règle

> L'interface du site et les messages envoyés aux clients (alertes, annulations,
> confirmations) sont proposés en **français et en anglais**.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le contenu des messages d'alerte → `SPEC-ALERT-01`
- Ne couvre pas le choix de la langue par l'utilisateur (non précisé)

### Scénarios nominaux

```gherkin
Étant donné un client étranger
Quand il consulte le site dans une langue autre que le français
Alors l'interface s'affiche en anglais

Étant donné un avertissement ou une annulation
Quand le message est envoyé
Alors il est disponible en français et en anglais
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | langue non supportée | Le site bascule sur la langue par défaut (français). |
| 2 | message d'annulation d'un client francophone | Le message est envoyé en français. |

### Ce qui n'est pas défini

- Langues supplémentaires (seul le français et l'anglais sont exigés).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — L'interface est disponible en français et en anglais.
- [ ] AC-2 — Les messages d'alerte et d'annulation sont disponibles en français et en anglais.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
