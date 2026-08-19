# CASE-BOOK-08 — Le patron reçoit une notification de réservation

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-3`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoi d'une notification au patron après la confirmation d'une nouvelle réservation, par SMS et dans son espace administrateur. Si cette règle se casse, le patron n'est pas informé de la réservation et risque de ne pas pouvoir anticiper l'accueil des clients.

## Cas

```gherkin
Étant donné un créneau de sortie baleine le 21 août 2026 à 10h avec 6 places restantes
Et Jean Edouard réserve ce créneau pour 5 personnes, dont 1 enfant
Et le numéro de téléphone du patron est configuré pour recevoir les notifications
Et le patron dispose d'un espace administrateur dans l'application
Quand Jean confirme sa réservation et que son paiement réussit
Alors la réservation est enregistrée avec le statut « Payée »
Et un SMS de notification concernant cette nouvelle réservation est envoyé au patron
Et une notification concernant cette nouvelle réservation apparaît dans l'espace administrateur du patron
Et une seule notification est créée sur chaque canal pour la même confirmation
```

## Données

| Élément | Valeur |
|---|---:|
| Date choisie | 21 août 2026 à 10:00 |
| Nom du client | Edouard |
| Prénom du client | Jean |
| Nombre de personnes | 5 (dont 1 enfant) |
| Type de sortie | Baleine |
| Places disponibles avant la réservation | 6 places |
| Statut de la réservation | Payée |
| Canaux de notification du patron | SMS et espace administrateur |
| Nombre de SMS attendu | 1 |
| Nombre de notifications attendu dans l'espace administrateur | 1 |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Réservation enregistrée | Oui | Confirmation et paiement réussi |
| Statut de la réservation | Payée | Résultat du paiement réussi |
| Destinataire de la notification | Patron | Critère `AC-3` |
| Canaux de notification | SMS et espace administrateur | Notification externe et notification dans l'application |
| Nombre de SMS envoyés | 1 | Une confirmation de réservation entraîne un seul SMS |
| Nombre de notifications créées dans l'espace administrateur | 1 | Une confirmation de réservation entraîne une seule notification dans l'application |

## Ce que ce cas ne vérifie pas

- L'envoi de l'email de confirmation au client
- Le contenu détaillé du SMS et de la notification dans l'application
- Le délai de réception du SMS
- Le comportement en cas d'échec du service d'envoi de SMS
- La consultation et le marquage de la notification comme lue
- La mise à jour du nombre de places disponibles
- Le blocage temporaire des places
- Une réservation effectuée par un hôtel

---

## Test automatisé

**Nom attendu :**  
`test_CASE_BOOK_08_notification_patron`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie que la réservation est enregistrée avec le statut « Payée ».
- [ ] Le test vérifie qu'une demande d'envoi de SMS est créée après la confirmation de la réservation.
- [ ] Le test vérifie que le destinataire du SMS est le patron.
- [ ] Le test vérifie qu'une notification est créée dans l'espace administrateur du patron.
- [ ] Le test vérifie que la notification dans l'application concerne la réservation confirmée.
- [ ] Le test vérifie qu'un seul SMS est envoyé pour cette confirmation.
- [ ] Le test vérifie qu'une seule notification est créée dans l'application pour cette confirmation.
- [ ] Le test échoue si aucun SMS n'est envoyé au patron.
- [ ] Le test échoue si aucune notification n'apparaît dans l'espace administrateur du patron.
- [ ] Le test échoue si le SMS est adressé à un autre destinataire.
- [ ] Le nom du test contient `CASE_BOOK_08`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
