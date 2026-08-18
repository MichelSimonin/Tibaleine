# CASE-LANG-02 — Les messages d'alerte et d'annulation en français et en anglais

**Spécification :** `SPEC-LANG-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la disponibilité des messages d'alerte et d'annulation en français
et en anglais. Si la règle se casse, un client étranger ne comprend pas le
message d'annulation.

## Cas

```gherkin
Étant donné un avertissement ou une annulation à envoyer aux clients
Quand le message est envoyé
Alors le message est disponible en français
Et le message est disponible en anglais
```

## Données

| Élément | Valeur |
|---|---:|
| Langues du message | français, anglais |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Message FR disponible | oui |
| Message EN disponible | oui |

## Ce que ce cas ne vérifie pas

- la langue de l'interface → `CASE-LANG-01` (AC-01) ;
- le contenu du message d'alerte (personnalisation, motifs) → `SPEC-ALERT-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_LANG_02_messages_alerte_annulation_francais_anglais`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie qu'un message d'alerte est disponible en français et en anglais.
- [ ] Le test vérifie qu'un message d'annulation est disponible en français et en anglais.
- [ ] Le nom du test contient `CASE_LANG_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
