# CASE-COMM-01 — Le site affiche un lien vers Facebook

**Spécification :** `SPEC-COMM-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** faible

## Ce que ce cas protège

Ce cas protège l'affichage d'un lien vers Facebook. Si la règle se casse, le
visiteur ne peut pas accéder à la page Facebook de l'entreprise.

## Cas

```gherkin
Étant donné le site de l'entreprise
Quand un visiteur consulte une page
Alors il voit un lien vers Facebook
```

## Données

| Élément | Valeur |
|---|---:|
| Réseau social | Facebook |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Lien Facebook affiché | oui |

## Ce que ce cas ne vérifie pas

- le lien vers Instagram → `CASE-COMM-02` (AC-02) ;
- l'ouverture effective du lien (gérée par le navigateur).

---

## Test automatisé

**Nom attendu :**
`test_CASE_COMM_01_lien_facebook`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie qu'un lien vers Facebook est affiché.
- [ ] Le nom du test contient `CASE_COMM_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
