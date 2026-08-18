## SPEC-COMM-01 — Liens vers les réseaux sociaux

**Exigence :** REQ-015
**Statut :** revue IA faite
**Version :** v1

### Règle

> Le site affiche des liens vers les réseaux sociaux de l'entreprise :
> **Facebook et Instagram**.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le contenu éditorial du site.

### Scénarios nominaux

```gherkin
Étant donné le site de l'entreprise
Quand un visiteur consulte la page
Alors il voit des liens vers Facebook et Instagram
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | lien inaccessible (réseau externe indisponible) | Le lien reste affiché ; l'ouverture est gérée par le navigateur. |

### Ce qui n'est pas défini

- Emplacement exact des liens sur la page (pied de page, en-tête…).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le site affiche un lien vers Facebook.
- [ ] AC-2 — Le site affiche un lien vers Instagram.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| … | acceptée / refusée | … |

Les refus se reportent aussi dans `docs/journal.md`.
