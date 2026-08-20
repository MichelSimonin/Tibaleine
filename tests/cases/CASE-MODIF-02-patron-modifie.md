# CASE-MODIF-02 — Le patron modifie une réservation payée

**Amendé par :** `CASE-MODIF-02-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-MODIF-02-A1`.

**Spécification :** `SPEC-MODIF-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'application de la modification par le patron. Si la règle se
casse, la demande du client n'est jamais reportée dans la réservation.

## Cas

```gherkin
Étant donné une réservation payée de 2 personnes
Quand le client a demandé par téléphone d'ajouter 1 personne
Alors le patron modifie la réservation
Et la réservation compte désormais 3 personnes
```

## Données

| Élément | Valeur |
|---|---:|
| Réservation avant | 2 personnes |
| Ajout demandé | 1 personne |
| Réservation après | 3 personnes |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Nombre de personnes après modification | 3 |

## Ce que ce cas ne vérifie pas

- le paiement du supplément lié à l'ajout → `CASE-MODIF-03` (AC-03) ;
- la suppression d'un participant → `CASE-MODIF-04` (AC-04).

---

## Test automatisé

**Nom attendu :**
`test_CASE_MODIF_02_patron_modifie_reservation`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test applique un ajout de 1 personne et vérifie le total de 3.
- [ ] Le nom du test contient `CASE_MODIF_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
