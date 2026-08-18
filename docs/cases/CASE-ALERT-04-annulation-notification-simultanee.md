# CASE-ALERT-04 — Annulation définitive : notification simultanée « sans frais »

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** `AC-02`, `AC-05`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la simultanéité de la notification à tous les clients
concernés en cas d'annulation définitive, ainsi que la mention explicite que
le client peut annuler sans frais. Si la règle se casse, certains clients
pourraient être informés en retard, ou l'alerte pourrait omettre
l'information « sans frais », entraînant des désaccords sur le remboursement.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00 comprenant 5 réservations
Et un avertissement envoyé la veille à 18:00
Quand l'administrateur confirme l'annulation définitive le 12 juillet 2026 à 07:00
Alors les 5 clients concernés sont prévenus automatiquement par SMS et/ou mail au même moment
Et le message précise que le client peut annuler sa réservation sans frais
```

## Données

| Élément                        |                    Valeur |
| ---------------------------------- | -------------------------: |
| Sortie concernée                   |    12 juillet 2026 à 10:00 |
| Réservations concernées            |                          5 |
| Avertissement envoyé               |    11 juillet 2026 à 18:00 |
| Annulation définitive confirmée    |    12 juillet 2026 à 07:00 |
| Délai avant le départ              |                    3 heures |

## Résultat attendu, calculé à la main

| Grandeur                                          | Valeur attendue | Calcul                             |
| ------------------------------------------------------ | ---------------: | -------------------------------------- |
| Clients notifiés                                        |             5 / 5 | tous les clients du créneau annulé      |
| Horodatage de notification identique pour les 5 clients |               oui | envoi « au même moment »                |
| Mention « annulation sans frais » présente               |               oui | contenu imposé par la règle             |

## Ce que ce cas ne vérifie pas

- le calcul et l'exécution du remboursement lui-même → `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` ;
- l'hôtel concerné par le créneau (non notifié par SMS/mail) → `CASE-ALERT-05` ;
- l'envoi de l'avertissement initial (AC-1) → `CASE-ALERT-01` ;
- une panne du service SMS au moment de l'annulation → `CASE-ALERT-06`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_04_annulation_definitive_notification_simultanee`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test confirme l'annulation définitive du créneau.
- [ ] Le test vérifie que les 5 clients reçoivent une notification.
- [ ] Le test vérifie que les notifications sont horodatées au même moment.
- [ ] Le test vérifie la présence de la mention « sans frais » dans le message.
- [ ] Le nom du test contient `CASE_ALERT_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** L'heure exacte de la décision d'annulation définitive reste
ambiguë dans les specs liées (« vers 5 h » CR-04/Q54 vs « au moins 2 h avant »
— signalé dans la Revue IA de `SPEC-CANCEL-PRESTATAIRE-02`). Ce cas prend
l'hypothèse « au moins 2 h avant le départ » ; à ajuster si ce point est
tranché différemment.
