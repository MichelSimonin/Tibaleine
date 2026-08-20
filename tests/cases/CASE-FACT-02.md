# CASE-FACT-02 — Remise de 15 % sur la facture hôtel

**Statut :** applicable
**Nom attendu :** `test_CASE_FACT_02_remise_15_pourcent_hotel`

**Spécification :** `SPEC-FACT-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la remise de 15 % accordée à l'hôtel sur le total facturé en fin
de mois. Si la règle se casse, l'hôtel serait facturé au prix plein.

## Cas

```gherkin
Étant donné un hôtel partenaire avec un total de réservations de 360 € sur le mois
Quand la facture de fin de mois est établie
Alors une remise de 15 % est appliquée
Et le montant dû par l'hôtel est de 306 €
```

## Données

| Élément | Valeur |
|---|---:|
| Total des réservations | 360 € |
| Remise hôtel | 15 % |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Remise | 54 € | 360 € × 15 % |
| Montant dû | 306 € | 360 € − 54 € |

## Ce que ce cas ne vérifie pas

- le regroupement des réservations en fin de mois → `CASE-FACT-01` (AC-01) ;
- l'exclusion des réservations annulées → `CASE-FACT-03` (AC-03).

---

## Test automatisé

**Nom attendu :**
`test_CASE_FACT_02_remise_15_pourcent_hotel`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend un total de 360 €.
- [ ] Le test vérifie une remise de 15 %.
- [ ] Le test vérifie un montant dû de 306 €.
- [ ] Le test échoue si la remise de 15 % est volontairement supprimée du code.
- [ ] Le nom du test contient `CASE_FACT_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
