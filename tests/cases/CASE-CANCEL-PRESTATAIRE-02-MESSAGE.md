# CASE-CANCEL-PRESTATAIRE-02—MESSAGE Le prestataire peut envoyer un message générale à une heure voulue
**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02`  
**Critère d'acceptation :** `AC-01` et `AC-01`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le système de messagerie globale qui permet au prestataire d'envoyer un message par sms ou mail à plusieurs clients en même temps. Si la règle se casse, les messages ne s'enverront pas, resultant en des clients non informés de possible annulation.


## Cas

```gherkin
Étant donné, la sortie Baleine le 23 août 2026.
Il est prévu de forte intempéries toute la journée.
Le prestataire envoie un message d'alerte le 22 août 2026 à 18h, informant d'une possible annulation.
Sauf interventions des clients concernés, les réservations sont encore en état "payé". Sous entendant qu'elles sont encore actives.
Le lendemain, il y a en effet un mauvais temps.
Le prestataire confirme l'annulation en envoyant un nouveau message à 05:00.
Toutes les réservation prévues pour la journée passent en état "annulé".



```

## Données

| Élément | Valeur |
|---|---:|
| Date concerné par l'annulation| 23 Août 2026 |
| Heure et date du premier message| 18:00 22 août 2026 |
| Etat des réservations au moment du premier message | Payé |
| Heure et date du second message|  05:00 23 août 2026 |
| Etat des réservations au moment du second message | Annulé |



## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
| Heure du premier message | 18:00  | Heure choisie par le prestataire |
| Heure du second message | 05:00  | Deux heures avant la première sortie annulée (Donc 2H avant 7h dans cet exemple) |

## Ce que ce cas ne vérifie pas

- L'état des réservations suite à la réception des messages

---

## Test automatisé

**Nom attendu :**
`test_CANCELPR_01_message
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie le message entrée par le prestataire.
- [ ] Le test vérifie la liste de toutes les réservations.
- [ ] Le test vérifie l'état d'envoie des messages.
- [ ] Les clients concernés doivent recevoir les messages.

**Relu par :** à renseigner  
**Remarques :** à renseigner
