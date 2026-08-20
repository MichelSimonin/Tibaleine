# CASE-MODIF-01 — La demande de modification s'effectue par téléphone

**Statut :** applicable
**Nom attendu :** `test_CASE_MODIF_01`

**Spécification :** `SPEC-MODIF-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège le canal de la demande de modification. Si la règle se casse, le
client modifie sa réservation en ligne sans passer par le patron.

## Cas

```gherkin
Étant donné un client avec une réservation payée de 2 personnes
Quand il souhaite ajouter 1 personne
Alors il contacte le patron par téléphone pour formuler sa demande
```

## Données

| Élément | Valeur |
|---|---:|
| Réservation | payée, 2 personnes |
| Canal de la demande | téléphone |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Canal de la demande | téléphone |

## Ce que ce cas ne vérifie pas

- l'application effective de la modification → `CASE-MODIF-02` (AC-02) ;
- le paiement du supplément → `CASE-MODIF-03` (AC-03).

---

## Test automatisé

**Nom attendu :**
`test_CASE_MODIF_01_demande_par_telephone`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie que la demande passe par téléphone.
- [ ] Le nom du test contient `CASE_MODIF_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
