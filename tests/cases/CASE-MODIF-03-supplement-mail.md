# CASE-MODIF-03 — Un ajout de participant entraîne un supplément payé par mail

**Spécification :** `SPEC-MODIF-01`  
**Critère d'acceptation :** `AC-03`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège le paiement du supplément après ajout d'un participant. Si la
règle se casse, l'ajout est fait sans encaisser le supplément.

## Cas

```gherkin
Étant donné une réservation payée
Quand le patron ajoute 1 participant (demande faite plus de 2 h avant le départ)
Alors un supplément est dû
Et un mail avec le lien de paiement du supplément est envoyé au client
```

## Données

| Élément | Valeur |
|---|---:|
| Ajout | 1 participant |
| Supplément dû | oui |
| Canal du lien de paiement | mail |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Supplément dû | oui |
| Mail de paiement envoyé | oui |

## Ce que ce cas ne vérifie pas

- l'ajout à moins de 2 h du départ → cas limite 1 (modification refusée) ;
- la suppression d'un participant → `CASE-MODIF-04` (AC-04) ;
- l'encaissement effectif du supplément → `SPEC-PAY-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_MODIF_03_supplement_mail`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test ajoute un participant et vérifie qu'un supplément est dû.
- [ ] Le test vérifie qu'un mail de paiement est envoyé.
- [ ] Le nom du test contient `CASE_MODIF_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
