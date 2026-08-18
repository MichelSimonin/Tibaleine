# CASE-BOOK-01— Un client peut remplir le formulaire de réservation

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-01` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoie correct de toutes les informations necessaires pour une réservation. Si la règle se casse, la réservation peut échouer ou se créer avec des mauvaises informations.

## Cas

```gherkin
Étant donné Jean Edouard, un nouveau client. 
Il voudrait réserver une sortie baleine, le 21 août 2026 à 10H, pour sa famille qui comprend sa femme, ses deux parents et son fils.
Il clic sur le créneau et date voulu (pour lequel il reste 6 places) et remplit le formulaire avec son nom, son prénom, son email (Edouardo@email.fr), le nombre de personnes (dont nombre d'enfants) et le type de sortie voulu.
Quand il clic sur "Payer", le contenu du formulaire est envoyé au système pour le traitement et vérification des informations.
Les informations et le nombre de place sont correct. Jean est renvoyé sur la page de paiement.


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


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Informations réservation : Nom Prénom Email  | Jean Edouard Edouardo@email.fr |
| Informations réservation : Date et heure  |  21 août 2026 à 10:00|
| Informations réservation : Nombre de personne (dont enfant)  | 5 (dont 1 enfant) |
| Informations réservation : Type de sortie  |  Baleine |
| Statut de la réservation | En attente | résultat de la validation des informations données|

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
`test_CASE_BOOK_01_formulaire_client  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie les information en entrée, fournis par le client (email, nom,prénom,type_sortie,nb_personne,nb_enfant,date,creneau => (exemple ici) edouardo@email.fr, Edouard, Jean, Baleine, 5, 1, 21.08.2026, 10:00)
- [ ] Le test vérifie les informations en sortie.
- [ ] Le test vérifie que les informations en entrée et en sortie sont les mêmes.
- [ ] Le test vérifie le passage au statut « en attente ».
- [ ] Le test échoue si les informations en entrée et en sortie sont différentes (la réservation crée a des informations erronées.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
