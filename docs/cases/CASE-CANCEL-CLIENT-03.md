# CASE-CANCEL-03 — Annulation client pendant la phase d'avertissement (remboursement intégral)

**Spécification :** `SPEC-CANCEL_CLIENT_AVERTISSEMENT-03`  
**Critère d'acceptation :** `AC-03`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le régime de remboursement intégral applicable lorsqu'un client annule sa réservation après avoir reçu l'avertissement du prestataire. Si la règle se casse, le barème classique (retenue de 25 % ou 50 %) serait appliqué à un client qui a droit à un remboursement à 100 %.

## Cas

```gherkin
Étant donné une réservation confirmée d'un montant total de 260 €
Et une sortie prévue le 12 juillet 2026 à 10:00
Et que le prestataire a envoyé un avertissement de possible annulation (la veille à 18 h)
Et que le client a reçu cet avertissement
Et que le client annule sa réservation pendant la phase d'avertissement
Quand le client confirme l'annulation de sa réservation
Alors la réservation passe au statut « annulée »
Et 260 € sont remboursés intégralement au client
Et aucune somme n'est retenue par le prestataire
```

## Données

| Élément               | Valeur |
| --------------------- | -----: |
| Montant total payé | 260 €|
| Avertissement reçu | oui |
| Moment de l'annulation | phase d'avertissement |
| Origine de l'annulation | client (après avertissement) |
| Retenue applicable | 0 % |

## Résultat attendu, calculé à la main

| Grandeur                 | Valeur attendue | Calcul        |
| ------------------------ | --------------: | ------------- |
| Montant retenu | 0 €  | 260 € × 0 % |
| Montant remboursé | 260 €  | 260 € − 0 €   |
| Statut de la réservation | annulée | résultat de la confirmation |

## Ce que ce cas ne vérifie pas

- l'annulation à l'initiative du client sans avertissement (barème 100 / 75 / 50 %)
- l'annulation décidée par le prestataire
- le remboursement intégral lorsque la sortie est finalement maintenue
- un client qui n'a pas reçu l'avertissement
- l'exécution manuelle du remboursement par le patron
- le délai bancaire nécessaire pour recevoir le remboursement

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_03_annulation_client_apres_avertissement_remboursement_integral`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant de 260 €.
- [ ] Le test s'assure que le client a reçu l'avertissement (trace des notifications).
- [ ] Le test place l'annulation pendant la phase d'avertissement.
- [ ] Le test distingue une annulation après avertissement d'une annulation classique.
- [ ] Le test vérifie une retenue de 0 €.
- [ ] Le test vérifie un remboursement de 260 €.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Le test échoue si le remboursement intégral est volontairement remplacé par le barème.
- [ ] Le nom du test contient `CASE_CANCEL_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
