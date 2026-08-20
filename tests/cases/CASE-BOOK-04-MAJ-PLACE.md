# CASE-BOOK-04 — Le nombre de places disponibles pour une activité se met à jour après le paiement d'une réservation

**Amendé par :** `CASE-BOOK-04-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-BOOK-04-A1`.

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-04` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la mise à jour du nombre de places disponibles après le paiement d'une réservation. Si la règle se casse, le nombre de places encore disponibles affiché aux clients est faux, ce qui peut entraîner des tentatives de réservation sur un créneau complet.

## Cas

```gherkin
Étant donné Jean Edouard, un nouveau client. 
Il voudrait réserver une sortie baleine, le 21 août 2026 à 10H, pour sa famille qui comprend sa femme, ses deux parents et son fils.
Il clic sur le créneau et date voulu (pour lequel il reste 6 places) et remplit le formulaire avec son nom, son prénom, son email (Edouardo@email.fr),son numéro de téléphone (0692XXXXXX) et le nombre de personnes (dont nombre d'enfants) et le type de sortie voulu.
Quand il clic sur "Payer", le contenu du formulaire est envoyé au système pour le traitement et vérification des informations.
Jean paye sa réservation à hauteur de 300 €.
Le nombre de places disponibles sur le créneau choisi est mis à jour.


```

## Données

| Élément | Valeur |
|---|---:|
| Date choisie | 21 Août 2026 à 10:00 |
| Nom | Edouard |
| Prénom | Jean |
| Nombre de personnes | 5 (dont 1 enfant)|
| Numero Tel | 0692XXXXXX |
| Type de sortie | Baleine |
| Email | Edouardo@email.fr |
| Nombre de places disponibles | 6 places |
| Etat de réservation | payée |


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Informations réservation : Nom Prénom Email  | Jean Edouard Edouardo@email.fr |
| Informations réservation : Téléphone | 0692XXXXXX |
| Informations réservation : Date et heure  |  21 août 2026 à 10:00|
| Informations réservation : Nombre de personne (dont enfant)  | 5 (dont 1 enfant) |
| Informations réservation : Type de sortie  |  Baleine |
| Statut de la réservation | payée | résultat du paiement par le client |
| Nombre de places disponibles après réservation | 1 (6 − 5) |

## Ce que ce cas ne vérifie pas

- Le processus de paiement
- Le formulaire de modification de réservation
- Le formulaire d'annulation de réservation
- La réservation faite avec un compte professionnelle
- Le blocage des places lors de la réservation
- La conformité des informations
- L'envoi du retour par mail

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_04_maj_places_apres_paiement`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie le nombre de place disponible pour l'activité.
- [ ] Le test vérifie le nombre de place choisis par l'utilisateur.
- [ ] Le test vérifie que le résultat de la soustraction du nombre de place disponible par le nombre de place choisis par le client soit positif.
- [ ] Le test échoue si la soustraction a un résultat négatif.
- [ ] Le nom du test contient `CASE_BOOK_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
