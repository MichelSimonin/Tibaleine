# CASE-LANG-01 — L'interface est disponible en français et en anglais

**Statut :** applicable
**Nom attendu :** `test_CASE_LANG_01`

**Spécification :** `SPEC-LANG-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** faible

## Ce que ce cas protège

Ce cas protège la disponibilité de l'interface en français et en anglais. Si la
règle se casse, un client anglophone ne peut pas utiliser le site.

## Cas

```gherkin
Étant donné un visiteur dont le navigateur est en anglais
Quand il consulte le site
Alors l'interface s'affiche en anglais
```

## Données

| Élément | Valeur |
|---|---:|
| Langue du navigateur | anglais |
| Langues disponibles | français, anglais |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Langue d'affichage | anglais |

## Ce que ce cas ne vérifie pas

- la langue des messages d'alerte/annulation → `CASE-LANG-02` (AC-02) ;
- le mécanisme de sélection de la langue (sélecteur / navigateur) → question ouverte `SPEC-LANG-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_LANG_01_interface_francais_anglais`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test affiche l'interface en anglais pour un navigateur anglais.
- [ ] Le test affiche l'interface en français pour un navigateur français.
- [ ] Le nom du test contient `CASE_LANG_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
