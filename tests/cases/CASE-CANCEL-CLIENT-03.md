# CASE-CANCEL-CLIENT-03 — Annulation client à plus de 7 jours

**Spécification :** `SPEC-CANCEL-CLIENT-01`  
**Critère d'acceptation :** `AC-05`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le régime financier applicable lorsqu'un client annule lui-même
sa réservation à plus de 7 jours avant le départ. Le prestataire rembourse 100 % du prix de la réservation.

## Cas

```gherkin
Étant donné une réservation payée d'un montant total de 260 €
Et une sortie prévue le 18 août 2026 à 09:00
Et une demande d'annulation faite le 10 août 2026 à 09:00
Et que l'annulation est demandée par le client
Et qu'aucune alerte ni annulation du prestataire n'est en cours
Quand le client confirme l'annulation de sa réservation
Alors la réservation passe au statut « annulée »
Et 260 € sont remboursés au client
```

## Données

| Élément                 |               Valeur |
| ----------------------- | -------------------: |
| Montant total payé      |                260 € |
| Départ de la sortie     | 18 août 2026 à 09:00 |
| Demande d'annulation    | 10 août 2026 à 09:00 |
| Délai avant le départ   |              8 jours |
| Origine de l'annulation |               client |
| Retenue applicable      |                 0 % |

## Résultat attendu, calculé à la main

| Grandeur                 | Valeur attendue | Calcul                      |
| ------------------------ | --------------: | --------------------------- |
| Montant retenu           |             0 € | 260 € × 0 %                 |
| Montant remboursé        |           260 € | 260 € − 0 €                 |
| Statut de la réservation |         annulée | résultat de la confirmation |

## Ce que ce cas ne vérifie pas

- l'annulation entre 7 jours et 48h avant le départ ;
- l'annulation à moins de 48h ;
- l'annulation décidée par le prestataire ;
- l'annulation causée par la météo, une panne ou un nombre insuffisant de
  participants ;
- l'absence du client au départ ;
- le délai bancaire nécessaire pour recevoir le remboursement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_02_annulation_client_à_plus_de_7_jours_retient_0_pourcent`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant de 260 €.
- [ ] Le test place l'annulation plus de 7 jours avant le départ.
- [ ] Le test distingue une annulation client d'une annulation du prestataire.
- [ ] Le test vérifie une retenue de 0 €.
- [ ] Le test vérifie un remboursement de 260 €.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Le test échoue si la retenue de 0 % est volontairement supprimée du code.
- [ ] Le nom du test contient `CASE_CANCEL_CLIENT_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner 
**Remarques :** à renseigner
