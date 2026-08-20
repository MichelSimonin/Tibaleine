# CASE-BOOK-05— L'hôtel ne peut pas réserver plus de 6 places sur un même créneau. 

**Statut :** applicable
**Nom attendu :** `test_CASE_BOOK_05_hotel_limite_6`

**Spécification :** `SPEC-BOOK-02-A1`
**Critère d'acceptation :** `AC-4`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la limite de 6 places par créneau pouvant être réserver par l'hôtel. Si la règle se casse, l'hôtel pourra réserver plus de place qui lui est accordé, résultant en un avantage sur la réservation par rapport aux autre clients.

## Cas

```gherkin
Étant donné un utilisateur ayant le rôle `hotel`
Et un créneau disposant de 36 places le 19 août 2026 à 14h
Quand il demande 36 places sur ce créneau
Alors la réservation est refusée car la limite est de 6 places
Et le nombre de places disponibles reste égal à 36
Et un message explique que la limite autorisée est dépassée


```

## Données

| Élément | Valeur |
|---|---:|
| Date choisis | 19 Août 2026 à 14:00 |
| Nombre de places voulu | 36 places |
| Nombre de places disponibles | 36 places |


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Statut de la réservation | La réservation n'est pas crée | résultat du blocage du au dépassement de la limite de 6 places maximum|
| Nombre de places disponible après réservation | 36 => La réservation n'a pas eu lieu |

## Ce que ce cas ne vérifie pas

- La possibilité pour l'hôtel de réserver plusieurs créneaux à la fois
- La mise à jour des places disponibles après une réservation
- La réservation d'un particulier

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_05_hotel_limite_6`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie le nombre de place disponible pour l'activité.
- [ ] Le test vérifie le nombre de place choisis par l'hôtel.
- [ ] Le test vérifie que le résultat de la soustraction du nombre de place disponible par le nombre de place choisis soit positif.
- [ ] Le test vérifie que le nombre de place choisis par l'hôtel soit <=6.
- [ ] Le test échoue la soustraction du nombre de place disponible par le nombre de place choisis est négatif.
- [ ] Le test échoue si une réservation passe avec un nombre de place >6.
- [ ] Le nom du test contient `CASE_BOOK_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
