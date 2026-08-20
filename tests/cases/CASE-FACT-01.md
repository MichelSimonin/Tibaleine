# CASE-FACT-01 — L'hôtel est facturé en fin de mois

**Amendé par :** `CASE-FACT-01-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-FACT-01-A1`.

**Spécification :** `SPEC-FACT-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le principe de facturation différée : les réservations d'un hôtel
ne sont pas payées une à une mais regroupées et facturées en fin de mois. Si la
règle se casse, l'hôtel serait facturé au moment de la réservation comme un
client particulier.

## Cas

```gherkin
Étant donné un hôtel partenaire avec 2 réservations actives sur le mois d'août 2026
Quand la fin du mois arrive
Alors le système regroupe les réservations de l'hôtel
Et génère une facture pour le total de ces réservations
Et la facture est adressée à l'hôtel
```

## Données

| Élément | Valeur |
|---|---:|
| Réservation 1 | sortie baleine, 4 adultes |
| Réservation 2 | sortie dauphin, 2 adultes |
| Total des réservations | 360 € |
| Moment de la facturation | fin du mois |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Total facturé | 360 € | (4 × 65 €) + (2 × 50 €) |
| Paiement au moment de la réservation | aucun | facturation différée |

## Ce que ce cas ne vérifie pas

- la remise de 15 % → `CASE-FACT-02` (AC-02) ;
- l'exclusion des réservations annulées → `CASE-FACT-03` (AC-03) ;
- la date exacte du paiement (avance ou retard, question ouverte) → `SPEC-FACT-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_FACT_01_facturation_hotel_en_fin_de_mois`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test regroupe plusieurs réservations d'un même hôtel.
- [ ] Le test vérifie que la facture est générée en fin de mois (et non à la réservation).
- [ ] Le test vérifie un total facturé de 360 €.
- [ ] Le nom du test contient `CASE_FACT_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
