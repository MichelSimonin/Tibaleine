# CASE-HOTEL-03 — L'hôtel consulte ses réservations

**Amendé par :** `CASE-HOTEL-03-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-HOTEL-03-A1`.

**Spécification :** `SPEC-HOTEL-01`  
**Critère d'acceptation :** `AC-03`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'accès de l'hôtel à la consultation de ses propres réservations.
Si la règle se casse, l'hôtel ne peut pas vérifier ses réservations passées et à
venir.

## Cas

```gherkin
Étant donné un hôtel connecté avec 2 réservations liées à son compte
Quand l'hôtel consulte ses réservations
Alors il voit uniquement les 2 réservations liées à son compte
```

## Données

| Élément | Valeur |
|---|---:|
| Réservations de l'hôtel | 2 |
| Réservations d'autres clients | non affichées |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Réservations affichées | 2 (les siennes) |
| Réservations étrangères affichées | 0 |

## Ce que ce cas ne vérifie pas

- la création du compte hôtel → `CASE-HOTEL-01` (AC-01) ;
- la consultation des créneaux → `CASE-HOTEL-02` (AC-02) ;
- la facturation fin de mois → `SPEC-FACT-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_HOTEL_03_consultation_reservations_hotel`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test connecte un hôtel avec 2 réservations.
- [ ] Le test vérifie que seules ses réservations sont affichées.
- [ ] Le nom du test contient `CASE_HOTEL_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
