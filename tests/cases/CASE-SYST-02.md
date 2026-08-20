# CASE-SYST-02 — Une panne d'un service externe ne bloque pas l'application

**Statut :** applicable
**Nom attendu :** `test_CASE_SYST_02`

**Spécification :** `SPEC-SYST-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la résilience de l'application face à une panne d'un service
externe. Si la règle se casse, une panne de SMS/email/paiement bloque toute
l'application.

## Cas

```gherkin
Étant donné un service SMS indisponible
Quand un avertissement ou une annulation doit être envoyé
Alors l'application reste fonctionnelle
Et l'indisponibilité est gérée sans panne
```

## Données

| Élément | Valeur |
|---|---:|
| Service en panne | SMS |
| Application fonctionnelle | oui |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Application bloquée | non |
| Erreur non gérée | aucune |

## Ce que ce cas ne vérifie pas

- la détection de la panne → `CASE-SYST-01` (AC-01) ;
- l'information du client → `CASE-SYST-03` (AC-03) ;
- le comportement exact en cas de panne SMS/email (report, mail, perte) → question ouverte `SPEC-SYST-01`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_SYST_02_panne_service_externe_ne_bloque_pas`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule un service SMS en panne.
- [ ] Le test vérifie que l'application reste fonctionnelle.
- [ ] Le nom du test contient `CASE_SYST_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
