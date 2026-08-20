# CASE-DISP-03 — Badge « nouvelle place disponible » après une annulation

**Statut :** applicable
**Nom attendu :** `test_CASE_DISP_03`

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** `AC-03`
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'affichage du badge « nouvelle place disponible » lorsqu'un
créneau complet se libère suite à une annulation. Si la règle se casse, des
clients pourraient continuer à voir un créneau comme indisponible alors
qu'une place vient de se libérer, et manquer l'opportunité de réserver.

## Cas

```gherkin
Étant donné une sortie baleine le 12 juillet 2026 à 10:00, complète (0 place restante)
Quand une annulation libère une place sur ce créneau
Alors le créneau affiche 1 place restante
Et le site affiche un badge « nouvelle place disponible » sur ce créneau
```

## Données

| Élément                  |                       Valeur |
| ---------------------------- | -----------------------------: |
| Sortie                        | baleine, 12 juillet 2026 10:00 |
| Places restantes avant l'annulation |                        0 |
| Places libérées par l'annulation    |                        1 |

## Résultat attendu, calculé à la main

| Grandeur                  | Valeur attendue | Calcul                        |
| ------------------------------ | ---------------: | ------------------------------------ |
| Places restantes après annulation |               1 | 0 + 1 place libérée                  |
| Badge « nouvelle place disponible »|              oui | créneau complet redevenu disponible   |

## Ce que ce cas ne vérifie pas

- le badge apparaissant suite à l'expiration d'un délai de paiement (déclencheur différent) → `CASE-DISP-04` ;
- le calcul du remboursement lié à l'annulation elle-même → `SPEC-CANCEL-CLIENT-01`, `SPEC-CANCEL-PRESTATAIRE-02` ;
- la disparition du badge après qu'une nouvelle réservation reprend la place (non couvert par un cas limite documenté).

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_03_badge_nouvelle_place_apres_annulation`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau complet (0 place restante).
- [ ] Le test simule une annulation libérant une place.
- [ ] Le test vérifie que le nombre de places restantes est mis à jour.
- [ ] Le test vérifie que le badge « nouvelle place disponible » est affiché.
- [ ] Le nom du test contient `CASE_DISP_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
