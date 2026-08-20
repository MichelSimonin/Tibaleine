# CASE-DISP-06 — Un créneau à moins de 2h du départ est affiché indisponible

**Statut :** applicable
**Nom attendu :** `test_CASE_DISP_06`

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** — (cas limite 4, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'affichage d'un créneau comme indisponible dès lors qu'il
est à moins de 2 heures du départ, même s'il reste des places libres. Si la
règle se casse, un client pourrait voir un créneau comme réservable alors
que la réservation sera de toute façon bloquée (incohérence d'affichage) ou,
pire, réussir à réserver un créneau trop proche du départ.

## Cas

```gherkin
Étant donné une sortie baleine le 12 juillet 2026 à 10:00 avec 3 places restantes
Et qu'il est actuellement 12 juillet 2026 à 09:00 (1 h avant le départ)
Quand un client consulte le calendrier
Alors le créneau est affiché comme indisponible
Et la réservation est bloquée pour ce créneau
```

## Données

| Élément            |                       Valeur |
| ---------------------- | -----------------------------: |
| Sortie                  | baleine, 12 juillet 2026 10:00 |
| Places restantes         |                              3 |
| Heure de consultation     |     12 juillet 2026 à 09:00 |
| Délai avant le départ      |                       1 heure |

## Résultat attendu, calculé à la main

| Grandeur       | Valeur attendue | Calcul                      |
| ------------------ | ---------------: | ---------------------------------- |
| Statut affiché         |     indisponible | délai avant départ < 2 h             |
| Réservation possible     |               non | délai avant départ < 2 h             |

## Ce que ce cas ne vérifie pas

- l'affichage d'un créneau complet (0 place) → `CASE-DISP-02` ;
- l'affichage d'un créneau disponible avec un délai suffisant → `CASE-DISP-01` ;
- le blocage de la réservation lui-même au niveau du formulaire → `SPEC-BOOK-01` (cas limite 2).

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_06_creneau_moins_2h_indisponible`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau avec des places restantes, à moins de 2 h du départ.
- [ ] Le test consulte le calendrier en tant que client à cet instant.
- [ ] Le test vérifie que le créneau est affiché comme indisponible malgré les places restantes.
- [ ] Le test vérifie qu'une tentative de réservation sur ce créneau est bloquée.
- [ ] Le nom du test contient `CASE_DISP_06`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-DISP-01` —
il matérialise le « cas limite 4 » de cette spec (ligne 45), qui n'a pas de
critère d'acceptation dédié.
