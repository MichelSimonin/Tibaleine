# CASE-PAY-02 — La réservation passe à l'état « payée » après paiement

**Statut :** remplacé

**Amendé par :** `CASE-PAY-02-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-PAY-02-A1`.

**Spécification :** `SPEC-PAY-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le changement d'état de la réservation après paiement. Si la
règle se casse, une réservation payée n'est pas correctement marquée « payée », ce qui fausse
le suivi et le décompte des places.

## Cas

```gherkin
Étant donné une réservation
Quand le client paie en ligne
Alors la réservation passe à l'état « payée »
```

## Données

| Élément | Valeur |
|---|---:|
| État avant paiement | non payée |
| État après paiement | payée |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| État final de la réservation | payée |

## Ce que ce cas ne vérifie pas

- l'enregistrement du paiement lui-même → `CASE-PAY-01` (AC-01) ;
- la mise à jour des places → `CASE-PAY-03` (AC-03) ;
- la libération après 15 min → `CASE-PAY-04` (AC-04).

---

## Test automatisé

**Nom attendu :**
`test_CASE_PAY_02_reservation_passe_etat_payee`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test paie une réservation.
- [ ] Le test vérifie le passage à l'état « payée ».
- [ ] Le nom du test contient `CASE_PAY_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
