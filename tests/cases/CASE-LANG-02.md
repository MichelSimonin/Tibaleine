# CASE-LANG-02 — Le message d'alerte/annulation est envoyé dans la langue du client

**Spécification :** `SPEC-LANG-01`  
**Critère d'acceptation :** `AC-02`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'envoi du message d'alerte ou d'annulation dans la langue du
client. Si la règle se casse, un client étranger reçoit le message en français
et ne comprend pas l'annulation.

## Cas

```gherkin
Étant donné un client anglophone avec une réservation
Et une annulation à lui notifier
Quand le message d'annulation est envoyé
Alors le message est envoyé en anglais
```

## Données

| Élément | Valeur |
|---|---:|
| Langue du client | anglais |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Langue du message envoyé | anglais |

## Ce que ce cas ne vérifie pas

- la langue de l'interface → `CASE-LANG-01` (AC-01) ;
- le contenu du message d'alerte (personnalisation, motifs) → `SPEC-ALERT-01` ;
- le mécanisme de détection de la langue du client (navigateur, compte).

---

## Test automatisé

**Nom attendu :**
`test_CASE_LANG_02_message_dans_langue_client`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test envoie un message à un client anglophone et vérifie qu'il est en anglais.
- [ ] Le nom du test contient `CASE_LANG_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
