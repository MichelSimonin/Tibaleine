# CASE-CANCEL-PRESTATAIRE-03-client-cancel Remboursement des clients après une annulation suite à une avertissement du prestataire

**Amendé par :** `CASE-CANCEL-PRESTATAIRE-03-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-CANCEL-PRESTATAIRE-03-A1`.
**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02`  
**Critère d'acceptation :** `AC-04`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le régime financier applicable lorsqu'un client annule lui-même
sa réservation suite à un avertissement d'annulation possible du prestataire. Si la règle se casse, le
prestataire peut retenir une somme qui ne lui est pas due.


## Cas

```gherkin
Étant donné, la sortie Baleine le 23 août 2026.
Il est prévu de forte intempéries toute la journée.
Le prestataire envoie un message d'alerte le 22 août 2026 à 18h, informant d'une possible annulation.
Les réservations sont encore en état "payé". Sous entendant qu'elles sont encore actives.
Certains clients décident d'annuler leurs réservations le soir du 22 août 2026 de 18h30 à 20h. Celles-ci passent en état "annulée".
Ces clients ayant annulé, indépendamment de la décision finale d'annulation, seront remboursé intégralement.


```

## Données

| Élément | Valeur |
|---|---:|
| Date concerné par l'annulation| 23 Août 2026 |
| Date et heures où les clients ont annulé| 22 Août 2026 de 18H30 à 20H|
| Statut des réservations des clients ayant annulés | "Annulée" |
| Statut des réservations des autres clients | "Payée" |




## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue | Calcul |
|---|---:|---|
|Statut des réservations des clients ayant annulés | "Annulée" | Résultat de l'annulation|
|Statut des réservations des autres clients | "Payée" |Ne changera que si le prestataire annule|

## Ce que ce cas ne vérifie pas

- L'envoie et la réception des messages d'alerte et d'annulation
---

## Test automatisé

**Nom attendu :**
`test_CANCELPR_02_annulation
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test vérifie la présence d'une alerte sur un créneau
- [ ] Le test vérifie la date et l'heure où l'annulation a été effectué
- [ ] Le test vérifie que l'annulation a été effectué après que l'alerte à été lancé.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Les clients concernés doivent recevoir les messages.

**Relu par :** à renseigner  
**Remarques :** à renseigner
