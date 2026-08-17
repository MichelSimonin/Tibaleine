# CASE-CANCEL-01 — Annulation à l'inniative du prestataire induit un message d'envoi à 18h en raison de problème météo

**Spécification :** `SPEC-CANCEL-02`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ca cas protège d'un envoi obligatoire de la notif à 18h en cas de problème météo. Les clients sont garantis d'être informé d'une potentielle annulation d'un créneau à partir de 18h.

## Cas

```gherkin
Étant donné un créneau est prevu le 18 août 2026 à 09:00  €
Et que les conditions météo peuvent être mauvaise
Et une demande d'annulation faite le 15 août 2026 à 09:00
Et que l'annulation est demandée par le client
Et qu'aucune alerte ni annulation du prestataire n'est en cours
Quand le client confirme l'annulation de sa réservation
Alors la réservation passe au statut « annulée »
Et 130 € restent acquis au prestataire
Et 130 € sont remboursés au client
```

## Données

| Élément                 |               Valeur |
| ----------------------- | -------------------: |
| Montant total payé      |                260 € |
| Départ de la sortie     | 18 août 2026 à 09:00 |
| Demande d'annulation    | 17 août 2026 à 09:00 |
| Délai avant le départ   |            24 heures |
| Origine de l'annulation |               client |
| Retenue applicable      |                 50 % |

## Résultat attendu, calculé à la main

| Grandeur                 | Valeur attendue | Calcul                      |
| ------------------------ | --------------: | --------------------------- |
| Montant retenu           |           130 € | 260 € × 50 %                |
| Montant remboursé        |           130 € | 260 € − 130 €               |
| Statut de la réservation |         annulée | résultat de la confirmation |

## Ce que ce cas ne vérifie pas

- l'annulation exactement 48 heures avant le départ ;
- l'annulation entre 48 heures et 7 jours avant le départ ;
- l'annulation plus de 7 jours avant le départ ;
- l'annulation décidée par le prestataire ;
- l'annulation causée par la météo, une panne ou un nombre insuffisant de
  participants ;
- l'absence du client au départ ;
- le délai bancaire nécessaire pour recevoir le remboursement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_01_annulation_client_moins_48h_retient_50_pourcent`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant de 260 €.
- [ ] Le test place l'annulation 24 heures avant le départ.
- [ ] Le test distingue une annulation client d'une annulation du prestataire.
- [ ] Le test vérifie une retenue de 130 €.
- [ ] Le test vérifie un remboursement de 130 €.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Le test échoue si la retenue de 50 % est volontairement supprimée du code.
- [ ] Le nom du test contient `CASE_CANCEL_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
