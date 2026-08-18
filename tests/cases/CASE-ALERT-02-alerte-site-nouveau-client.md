# CASE-ALERT-02 — Alerte site pour un client réservant après l'avertissement de 18h

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** `AC-03`
**Type :** acceptation
**Niveau de risque :** modéré

## Ce que ce cas protège

Ce cas protège la distinction entre un client déjà réservé au moment de
l'avertissement (qui reçoit un SMS/mail) et un client réservant après 18 h
(qui n'en reçoit pas, mais doit voir l'alerte affichée sur le site pour son
créneau). Si la règle se casse, un nouveau client pourrait réserver sans être
informé du risque météo, ou recevoir à tort un SMS auquel il n'a pas droit.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00
Et un avertissement météo envoyé le 11 juillet 2026 à 18:00 aux clients déjà réservés
Quand un nouveau client réserve ce créneau le 11 juillet 2026 à 20:00
Alors ce client ne reçoit ni SMS ni mail d'avertissement
Et une alerte est affichée sur le site pour ce créneau au moment de sa réservation
```

## Données

| Élément                             |                    Valeur |
| -------------------------------------- | -------------------------: |
| Sortie concernée                       |    12 juillet 2026 à 10:00 |
| Avertissement envoyé (clients existants) |  11 juillet 2026 à 18:00 |
| Réservation du nouveau client          |    11 juillet 2026 à 20:00 |

## Résultat attendu, calculé à la main

| Grandeur                                        | Valeur attendue | Calcul                          |
| -------------------------------------------------- | ---------------: | ---------------------------------- |
| SMS/mail envoyé au nouveau client                   |               non | réservation postérieure à 18 h     |
| Alerte visible sur le site pour son créneau         |               oui | résultat de sa réservation         |

## Ce que ce cas ne vérifie pas

- le contenu du message envoyé aux clients déjà réservés → `CASE-ALERT-01` ;
- la personnalisation et la traduction du message → `CASE-ALERT-03` ;
- le droit à un remboursement intégral si ce nouveau client annule ensuite —
  ce client n'a pas reçu l'avertissement, donc a priori non concerné par
  `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`, à confirmer séparément ;
- l'annulation définitive et sa notification (AC-5) → `CASE-ALERT-04`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_02_alerte_site_pour_client_reservant_apres_avertissement`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test place la réservation après l'heure de déclenchement de l'avertissement (18 h).
- [ ] Le test vérifie qu'aucun SMS/mail n'est envoyé à ce client.
- [ ] Le test vérifie qu'une alerte est affichée sur le site pour son créneau.
- [ ] Le test distingue ce client d'un client ayant réservé avant 18 h.
- [ ] Le nom du test contient `CASE_ALERT_02`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** à renseigner
