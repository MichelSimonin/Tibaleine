# CASE-ALERT-01 — Envoi de l'avertissement météo à 18h aux clients concernés

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** `AC-01`, `AC-02`
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège l'envoi effectif de l'avertissement météo à tous les clients
concernés, à l'heure prescrite (la veille à 18 h). Si la règle se casse, des
clients pourraient ne pas être informés d'un risque météo à temps pour
annuler leur réservation sans frais.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00 comprenant 5 réservations payées
Et un risque de mauvaises conditions météo signalé pour le lendemain matin
Quand l'administrateur déclenche l'avertissement le 11 juillet 2026 à 18:00
Alors les 5 clients concernés reçoivent un SMS et/ou un mail d'avertissement
Et une alerte est affichée sur le site pour ce créneau
```

## Données

| Élément                          |                    Valeur |
| ---------------------------------- | -------------------------: |
| Sortie concernée                   |    12 juillet 2026 à 10:00 |
| Réservations payées sur ce créneau |                        5 |
| Avertissement déclenché            |    11 juillet 2026 à 18:00 |
| Canaux                             |               SMS et/ou mail |

## Résultat attendu, calculé à la main

| Grandeur                                   | Valeur attendue | Calcul                              |
| --------------------------------------------- | ---------------: | -------------------------------------- |
| Clients notifiés par SMS et/ou mail            |             5 / 5 | tous les clients du créneau concerné    |
| Alerte affichée sur le site pour ce créneau    |               oui | résultat du déclenchement              |

## Ce que ce cas ne vérifie pas

- le contenu personnalisé et bilingue du message → `CASE-ALERT-03` ;
- l'annulation définitive et la notification simultanée qui en découle (AC-5) → `CASE-ALERT-04` ;
- un client ayant réservé après 18 h (cas limite 1) → `CASE-ALERT-02` ;
- l'hôtel concerné par le créneau (cas limite 4) → `CASE-ALERT-05` ;
- une panne du service SMS au moment de l'envoi (cas limite 5) → `CASE-ALERT-06`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_01_envoi_avertissement_18h_clients_notifies`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test déclenche l'avertissement à 18 h la veille de la sortie.
- [ ] Le test vérifie que les 5 clients du créneau reçoivent une notification (SMS et/ou mail).
- [ ] Le test vérifie qu'une alerte est affichée sur le site pour ce créneau.
- [ ] Le test échoue si un client du créneau concerné n'est pas notifié.
- [ ] Le nom du test contient `CASE_ALERT_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
