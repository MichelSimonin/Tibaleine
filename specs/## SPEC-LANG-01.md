## SPEC-LANG-01 — Interface et messages en français et en anglais

**Exigence :** REQ-014
**Statut :** brouillon | revue IA faite
**Version :** v1

### Règle

> L'interface du site est proposée en **français et en anglais**. Les messages envoyés aux clients (alertes, annulations, confirmations) sont envoyés **dans la langue du client**.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le contenu des messages d'alerte → `SPEC-ALERT-01`
- Ne couvre pas le choix de la langue par l'utilisateur (non précisé)

### Scénarios nominaux

```gherkin
Étant donné un client étranger
Quand il consulte le site dans une langue autre que le français
Alors l'interface s'affiche en anglais

Étant donné un avertissement ou une annulation
Quand le message est envoyé
Alors il est envoyé dans la langue du client
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

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas de test.

- [ ] AC-1 — L'interface est disponible en français et en anglais.
- [ ] AC-2 — Les messages d'alerte et d'annulation sont envoyés dans la langue du client.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Le mécanisme de choix de la langue n'est pas défini (sélecteur, langue du navigateur, langue par défaut) alors que la règle suppose un affichage bilingue | à trancher | Le « comment » du basculement est absent |
| Contradiction : scénario 2 (« disponible en français ET en anglais ») vs cas limite 2 (« envoyé en français » pour un client francophone) | corrigée | Décision : message envoyé dans la langue du client. |
| Chevauchement avec `SPEC-ALERT-01` qui porte déjà la langue des messages (règle R-71) | à trancher | Éviter la double règle — qui est responsable ? |
| AC-1 et AC-2 non testables tant que le mécanisme de sélection de la langue n'est pas défini | à trancher | |
| Le MCD V2 ne porte aucun attribut « langue » permettant de connaître la langue d'un client | à trancher | Ajouter un champ ou dériver de la langue du navigateur |

Les refus se reportent aussi dans `docs/journal.md`.
