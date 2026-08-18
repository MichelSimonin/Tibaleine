# CASE-DISP-05 — L'alerte météo est affichée sur le calendrier pour les créneaux concernés

**Spécification :** `SPEC-DISP-01`
**Critère d'acceptation :** — (cas limite 3, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège l'affichage, côté calendrier des créneaux disponibles, de
l'alerte météo déclenchée par `SPEC-ALERT-01`. Si la règle se casse, un
client consultant le calendrier après l'avertissement de 18 h pourrait
réserver un créneau à risque sans en être informé.

## Cas

```gherkin
Étant donné une sortie baleine le 12 juillet 2026 à 10:00
Et un avertissement météo envoyé le 11 juillet 2026 à 18:00 pour ce créneau
Quand un client consulte le calendrier après 18:00
Alors le créneau affiche toujours ses places restantes
Et une alerte météo est visible sur ce créneau
```

## Données

| Élément                     |                       Valeur |
| ------------------------------- | -----------------------------: |
| Sortie                           | baleine, 12 juillet 2026 10:00 |
| Avertissement météo envoyé        |    11 juillet 2026 à 18:00 |
| Consultation du calendrier         |     11 juillet 2026 à 20:00 |

## Résultat attendu, calculé à la main

| Grandeur              | Valeur attendue | Calcul                          |
| -------------------------- | ---------------: | -------------------------------------- |
| Créneau toujours réservable  |               oui | réservations maintenues pendant l'avertissement |
| Alerte météo visible          |               oui | avertissement déclenché pour ce créneau |

## Ce que ce cas ne vérifie pas

- le contenu et l'envoi de l'avertissement lui-même (SMS/mail) → `CASE-ALERT-01`, `CASE-ALERT-02` ;
- le comportement après une annulation définitive du créneau (créneau devient indisponible pour une autre raison) → `SPEC-CANCEL-PRESTATAIRE-02` ;
- la personnalisation ou la traduction du message d'alerte → `CASE-ALERT-03`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_DISP_05_alerte_meteo_affichee_calendrier`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test déclenche un avertissement météo pour un créneau donné.
- [ ] Le test consulte le calendrier après le déclenchement de l'avertissement.
- [ ] Le test vérifie que le créneau reste réservable (places affichées normalement).
- [ ] Le test vérifie qu'une alerte météo est visible sur ce créneau.
- [ ] Le nom du test contient `CASE_DISP_05`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-DISP-01` —
il matérialise le « cas limite 3 » de cette spec (ligne 44), qui n'a pas de
critère d'acceptation dédié.
