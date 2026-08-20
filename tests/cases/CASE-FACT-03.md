# CASE-FACT-03 — Les réservations annulées ne sont pas comptabilisées

**Spécifications :** `SPEC-FACT-01-A1`, `SPEC-CANCEL-PRESTATAIRE-02-A1`
**Critères d'acceptation :** `SPEC-FACT-01-A1/AC-1`, `SPEC-CANCEL-PRESTATAIRE-02-A1/AC-6`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'exclusion des réservations annulées de la facture de fin de
mois. Si la règle se casse, l'hôtel serait facturé pour des places annulées à
cause de la météo.

## Cas

```gherkin
Étant donné un hôtel avec 2 réservations actives (360 €) et 1 réservation annulée à cause de la météo (130 €)
Quand la facture de fin de mois est établie
Alors la réservation annulée n'est pas comptabilisée
Et l'hôtel est facturé sur les seules réservations actives (360 €)
```

## Données

| Élément | Valeur |
|---|---:|
| Réservations actives | 2 (360 €) |
| Réservation annulée (météo) | 1 (130 €) |
| Total si tout compté | 490 € |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Montant facturé | 360 € | 360 € + 0 € (annulée exclue) |
| Réservation annulée comptabilisée | non | état « annulée » |

## Ce que ce cas ne vérifie pas

- le regroupement en fin de mois → `CASE-FACT-01` (AC-01) ;
- la remise de 15 % → `CASE-FACT-02` (AC-02) ;
- le processus d'annulation météo lui-même → `SPEC-CANCEL-PRESTATAIRE-02-A1`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_FACT_03_reservation_annulee_non_comptabilisee`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée 2 réservations actives et 1 annulée.
- [ ] Le test vérifie que la réservation annulée n'est pas comptabilisée.
- [ ] Le test vérifie un montant facturé de 360 € (et non 490 €).
- [ ] Le nom du test contient `CASE_FACT_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
