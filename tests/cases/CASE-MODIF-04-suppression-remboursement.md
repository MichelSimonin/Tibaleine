# CASE-MODIF-04 — Une suppression de participant suit le circuit du remboursement

**Statut :** remplacé

**Amendé par :** `CASE-MODIF-04-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-MODIF-04-A1`.

**Spécification :** `SPEC-MODIF-01`  
**Critère d'acceptation :** `AC-04`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la suppression d'un participant. Si la règle se casse, la
réservation est réduite sans rembourser le client.

## Cas

```gherkin
Étant donné une réservation payée de 3 personnes
Quand le patron supprime 1 participant
Alors la réservation compte 2 personnes
Et le remboursement est calculé selon les conditions d'annulation
```

## Données

| Élément | Valeur |
|---|---:|
| Réservation avant | 3 personnes |
| Suppression | 1 participant |
| Réservation après | 2 personnes |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Nombre de personnes après | 2 |
| Remboursement | selon les conditions d'annulation |

## Ce que ce cas ne vérifie pas

- le montant exact du remboursement → `SPEC-CANCEL-CLIENT-01` ;
- l'ajout d'un participant → `CASE-MODIF-03` (AC-03).

---

## Test automatisé

**Nom attendu :**
`test_CASE_MODIF_04_suppression_remboursement`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test supprime un participant et vérifie le total de 2.
- [ ] Le test vérifie qu'un remboursement est calculé.
- [ ] Le nom du test contient `CASE_MODIF_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
