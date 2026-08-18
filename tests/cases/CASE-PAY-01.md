# CASE-PAY-01 — Le client paie sa réservation en ligne

**Spécification :** `SPEC-PAY-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le paiement en ligne d'une réservation. Si la règle se
casse, le client ne peut pas payer en ligne (alors que le paiement sur place est
exclu du périmètre).

## Cas

```gherkin
Étant donné une réservation d'un montant de 260 €
Quand le client paie en ligne
Alors le paiement est enregistré
```

## Données

| Élément | Valeur |
|---|---:|
| Montant de la réservation | 260 € |
| Canal de paiement | en ligne |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Paiement enregistré | 260 € |

## Ce que ce cas ne vérifie pas

- le passage à l'état « payée » → `CASE-PAY-02` (AC-02) ;
- la mise à jour des places → `CASE-PAY-03` (AC-03) ;
- la libération après 15 min sans paiement → `CASE-PAY-04` (AC-04).

---

## Test automatisé

**Nom attendu :**
`test_CASE_PAY_01_paiement_en_ligne`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test paie une réservation en ligne.
- [ ] Le test vérifie l'enregistrement du paiement de 260 €.
- [ ] Le nom du test contient `CASE_PAY_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
