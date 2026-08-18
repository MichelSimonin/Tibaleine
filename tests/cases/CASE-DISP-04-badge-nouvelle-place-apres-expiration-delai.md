# CASE-DISP-04 — Badge « nouvelle place disponible » après expiration du délai de paiement

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** `AC-03`
**Type :** acceptation
**Niveau de risque :** modéré

## Ce que ce cas protège

Ce cas protège l'affichage du badge « nouvelle place disponible » lorsqu'une
place bloquée temporairement (`SPEC-BOOK-03`) se libère parce que le client
n'a pas terminé sa réservation (paiement non effectué dans le délai). Si la
règle se casse, une place resterait affichée comme indisponible alors
qu'elle est en réalité libre.

## Cas

```gherkin
Étant donné une sortie dauphin le 20 août 2026 à 07:00, complète (0 place restante)
Et cette dernière place bloquée par un client ayant cliqué sur « Réserver »
Quand le délai de paiement de 15 minutes expire sans que le client ait payé
Alors le créneau affiche 1 place restante
Et le site affiche un badge « nouvelle place disponible » sur ce créneau
```

## Données

| Élément                          |                       Valeur |
| ------------------------------------ | -----------------------------: |
| Sortie                                |  dauphin, 20 août 2026 07:00 |
| Places restantes avant expiration       |                              0 |
| Délai de paiement                       |                       15 min |
| Réservation menée à terme (paiement)     |                           non |

## Résultat attendu, calculé à la main

| Grandeur                       | Valeur attendue | Calcul                         |
| ------------------------------------ | ---------------: | ------------------------------------- |
| Places restantes après expiration       |                1 | place libérée, faute de paiement       |
| Badge « nouvelle place disponible »      |              oui | créneau complet redevenu disponible    |

## Ce que ce cas ne vérifie pas

- le badge apparaissant suite à une annulation (déclencheur différent) → `CASE-DISP-03` ;
- le décompte de la place au moment du clic sur « Réserver » → `CASE-DISP-07` ;
- le mécanisme de blocage temporaire lui-même (durée, expiration) → `SPEC-BOOK-03`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_04_badge_nouvelle_place_apres_expiration_delai`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un créneau complet dont la dernière place est bloquée par un client.
- [ ] Le test simule l'expiration du délai de paiement de 15 minutes sans paiement.
- [ ] Le test vérifie que le nombre de places restantes remonte à 1.
- [ ] Le test vérifie que le badge « nouvelle place disponible » est affiché.
- [ ] Le nom du test contient `CASE_DISP_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
