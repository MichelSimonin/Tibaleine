# CASE-DISP-02 — Un créneau complet est affiché comme indisponible

**Statut :** applicable
**Nom attendu :** `test_CASE_DISP_02`

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** `AC-02`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'affichage d'un créneau complet comme indisponible, et le
blocage de la réservation qui en découle. Si la règle se casse, un client
pourrait tenter de réserver un créneau déjà complet, dépassant la capacité
du bateau.

## Cas

```gherkin
Étant donné une sortie dauphin le 20 août 2026 à 07:00 avec 0 place restante
Quand un client consulte le calendrier
Alors le créneau est affiché comme indisponible
Et la réservation est bloquée pour ce créneau
```

## Données

| Élément            |                       Valeur |
| ---------------------- | -----------------------------: |
| Sortie                  |  dauphin, 20 août 2026 07:00 |
| Places restantes         |                              0 |

## Résultat attendu, calculé à la main

| Grandeur       | Valeur attendue | Calcul                  |
| ------------------ | ---------------: | ------------------------------ |
| Statut affiché        |     indisponible | places restantes = 0            |
| Réservation possible    |               non | créneau complet                 |

## Ce que ce cas ne vérifie pas

- l'affichage d'un créneau disponible → `CASE-DISP-01` ;
- l'apparition du badge « nouvelle place disponible » lorsque ce créneau se libère → `CASE-DISP-03`, `CASE-DISP-04` ;
- l'affichage d'un créneau à moins de 2 h du départ (indisponible pour une autre raison) → `CASE-DISP-06`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_02_creneau_complet_indisponible`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau à 0 place restante.
- [ ] Le test consulte le calendrier en tant que client.
- [ ] Le test vérifie que le créneau est affiché comme indisponible.
- [ ] Le test vérifie qu'une tentative de réservation sur ce créneau est bloquée.
- [ ] Le nom du test contient `CASE_DISP_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
