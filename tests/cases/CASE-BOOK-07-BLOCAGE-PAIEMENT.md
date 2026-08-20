# CASE-BOOK-07— La place est libérée si le paiement n'est pas fait sous 15 minutes. 

**Statut :** remplacé

**Amendé par :** `CASE-BOOK-07-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-BOOK-07-A1`.

**Spécification :** `SPEC-BOOK-03`  
**Critère d'acceptation :** `AC-02` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège déblocage de toutes les places voulues par le client lors du paiement. Si la règle se casse, les places resterons indisponibles aux autres clients même si le premier client abandonne son processus de paiement et de réservation.


## Cas

```gherkin
Étant donné, à 17h45 client A veut réserver pour le créneau du 22 août à 10h. Il veut prendre les deux dernières places et clic sur "Réserver".
Il bloque les deux dernières places pendant 15 minutes.
Il remplis son formulaire et clic sur "Payer" à 17h50.
Le blocage recommence pour 15 min.
Client B arrive sur le site à 18h03 et voit ce créneau comme "complet". 
Client A change d'avis et abandonne le paiement et sa réservation.
Client B revient sur le site à 18h10 et voit le créneau avec 2 places disponibles.
Il peut cliquer sur le créneau afin de commencer le processus de réservation.


```

## Données

| Élément | Valeur |
|---|---:|
| Date choisis | 22 Août 2026 à 07:00 |
| Nombre de places voulu | 2 places |
| Nombre de places disponibles | 2 places |
| Heure de début de blocage formulaire | 17:45 | 
| Durée de blocage formulaire | 15 minutes |
| Heure de début de blocage paiement | 17:50 | 
| Durée de blocage paiement | 15 minutes |
| Fin de blocage | 18:05 |



## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Nombre de places disponible entre 17:45 et 17:50 | 0 places (2 places dispo - 2 places choisies)  |
| Nombre de places disponible entre 17:50 18:05 | 0 places (2 places dispo - 2 places choisies)  |
| Nombre de places disponible après 18:05 | 2 places (2 places dispos - 0 places choisies) |

## Ce que ce cas ne vérifie pas

- Le blocage des places pendant la completion du formulaire
- Gestion de requête simultanée

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_07_blocage_paiement`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie le nombre de place disponible pour l'activité avant blocage.
- [ ] Le test vérifie le nombre de place choisis par le client.
- [ ] Le test vérifie l'heure de fin de blocage/temps de blocage.
- [ ] Le test vérifie que le temps de blocage se remet à 15 min si le client valide le formulaire dans les temps.
- [ ] Le test vérifie que les places bloqués sont pris en compte dans le comptage des places disponibles jusqu'à la fin du blocage.
- [ ] Le test échoue si le nombre de place disponible ne se met pas à jour alors qu'un blocage est actif.
- [ ] Le nom du test contient `CASE_BOOK_07`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
