# CASE-CANCEL-CLIENT-AVERTISSEMENT-04 — Trace de réception de l'avertissement

**Amendé par :** `CASE-CANCEL-CLIENT-AVERTISSEMENT-04-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-CANCEL-CLIENT-AVERTISSEMENT-04-A1`.

**Spécification :** `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`
**Critère d'acceptation :** `AC-01`, `AC-05`
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la traçabilité de l'envoi de l'avertissement à un client
donné : sans cette trace, le système ne peut pas déterminer si un client
« a reçu l'avertissement » et donc ne peut pas décider s'il a droit au
remboursement intégral (`AC-3`) en cas d'annulation ultérieure. Si la règle
se casse, un client ayant reçu l'avertissement pourrait se voir refuser le
remboursement intégral, ou inversement un client n'ayant rien reçu pourrait
en bénéficier à tort.

## Cas

```gherkin
Étant donné un client avec une réservation payée pour la sortie
du 12 juillet 2026 à 10:00
Et un risque de mauvaises conditions météo signalé pour cette sortie
Quand le prestataire envoie l'avertissement le 11 juillet 2026 à 18:00
par SMS et par mail
Alors une notification de type « avertissement » est enregistrée
et associée à la réservation du client
Et cette notification est horodatée au 11 juillet 2026 à 18:00
Et le système peut déterminer que ce client a reçu l'avertissement
```

## Données

| Élément                        |                    Valeur |
| -------------------------------- | -------------------------: |
| Sortie concernée                 |    12 juillet 2026 à 10:00 |
| Réservation du client            |               payée, réservée avant 18 h |
| Avertissement envoyé             |    11 juillet 2026 à 18:00 |
| Canaux                           |               SMS et mail |

## Résultat attendu, calculé à la main

| Grandeur                                  | Valeur attendue                | Calcul                                  |
| ------------------------------------------ | ------------------------------- | ----------------------------------------- |
| Notification associée à la réservation      | oui, type « avertissement »     | résultat de l'envoi                       |
| Horodatage de la notification               | 11 juillet 2026 à 18:00         | heure de l'envoi                          |
| Client déterminé comme « ayant reçu l'avertissement » | oui                    | présence d'une notification « avertissement » liée à sa réservation |

## Ce que ce cas ne vérifie pas

- le contenu exact du message envoyé (personnalisation, langue) → `SPEC-ALERT-01`, `SPEC-LANG-01` ;
- le remboursement effectif en cas d'annulation après avertissement → `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` AC-3 ;
- un client ayant réservé après 18 h (non concerné par l'avertissement, mais par l'alerte site) → `SPEC-ALERT-01` cas limite 1 ;
- une panne du service SMS ou email au moment de l'envoi → `SPEC-SYST-01` ;
- l'annulation d'un client n'ayant pas reçu l'avertissement.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CANCEL_CLIENT_AVERTISSEMENT_04_trace_notification_avertissement_recu`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test déclenche l'envoi d'un avertissement pour une sortie donnée.
- [ ] Le test vérifie qu'une notification de type « avertissement » est créée et associée à la bonne réservation.
- [ ] Le test vérifie l'horodatage de la notification.
- [ ] Le test vérifie qu'une requête « ce client a-t-il reçu l'avertissement ? » retourne vrai après l'envoi.
- [ ] Le test vérifie qu'elle retourne faux pour un client n'ayant pas reçu l'avertissement.
- [ ] Le nom du test contient `CASE_CANCEL_CLIENT_AVERTISSEMENT_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas dépend d'un mécanisme de traçabilité (table
`Notification` ou équivalent) que le MCD V2 ne confirme pas encore — voir
« Ce qui n'est pas défini » de `SPEC-CANCEL-CLIENT-AVERTISSEMENT-03` (ligne 49).
Ce cas ne pourra pas être automatisé tel quel tant que ce point n'est pas
tranché avec le client ; il documente le comportement attendu en amont de
cette décision.
