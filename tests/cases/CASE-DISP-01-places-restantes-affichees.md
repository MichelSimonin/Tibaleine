# CASE-DISP-01 — Un client voit les places restantes d'un créneau

**Statut :** applicable
**Nom attendu :** `test_CASE_DISP_01`

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** `AC-01`
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'affichage correct du nombre de places restantes sur un
créneau, avant toute réservation. Si la règle se casse, un client pourrait
voir un nombre de places erroné et tenter de réserver plus de personnes que
la capacité réelle ne le permet.

## Cas

```gherkin
Étant donné une sortie baleine le 12 juillet 2026 à 10:00 avec 4 places restantes
Quand un client consulte le calendrier
Alors le créneau est affiché comme disponible
Et il indique 4 places restantes
```

## Données

| Élément            |                       Valeur |
| ---------------------- | -----------------------------: |
| Sortie                  | baleine, 12 juillet 2026 10:00 |
| Places restantes         |                              4 |

## Résultat attendu, calculé à la main

| Grandeur              | Valeur attendue | Calcul                    |
| ------------------------ | ---------------: | ------------------------------ |
| Statut affiché              |        disponible | places restantes > 0            |
| Places restantes affichées  |                 4 | places réellement disponibles   |

## Ce que ce cas ne vérifie pas

- l'affichage d'un créneau complet → `CASE-DISP-02` ;
- la mise à jour du nombre de places pendant qu'un autre client est en cours de réservation → `CASE-DISP-07` ;
- l'affichage du badge « nouvelle place disponible » → `CASE-DISP-03`, `CASE-DISP-04` ;
- le format d'affichage du calendrier (vue jour/semaine/mois — non défini par la spec).

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_01_places_restantes_affichees`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau avec un nombre de places restantes connu.
- [ ] Le test consulte le calendrier en tant que client.
- [ ] Le test vérifie que le créneau est affiché comme disponible.
- [ ] Le test vérifie que le nombre de places affiché correspond aux places réellement disponibles.
- [ ] Le nom du test contient `CASE_DISP_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
