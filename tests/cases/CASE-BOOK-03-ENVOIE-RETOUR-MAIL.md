# CASE-BOOK-03—envoie-retour-mail Un client peut envoyer le formulaire et recevoir un retour par mail

**Statut :** remplacé

**Amendé par :** `CASE-BOOK-03-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-BOOK-03-A1`.

**Spécification :** `SPEC-BOOK-01`  
**Critère d'acceptation :** `AC-02` 
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoie d'un retour par mail après une réservation. Si la règle se casse, l'envoie va échouer, résultant en une absence de retour et une impossibilité pour le client de s'inscrire ou de vérifier les informations de sa réservation.

## Cas

```gherkin
Étant donné Jean Edouard, un nouveau client. 
Il voudrait réserver une sortie baleine, le 21 août 2026 à 10H, pour sa famille qui comprend sa femme, ses deux parents et son fils.
Il clic sur le créneau et date voulu (pour lequel il reste 6 places) et remplit le formulaire avec son nom, son prénom, son email (Edouardo@email.fr), son numéro de téléphone (0692XXXXXX) et le nombre de personnes (dont nombre d'enfants) et le type de sortie voulu.
Quand il clic sur "Payer", le contenu du formulaire est envoyé au système pour le traitement et vérification des informations.
Jean paye sa réservation à hauteur de 300 €.
Après le paiement, Jean recoit un mail résumant les informations de sa réservation et comprenant un lien temporaire lui donnant la possibilité de s'inscrire.


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
| Numero Tel | 0692XXXXXX |
| Nombre de places disponibles | 6 places |
| Etat de réservation |Payé |


## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Informations réservation : Nom Prénom Email  | Jean Edouard Edouardo@email.fr |
| Informations réservation : Téléphone | 0692XXXXXX |
| Informations réservation : Date et heure  |  21 août 2026 à 10:00|
| Informations réservation : Nombre de personne (dont enfant)  | 5 (dont 1 enfant) |
| Informations réservation : Type de sortie  |  Baleine |
| Statut de la réservation | Payé | résultat du paiement par le client|
| Statut envoie mail | Envoyer |

## Ce que ce cas ne vérifie pas

- Le processus de paiement
- Le formulaire de modification de réservation
- Le formulaire d'annulation de réservation
- La réservation faite avec un compte professionnelle
- Le blocage des places lors de la réservation
- La mise à jour des places disponibles après réservation
- La conformité des informations

---

## Test automatisé

**Nom attendu :**
`test_CASE_BOOK_03_Envoie_mail_client
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie les informations en sortie.
- [ ] Le test vérifie l'envoie du mail 
- [ ] Le test vérifie le passage au statut « payé ».
- [ ] Le test échoue si le mail n'est pas envoyé.
- [ ] Le test échoue si les informations du mail sont incomplets/incorrects.
- [ ] Le nom du test contient `CASE_BOOK_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
