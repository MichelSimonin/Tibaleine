# CASE-CANCEL-CLIENT-02 — Annulation client à entre 48h et 7 jours

**Statut :** remplacé

**Amendé par :** `CASE-CANCEL-CLIENT-02-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-CANCEL-CLIENT-02-A1`.

**Spécification :** `SPEC-CANCEL-CLIENT-01`  
**Critère d'acceptation :** `AC-04`
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le régime financier applicable lorsqu'un client annule lui-même
sa réservation entre 7 jours et 48 heures avant le départ. Le prestataire conserve 25% de la somme. Le prestataire rembourse 75% du prix de la réservation.

## Cas

```gherkin
Étant donné une réservation payée d'un montant total de 260 €
Et une sortie prévue le 18 août 2026 à 09:00
Et une demande d'annulation faite le 15 août 2026 à 09:00
Et que l'annulation est demandée par le client
Et qu'aucune alerte ni annulation du prestataire n'est en cours
Quand le client confirme l'annulation de sa réservation
Alors la réservation passe au statut « annulée »
Et 65 € restent acquis au prestataire
Et 195 € sont remboursés au client
```

## Données

| Élément                 |               Valeur |
| ----------------------- | -------------------: |
| Montant total payé      |                260 € |
| Départ de la sortie     | 18 août 2026 à 09:00 |
| Demande d'annulation    | 15 août 2026 à 09:00 |
| Délai avant le départ   |            72 heures |
| Origine de l'annulation |               client |
| Retenue applicable      |                 25 % |

## Résultat attendu, calculé à la main

| Grandeur                 | Valeur attendue | Calcul                      |
| ------------------------ | --------------: | --------------------------- |
| Montant retenu           |           65 € | 260 € × 25 %                |
| Montant remboursé        |           195 € | 260 € − 65 €               |
| Statut de la réservation |         annulée | résultat de la confirmation |

## Ce que ce cas ne vérifie pas

- l'annulation plus de 7 jours avant le départ ;
- l'annulation décidée par le prestataire ;
- l'annulation causée par la météo, une panne ou un nombre insuffisant de
  participants ;
- l'absence du client au départ ;
- le délai bancaire nécessaire pour recevoir le remboursement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_02_annulation_client_entre_7_jours_et_ 48h_retient_25_pourcent`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant de 260 €.
- [ ] Le test place l'annulation 72 heures avant le départ.
- [ ] Le test distingue une annulation client d'une annulation du prestataire.
- [ ] Le test vérifie une retenue de 65 €.
- [ ] Le test vérifie un remboursement de 195 €.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Le test échoue si la retenue de 25 % est volontairement supprimée du code.
- [ ] Le nom du test contient `CASE_CANCEL_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner 
**Remarques :** à renseigner
