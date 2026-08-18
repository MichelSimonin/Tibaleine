# CASE-SYST-01 — Le système détecte l'indisponibilité d'un service externe

**Spécification :** `SPEC-SYST-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la détection d'une panne d'un service externe (paiement, SMS,
email). Si la règle se casse, l'application tente d'utiliser un service en panne
sans le savoir.

## Cas

```gherkin
Étant donné un service de paiement indisponible
Quand le système vérifie la disponibilité des services externes
Alors le système détecte que le service de paiement est indisponible
```

## Données

| Élément | Valeur |
|---|---:|
| Service externe | paiement |
| État du service | indisponible |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Détection | indisponible |

## Ce que ce cas ne vérifie pas

- le non-blocage de l'application → `CASE-SYST-02` (AC-02) ;
- l'information du client → `CASE-SYST-03` (AC-03) ;
- le mécanisme exact de détection (healthcheck) → question ouverte `SPEC-SYST-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_SYST_01_detection_service_externe_indisponible`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule un service externe indisponible.
- [ ] Le test vérifie que le système détecte l'indisponibilité.
- [ ] Le nom du test contient `CASE_SYST_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
