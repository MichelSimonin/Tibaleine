# CASE-CANCEL-PRESTATAIRE-01 — Le prestataire envoie un avertissement à 18h la veille en cas de risque météo

**Statut :** applicable
**Nom attendu :** `test_CASE_CANCEL_PRESTATAIRE_01`

**Spécification :** `SPEC-CANCEL-PRESTATAIRE-02`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoi de l'avertissement aux clients la veille à 18h00 en cas de risque météo. Si la règle se casse, les clients ne sont pas prévenus qu'un de leurs créneaux risque d'être annulé.

## Cas

```gherkin
Étant donné une sortie baleine prévue le 12 juillet 2026 à 10h00 comprenant 5 réservations payées
Et un risque de mauvaises conditions météo signalé pour le lendemain matin
Quand le prestataire déclenche l'avertissement le 11 juillet 2026 à 18h00
Alors les 5 clients concernés reçoivent un SMS et/ou un mail d'avertissement au même moment
```

## Données

| Élément | Valeur |
|---|---:|
| Sortie concernée | 12 juillet 2026 à 10h00 |
| Réservations payées sur ce créneau | 5 |
| Moment de l'avertissement | 11 juillet 2026 à 18h00 |
| Canaux | SMS et/ou mail |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Avertissement envoyé | oui |
| Clients notifiés | 5 |
| Moment d'envoi | la veille à 18h00 |

## Ce que ce cas ne vérifie pas

- la confirmation d'annulation au moins 2h avant le départ → `SPEC-CANCEL-PRESTATAIRE-02` AC-2 ;
- la réception effective du message par les clients → AC-3 ;
- le remboursement intégral des clients → AC-4 ;
- l'annulation à l'initiative du client → `SPEC-CANCEL-CLIENT-01` ;
- l'hôtel partenaire, prévenu par téléphone → cas limite 2.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_PRESTATAIRE_01_avertissement_18h_veille`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test déclenche l'avertissement la veille à 18h00.
- [ ] Le test vérifie que les 5 clients reçoivent un SMS et/ou mail d'avertissement.
- [ ] Le nom du test contient `CASE_CANCEL_PRESTATAIRE_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner

**Relu par :** à renseigner  
**Remarques :** à renseigner
