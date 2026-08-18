# CASE-SYST-03 — Le client est informé en cas d'indisponibilité d'un service

**Spécification :** `SPEC-SYST-01`  
**Critère d'acceptation :** `AC-03`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'information du client lorsqu'un service externe est
indisponible. Si la règle se casse, le client tente une action qui échoue sans
explication.

## Cas

```gherkin
Étant donné un service de paiement indisponible
Quand un client tente de payer
Alors le client est informé que le service est indisponible
```

## Données

| Élément | Valeur |
|---|---:|
| Service en panne | paiement |
| Information du client | oui |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Message d'erreur adapté | oui |

## Ce que ce cas ne vérifie pas

- la détection de la panne → `CASE-SYST-01` (AC-01) ;
- le non-blocage de l'application → `CASE-SYST-02` (AC-02).

---

## Test automatisé

**Nom attendu :**
`test_CASE_SYST_03_client_informe_indisponibilite_service`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule un service de paiement en panne.
- [ ] Le test vérifie que le client reçoit un message d'information adapté.
- [ ] Le nom du test contient `CASE_SYST_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
