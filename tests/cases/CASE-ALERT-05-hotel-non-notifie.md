# CASE-ALERT-05 — L'hôtel partenaire n'est pas notifié par SMS/mail

**Statut :** applicable
**Nom attendu :** `test_CASE_ALERT_05`

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** — (cas limite 4, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège le fait qu'un hôtel partenaire concerné par une annulation
météo n'est pas notifié comme un client particulier (SMS/mail), mais appelé
directement par le prestataire. Si la règle se casse, l'hôtel pourrait
recevoir un message générique inadapté à son statut de professionnel, ou le
prestataire pourrait à tort compter sur un SMS/mail qui ne sera jamais
envoyé, laissant l'hôtel sans information.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00
Et un hôtel partenaire ayant réservé 4 places sur ce créneau
Et 3 clients particuliers réservés sur le même créneau
Quand l'administrateur confirme l'annulation définitive de la sortie
Alors les 3 clients particuliers reçoivent un SMS et/ou un mail d'annulation
Et l'hôtel ne reçoit ni SMS ni mail
Et l'hôtel est signalé au prestataire comme étant à contacter par téléphone
```

## Données

| Élément                          |                    Valeur |
| ------------------------------------ | -------------------------: |
| Sortie concernée                     |    12 juillet 2026 à 10:00 |
| Places réservées par l'hôtel          |                          4 |
| Clients particuliers sur ce créneau   |                          3 |
| Canal de notification — clients       |               SMS et/ou mail |
| Canal de notification — hôtel         |     aucun (appel téléphonique) |

## Résultat attendu, calculé à la main

| Grandeur                                    | Valeur attendue | Calcul                        |
| ------------------------------------------------ | ---------------: | ---------------------------------- |
| Clients particuliers notifiés par SMS/mail          |             3 / 3 | tous les clients du créneau         |
| SMS/mail envoyé à l'hôtel                            |               non | l'hôtel est appelé, pas notifié     |
| Hôtel signalé au prestataire comme « à appeler »     |               oui | résultat de l'annulation            |

## Ce que ce cas ne vérifie pas

- l'appel téléphonique lui-même (action manuelle du prestataire, hors périmètre applicatif) ;
- la facturation de l'hôtel après annulation (réservation non comptabilisée) → `SPEC-FACT-01` ;
- le contenu du message envoyé aux clients particuliers → `CASE-ALERT-04` ;
- l'annulation par l'hôtel lui-même (l'hôtel ne peut pas annuler via l'application).

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_05_hotel_non_notifie_par_sms_ou_mail`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test confirme l'annulation d'un créneau comprenant à la fois des clients particuliers et une réservation hôtel.
- [ ] Le test vérifie que les clients particuliers reçoivent une notification SMS/mail.
- [ ] Le test vérifie qu'aucune notification SMS/mail n'est envoyée à l'hôtel.
- [ ] Le test vérifie qu'un signalement « à appeler » est produit pour l'hôtel.
- [ ] Le nom du test contient `CASE_ALERT_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-ALERT-01` —
il matérialise le « cas limite 4 » de cette spec (ligne 48), qui n'a pas de
critère d'acceptation dédié, comme signalé pour des cas similaires sur
`SPEC-CANCEL-CLIENT-AVERTISSEMENT-03`.
