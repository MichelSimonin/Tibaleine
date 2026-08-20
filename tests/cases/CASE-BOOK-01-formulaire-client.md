# CASE-BOOK-01 — Un client peut remplir le formulaire de réservation

**Statut :** remplacé

**Amendé par :** `CASE-BOOK-01-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-BOOK-01-A1`.

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-01` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoie correct de toutes les informations necessaires pour une réservation. Si la règle se casse, la réservation peut échouer ou se créer avec des mauvaises informations.

## Cas

```gherkin
Étant donné Jean Edouard, un nouveau client
Et un créneau de sortie baleine le 21 août 2026 à 10h avec 6 places restantes
Quand il remplit le formulaire (nom, prénom, email, nombre de personnes dont enfants, type de sortie) et l'envoie
Alors le système vérifie les informations et le nombre de places
Et la réservation est enregistrée
Et Jean est renvoyé vers l'étape suivante (paiement)
```

## Données

| Élément | Valeur |
|---|---:|
| Date choisis | 21 Août 2026 à 10:00 |
| Nom | Edouard |
| Prénom | Jean |
| Nombre de personnes | 5 (dont 1 enfant)|
| Type de sortie | Baleine |
| Email | jean.edouard@email.fr |
| Nombre de places disponibles | 6 places |


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Informations réservation : Nom Prénom Email  | Jean Edouard jean.edouard@email.fr |
| Informations réservation : Date et heure  |  21 août 2026 à 10:00|
| Informations réservation : Nombre de personne (dont enfant)  | 5 (dont 1 enfant) |
| Informations réservation : Type de sortie  |  Baleine |
| Réservation enregistrée | oui | validation des informations et des places |

## Ce que ce cas ne vérifie pas

- Le processus de paiement
- Le formulaire de modification de réservation
- Le formulaire d'annulation de réservation
- La réservation faite avec un compte professionnelle
- Le blocage des places lors de la réservation
- La mise à jour des places disponibles après réservation
- Le retour client par mail ou sms

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_01_formulaire_client`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie les information en entrée, fournis par le client (email, nom,prénom,type_sortie,nb_personne,nb_enfant,date,creneau => (exemple ici) jean.edouard@email.fr, Edouard, Jean, Baleine, 5, 1, 21.08.2026, 10:00)
- [ ] Le test vérifie les informations en sortie.
- [ ] Le test vérifie que les informations en entrée et en sortie sont les mêmes.
- [ ] Le test vérifie que la réservation est enregistrée.
- [ ] Le test échoue si les informations en entrée et en sortie sont différentes (la réservation créée contient des informations erronées).
- [ ] Le nom du test contient `CASE_BOOK_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
