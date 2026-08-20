# CASE-ALERT-03 — Message d'avertissement personnalisé et bilingue (FR/EN)

**Statut :** applicable
**Nom attendu :** `test_CASE_ALERT_03`

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** `AC-04`
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la personnalisation du message par l'administrateur et sa
disponibilité en français et en anglais. Si la règle se casse, un client
non francophone pourrait recevoir un message incompréhensible, ou
l'administrateur ne pourrait pas préciser la raison de l'annulation dans le
message envoyé.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00
Et un client francophone et un client anglophone réservés sur ce créneau
Et un risque de mauvaises conditions météo
Quand l'administrateur personnalise le message (raison : « risque de forte houle »)
et déclenche l'envoi le 11 juillet 2026 à 18:00
Alors le client francophone reçoit le message personnalisé en français
Et le client anglophone reçoit le même message personnalisé en anglais
```

## Données

| Élément                    |                            Valeur |
| ----------------------------- | ----------------------------------: |
| Sortie concernée              |            12 juillet 2026 à 10:00 |
| Message personnalisé          |     « risque de forte houle »       |
| Client 1 — langue             |                           français |
| Client 2 — langue             |                            anglais |
| Avertissement envoyé          |            11 juillet 2026 à 18:00 |

## Résultat attendu, calculé à la main

| Grandeur                                    | Valeur attendue                        | Calcul                        |
| ---------------------------------------------- | ----------------------------------------- | -------------------------------- |
| Message reçu par le client francophone          | personnalisé, en français                 | langue du client 1                |
| Message reçu par le client anglophone           | personnalisé (traduit), en anglais        | langue du client 2                |

## Ce que ce cas ne vérifie pas

- la qualité ou le mécanisme de traduction lui-même (automatique ou manuel) ;
- l'envoi d'un avertissement non personnalisé (message par défaut) → `CASE-ALERT-01` ;
- l'alerte affichée sur le site (AC-3) → `CASE-ALERT-02` ;
- l'annulation définitive et sa notification (AC-5) → `CASE-ALERT-04`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_03_message_personnalise_et_bilingue`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test personnalise le message avant l'envoi.
- [ ] Le test vérifie que le client francophone reçoit le message en français.
- [ ] Le test vérifie que le client anglophone reçoit le message en anglais.
- [ ] Le test vérifie que le contenu personnalisé est présent dans les deux versions.
- [ ] Le nom du test contient `CASE_ALERT_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** La détermination de la langue d'un client n'est pas définie
dans le MCD V2 (aucun attribut « langue » porté par le client — signalé dans
la Revue IA de `SPEC-LANG-01`). Ce cas suppose que la langue du client est
connue au moment de l'envoi ; il ne pourra pas être automatisé tel quel tant
que ce point n'est pas tranché (sélecteur explicite, langue du navigateur, ou
autre source).
