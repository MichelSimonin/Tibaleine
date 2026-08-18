# CASE-BOOK-04— Le nombre de place disponible pour une activité se met à jours après le paiement d'une réservation

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-04` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la modification du nombre de place disponible après le paiement d'une réservation. Si la règle se casse, l'information du nombre de place encore disponible fournis aux clients sera incorrect, résultant en des tentatives de réservation sur des créneau non disponible.

## Cas

```gherkin
Étant donné Jean Edouard, un nouveau client. 
Il voudrait réserver une sortie baleine, le 21 août 2026 à 10H, pour sa famille qui comprend sa femme, ses deux parents et son fils.
Il clic sur le créneau et date voulu (pour lequel il reste 6 places) et remplit le formulaire avec son nom, son prénom, son email (Edouardo@email.fr), le nombre de personnes (dont nombre d'enfants) et le type de sortie voulu.
Quand il clic sur "Payer", le contenu du formulaire est envoyé au système pour le traitement et vérification des informations.
Jean paye sa réservation à hauteur de 300 €.
Après le paiement, Jean reçoit un mail résumant les informations de sa réservation et comprenant un lien temporaire lui donnant la possibilité de s'inscrire.
Le nombre de places disponible sur le créneau choisis est mis à jour.


```

## Données

| Élément | Valeur |
|---|---:|
| Date choisis | 21 Août 2026 à 10:00 |
| Nom | Edouard |
| Prénom | Jean |
| Nombre de personnes | 5 (dont 1 enfant)|
| Type de sortie | Baleine |
| Email | Edouardo@email.fr |
| Nombre de places disponibles | 6 places |
| Etat de réservation |Payé |


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Informations réservation : Nom Prénom Email  | Jean Edouard Edouardo@email.fr |
| Informations réservation : Date et heure  |  21 août 2026 à 10:00|
| Informations réservation : Nombre de personne (dont enfant)  | 5 (dont 1 enfant) |
| Informations réservation : Type de sortie  |  Baleine |
| Statut de la réservation | Payé | résultat du paiement par le client|
| Nombre de places disponible après réservation | 1 <= (6-5) |

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
`test_CASE_BOOK_04_formulaire_client  
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
