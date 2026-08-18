# CASE-HOTEL-02 — L'hôtel consulte les créneaux disponibles

**Spécification :** `SPEC-HOTEL-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'accès de l'hôtel à la consultation des créneaux disponibles. Si
la règle se casse, l'hôtel ne peut pas voir les créneaux à proposer à ses
clients.

## Cas

```gherkin
Étant donné un hôtel connecté
Et une sortie baleine le 21 août 2026 à 10h avec 6 places restantes
Quand l'hôtel consulte les créneaux disponibles
Alors il voit la sortie baleine du 21 août avec 6 places restantes
```

## Données

| Élément | Valeur |
|---|---:|
| Créneau | 21 août 2026 à 10h, baleine |
| Places restantes | 6 |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Créneau affiché | oui |
| Places restantes affichées | 6 |

## Ce que ce cas ne vérifie pas

- la création du compte hôtel → `CASE-HOTEL-01` (AC-01) ;
- la consultation des réservations → `CASE-HOTEL-03` (AC-03) ;
- la réservation effective de places → `SPEC-BOOK-02`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_HOTEL_02_consultation_creneaux_hotel`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un hôtel.
- [ ] Le test vérifie l'affichage du créneau avec le nombre de places restantes.
- [ ] Le nom du test contient `CASE_HOTEL_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
