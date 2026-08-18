# CASE-COMM-02 — Le site affiche un lien vers Instagram

**Spécification :** `SPEC-COMM-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** faible

## Ce que ce cas protège

Ce cas protège l'affichage d'un lien vers Instagram. Si la règle se casse, le
visiteur ne peut pas accéder à la page Instagram de l'entreprise.

## Cas

```gherkin
Étant donné le site de l'entreprise
Quand un visiteur consulte une page
Alors il voit un lien vers Instagram
```

## Données

| Élément | Valeur |
|---|---:|
| Réseau social | Instagram |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Lien Instagram affiché | oui |

## Ce que ce cas ne vérifie pas

- le lien vers Facebook → `CASE-COMM-01` (AC-01) ;
- l'ouverture effective du lien (gérée par le navigateur).

---

## Test automatisé

**Nom attendu :**
`test_CASE_COMM_02_lien_instagram`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie qu'un lien vers Instagram est affiché.
- [ ] Le nom du test contient `CASE_COMM_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
