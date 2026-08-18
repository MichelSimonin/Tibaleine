# CASE-BOOK-06— L'hôtel ne peut pas réserver plus de 6 places sur un même créneau. 

**Spécification :** `SPEC-BOOK-03`  
**Critère d'acceptation :** `AC-01`, `AC-03` (par extension) 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la mise à jour des places disponibles pendant qu'un client bloque des places lorsqu'il remplit un formulaire de réservation . Si la règle se casse, le nombre de places disponibles ne changera pas, résultant en plusieurs clients réservant les même places.

## Cas

```gherkin
Étant donné, à 17h45 client A veut réserver pour le créneau du 22 août à 7h. Il veut prendre les deux dernières places et clic sur "Réserver".
Il bloque les deux dernières places pendant 15 minutes.
Client B arrive sur le site à 17h46 et voit ce créneau comme "complet". 
Client A change d'avis et abandonne sa réservation.
Client B revient sur le site à 18h et voit le créneau avec 2 places disponibles.


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
| Nombre de places disponible avant 18:00 | 0 places (2 places dispo - 2 places choisies)  |
| Nombre de places disponible après 18:00 | 2 places (2 places dispos - 0 places choisies) |

## Ce que ce cas ne vérifie pas

- Le blocage des places pendant le paiement

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_06_blocage_place_formulaire
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
