# CASE-PAY-05 — Le paiement échoue (carte refusée ou service indisponible)

**Spécification :** `SPEC-PAY-01`  
**Critère d'acceptation :** `AC-05`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le comportement en cas d'échec du paiement. Si la règle se casse,
une réservation dont le paiement a échoué serait marquée « payée », ce qui fausse
le suivi et le décompte des places.

## Cas

```gherkin
Étant donné une réservation d'un montant de 260 €
Quand le client tente de payer en ligne et que la carte est refusée
Alors le paiement n'est pas enregistré
Et la réservation n'est pas marquée « payée »
Et le client est invité à réessayer
```

## Données

| Élément | Valeur |
|---|---:|
| Montant de la réservation | 260 € |
| Issue de la tentative | carte refusée |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Paiement enregistré | non |
| Statut de la réservation | non payée |
| Invitation à réessayer | oui |

## Ce que ce cas ne vérifie pas

- le paiement réussi → `CASE-PAY-01` (AC-01) ;
- le passage à l'état « payée » → `CASE-PAY-02` (AC-02) ;
- la libération des places après 15 min → `CASE-PAY-04` (AC-04) ;
- la panne du service de paiement externe (indisponibilité), au même comportement attendu.

---

## Test automatisé

**Nom attendu :**
`test_CASE_PAY_05_paiement_refuse`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule un refus de carte et vérifie que le paiement n'est pas enregistré.
- [ ] Le test vérifie que la réservation n'est pas marquée « payée ».
- [ ] Le test vérifie que le client est invité à réessayer.
- [ ] Le nom du test contient `CASE_PAY_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
