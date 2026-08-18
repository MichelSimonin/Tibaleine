# CASE-DISP-07 — Les places sont décomptées dès le clic sur « Réserver »

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** `AC-01`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'exactitude du nombre de places restantes affiché aux autres
clients pendant qu'un client est en cours de réservation. Si la règle se
casse, deux clients pourraient voir le même nombre de places libres alors
qu'une place est déjà bloquée par l'un d'eux, menant à une tentative de
double réservation.

## Cas

```gherkin
Étant donné une sortie baleine le 12 juillet 2026 à 10:00 avec 4 places restantes
Quand un premier client clique sur « Réserver » et bloque une place
Alors le créneau affiche 3 places restantes pour les autres clients qui consultent le calendrier
```

## Données

| Élément                            |                       Valeur |
| --------------------------------------- | -----------------------------: |
| Sortie                                   | baleine, 12 juillet 2026 10:00 |
| Places restantes avant le clic            |                              4 |
| Places bloquées par le premier client       |                              1 |

## Résultat attendu, calculé à la main

| Grandeur                            | Valeur attendue | Calcul                        |
| ------------------------------------------ | ---------------: | ------------------------------------ |
| Places restantes affichées après le clic     |                3 | 4 − 1 place bloquée                   |

## Ce que ce cas ne vérifie pas

- la libération de la place si le client ne termine pas sa réservation → `CASE-DISP-04` ;
- le mécanisme de blocage temporaire lui-même (durée, expiration) → `SPEC-BOOK-03` ;
- l'affichage simple sans réservation concurrente → `CASE-DISP-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_07_places_decomptees_des_le_clic_reserver`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau avec un nombre de places restantes connu.
- [ ] Le test simule un premier client cliquant sur « Réserver » (blocage d'une place).
- [ ] Le test consulte le calendrier avec un second client pendant que la place est bloquée.
- [ ] Le test vérifie que le nombre de places affiché au second client est décrémenté.
- [ ] Le nom du test contient `CASE_DISP_07`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
