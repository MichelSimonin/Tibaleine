# CASE-CANCEL-CLIENT-AVERTISSEMENT-03 — Remboursement intégral maintenu même si la sortie a finalement lieu

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
**Critère d'acceptation :** `AC-04`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le caractère définitif du remboursement intégral : un client
qui a annulé pendant la phase d'avertissement reste remboursé à 100 %, même
si la sortie est finalement maintenue et a bien lieu. Si la règle se casse,
le prestataire pourrait être tenté de récupérer la retenue a posteriori sur
un client qui a annulé de bonne foi sur la base de l'avertissement reçu.

## Cas

```gherkin
Étant donné une réservation confirmée d'un montant total de 260 €
Et une sortie prévue le 12 juillet 2026 à 10:00
Et que le prestataire a envoyé un avertissement le 11 juillet 2026 à 18:00
Et que le client a reçu cet avertissement
Et que le client a annulé sa réservation le 11 juillet 2026 à 20:00
Et que 260 € ont déjà été remboursés intégralement au client
Quand la sortie du 12 juillet 2026 à 10:00 est finalement maintenue et a lieu
Alors la réservation du client reste au statut « annulée »
Et aucune somme n'est réclamée ou récupérée auprès du client
Et le remboursement intégral de 260 € n'est pas remis en cause
```

## Données

| Élément                       |                    Valeur |
| ------------------------------ | -------------------------: |
| Montant total payé             |                      260 € |
| Avertissement envoyé           |    11 juillet 2026 à 18:00 |
| Avertissement reçu             |                        oui |
| Annulation du client            |    11 juillet 2026 à 20:00 |
| Montant déjà remboursé         |                      260 € |
| Décision finale sur la sortie  | maintenue (la sortie a lieu) |
| Retenue applicable             |                        0 % |

## Résultat attendu, calculé à la main

| Grandeur                              | Valeur attendue | Calcul                                   |
| -------------------------------------- | --------------: | ----------------------------------------- |
| Montant retenu après tenue de la sortie |             0 € | inchangé, indépendant de la décision finale |
| Montant remboursé                      |           260 € | inchangé depuis l'annulation               |
| Statut de la réservation               |         annulée | inchangé après la tenue de la sortie       |

## Ce que ce cas ne vérifie pas

- l'annulation faite avant l'envoi de l'avertissement (barème classique)
  → `CASE-CANCEL-CLIENT-AVERTISSEMENT-02` ;
- l'annulation décidée par le prestataire ;
- la sortie finalement annulée par le prestataire (météo) → `SPEC-CANCEL-PRESTATAIRE-02` ;
- la trace de notification « avertissement reçu » (AC-1, AC-5) ;
- le délai bancaire nécessaire pour recevoir le remboursement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_CLIENT_AVERTISSEMENT_03_remboursement_integral_maintenu_si_sortie_maintenue`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test place l'annulation pendant la phase d'avertissement, avec remboursement intégral déjà effectué.
- [ ] Le test simule le maintien effectif de la sortie après l'annulation.
- [ ] Le test vérifie que le statut de la réservation reste « annulée ».
- [ ] Le test vérifie qu'aucune retenue n'est appliquée a posteriori.
- [ ] Le test vérifie que le montant remboursé reste 260 €.
- [ ] Le test échoue si une tentative de récupération de la retenue est introduite dans le code.
- [ ] Le nom du test contient `CASE_CANCEL_CLIENT_AVERTISSEMENT_03`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** La spec ne précise pas de mécanisme technique déclenchant une
« décision finale sur la sortie » après une annulation déjà remboursée — ce
cas suppose que rien ne se passe côté réservation annulée (voir « Ce qui
n'est pas défini », cas limite 2 de la spec, qui reste ouvert pour le cas
symétrique où la réservation n'a pas encore été annulée).
