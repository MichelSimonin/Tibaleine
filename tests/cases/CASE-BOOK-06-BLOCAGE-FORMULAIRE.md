# CASE-BOOK-06 — Le blocage temporaire des places pendant la saisie du formulaire 

**Statut :** applicable
**Nom attendu :** `test_CASE_BOOK_06`

**Spécification :** `SPEC-BOOK-03-A1`
**Critère d'acceptation :** `AC-1`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la mise à jour des places disponibles pendant qu'un client bloque des places lorsqu'il remplit un formulaire de réservation . Si la règle se casse, le nombre de places disponibles ne changera pas, résultant en plusieurs clients réservant les même places.

## Cas

```gherkin
Étant donné un créneau avec deux places restantes
Quand le client A ouvre le formulaire à 17h45 pour ces deux places
Alors les deux places sont bloquées jusqu'à 18h00
Et le client B voit le créneau comme complet pendant ce délai
Quand le délai expire sans passage au paiement
Alors les deux places redeviennent disponibles


```

## Données

| Élément | Valeur |
|---|---:|
| Date choisis | 22 Août 2026 à 07:00 |
| Nombre de places voulu | 2 places |
| Nombre de places disponibles | 2 places |
| Heure de début de blocage | 17:45 | 
| Durée de blocage | 15 minutes |
| Fin de blocage | 18:00 |



## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Nombre de places disponible entre 17:45 et 18:00 | 0 places (2 places dispo - 2 places choisies)  |
| Nombre de places disponible après 18:00 | 2 places (2 places dispos - 0 places choisies) |

## Ce que ce cas ne vérifie pas

- Le blocage des places pendant le paiement

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_06_blocage_place_formulaire`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie le nombre de place disponible pour l'activité avant blocage.
- [ ] Le test vérifie le nombre de place choisis par le client.
- [ ] Le test vérifie l'heure de fin de blocage.
- [ ] Le test vérifie que les places bloqués sont pris en compte dans le comptage des places disponibles jusqu'à la fin du blocage.
- [ ] Le test échoue si le nombre de place disponible ne se met pas à jour alors qu'un blocage est actif.
- [ ] Le nom du test contient `CASE_BOOK_06`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
