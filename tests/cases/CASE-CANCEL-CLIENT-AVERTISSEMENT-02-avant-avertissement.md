# CASE-CANCEL-CLIENT-AVERTISSEMENT-02 — Annulation avant l'envoi de l'avertissement (barème classique)

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
**Critère d'acceptation :** — (cas limite 1, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la frontière entre `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` et
`SPEC-CANCEL-CLIENT-01` : un client qui annule **avant** qu'un avertissement
ait été envoyé doit se voir appliquer le barème classique (ici 50 % de
retenue), pas le remboursement intégral réservé aux annulations faites
pendant la phase d'avertissement. Si la règle se casse, tout client qui
annule dans les jours précédant une sortie pourrait être remboursé à tort à
100 %, quel que soit le délai avant le départ.

## Cas

```gherkin
Étant donné une réservation payée d'un montant total de 260 €
Et une sortie prévue le 18 août 2026 à 09:00
Et qu'aucun avertissement météo n'a été envoyé par le prestataire
Et une demande d'annulation faite le 17 août 2026 à 09:00
Et que l'annulation est demandée par le client
Quand le client confirme l'annulation de sa réservation
Alors la réservation passe au statut « annulée »
Et le barème classique s'applique (annulation à moins de 48 h)
Et 130 € restent acquis au prestataire
Et 130 € sont remboursés au client
```

## Données

| Élément                     |               Valeur |
| ---------------------------- | -------------------: |
| Montant total payé           |                260 € |
| Départ de la sortie          | 18 août 2026 à 09:00 |
| Avertissement du prestataire |          aucun envoyé |
| Demande d'annulation         | 17 août 2026 à 09:00 |
| Délai avant le départ        |            24 heures |
| Origine de l'annulation      |               client |
| Retenue applicable           |    50 % (barème classique) |

## Résultat attendu, calculé à la main

| Grandeur                 | Valeur attendue | Calcul                      |
| ------------------------ | --------------: | ---------------------------- |
| Montant retenu           |           130 € | 260 € × 50 %                 |
| Montant remboursé        |           130 € | 260 € − 130 €                |
| Statut de la réservation |         annulée | résultat de la confirmation  |

## Ce que ce cas ne vérifie pas

- l'annulation faite pendant la phase d'avertissement (remboursement intégral)
  → `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` AC-3 ;
- l'annulation décidée par le prestataire ;
- la sortie finalement maintenue après un avertissement (AC-4) ;
- la trace de notification « avertissement reçu » (AC-1, AC-5) ;
- le délai bancaire nécessaire pour recevoir le remboursement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_CLIENT_AVERTISSEMENT_02_annulation_avant_avertissement_bareme_classique`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test reprend le montant de 260 €.
- [ ] Le test s'assure qu'aucun avertissement n'a été envoyé avant l'annulation.
- [ ] Le test place l'annulation 24 heures avant le départ.
- [ ] Le test distingue cette annulation d'une annulation faite après avertissement.
- [ ] Le test vérifie une retenue de 130 € (barème classique, pas 0 %).
- [ ] Le test vérifie un remboursement de 130 €.
- [ ] Le test vérifie le passage au statut « annulée ».
- [ ] Le test échoue si le remboursement intégral est appliqué par erreur.
- [ ] Le nom du test contient `CASE_CANCEL_CLIENT_AVERTISSEMENT_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de
`SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` — il matérialise le « cas limite 1 » de
cette spec (ligne 40), qui n'a pas de critère d'acceptation dédié. À signaler
si la spec est révisée : soit ajouter un AC explicite pour cette non-régression,
soit documenter que ce cas relève en réalité de `SPEC-CANCEL-CLIENT-01`.
