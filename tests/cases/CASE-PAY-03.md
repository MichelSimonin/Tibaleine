# CASE-PAY-03 — Les places sont mises à jour après le paiement

**Amendé par :** `CASE-PAY-03-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-PAY-03-A1`.

**Spécification :** `SPEC-PAY-01`  
**Critère d'acceptation :** `AC-03`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le décompte des places après paiement. Si la règle se casse, un
créneau peut être sur-réservé (les places payées ne sont pas retirées de la
capacité).

## Cas

```gherkin
Étant donné un créneau avec 4 places restantes
Quand une réservation de 2 personnes est payée
Alors le nombre de places restantes passe à 2
```

## Données

| Élément | Valeur |
|---|---:|
| Places avant paiement | 4 |
| Personnes payées | 2 |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Places restantes | 2 | 4 − 2 |

## Ce que ce cas ne vérifie pas

- l'enregistrement du paiement → `CASE-PAY-01` (AC-01) ;
- le passage à l'état « payée » → `CASE-PAY-02` (AC-02) ;
- la libération après 15 min → `CASE-PAY-04` (AC-04).

---

## Test automatisé

**Nom attendu :**
`test_CASE_PAY_03_places_mises_a_jour_apres_paiement`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test paie 2 places sur un créneau de 4.
- [ ] Le test vérifie qu'il reste 2 places.
- [ ] Le nom du test contient `CASE_PAY_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
