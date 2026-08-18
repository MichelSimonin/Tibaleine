# CASE-BOOK-02 — L'hôtel réserve au plus 6 places par créneau.

**Spécification :** `SPEC-CANCEL_PRESTATAIRE-02`  
**Critère d'acceptation :** `AC-01` , `AC-04`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la limite de 6 places par créneau réservés par l'hôtel. Si la règle se casse, l'hôtel peut réserver plus de place qui lui est permis sur un créneau, au détriment des clients classiques.

## Cas

```gherkin
Étant donnés plusieurs créneaux disponibles dans la semaine 17 au 23 aout 2026.
Parmi ces créneaux se trouvent: le 17.08, une sortie baleine à 10h (10 places restantes), 20.08, une sortie dauphin à 7h (5 places restantes) et 21.08, une sortie baleine à 10h (3 places restantes).
L'hôtel veut réserver 6 places(dont 2 enfants) sur le premier et 4 places sur les deux autres créneaux pour une valeur totale de 459€ (avec réduction de 15%) qui sera payé à la fin du mois.
Le nombre de place est suffisant pour les réservations sauf pour la sortie du 21.08.
Quand l'hôtel confirme ses réservations pour cette semaine.
Alors les réservations du 17.08 et 20.08 passent en état "Validé".
Et les nombres de places disponibles pour ces créneaux se mettent à jours.
La réservation pour le 21.08 a échoué.
Et le nombre de places disponible ne change pas.
Le patron est notifié par sms des réservations réussis.
L'hôtel est informé des réservations réussis et de celle qui a échoué.



```

## Données

| Élément | Valeur |
|---|---:|
| Montant total a payé | 459 € |
| Départ des sorties | 17 août 2026 à 10:00, 20 août 2026 à 7h et 21 août 2026 à 10h  | Nombres de places disponibles pour ces créneaux | 10, 5 et 3 places
| Nombres de places demandés | 6, 4 et 4 places |
| Nombres de places après réservations | 4,1 et 4 places


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Montant totale | 540 € | (65 € × 4) + (40 € × 2) + (50 € × 4) |
| Montant avec réduction | 459 € | 540 € × (1-0.15) |
| Statut de la réservation | Validée, Validée, Non Crée | résultat de la confirmation (10-6, 5-4 et 3-4) |

## Ce que ce cas ne vérifie pas

- Les réservations crées par le prestataire suite à un appel/mail 
- Les réservations faites pas des particuliers

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_01_reservation_plusieurs_creneaux_hotel`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant totale (sans réduction) de 540 €.
- [ ] Le test vérifie le montant avec réduction de 15% de 459 €.
- [ ] Le test vérifie que le nombre de places disponibles soit mise à jour après une réservation réussite.
- [ ] Le test vérifie que le nombre de places disponibles ne change pas après une réservation échouée.
- [ ] Le test distingue une réservation réussis ou échouée.
- [ ] Le test vérifie le passage au statut « validée ».
- [ ] Le test échoue si la réduction de 15 % est volontairement supprimée du code.
- [ ] Le nom du test contient `CASE_BOOK_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
