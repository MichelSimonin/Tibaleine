# CASE-ALERT-06 — Panne du service SMS lors d'un avertissement

**Statut :** applicable
**Nom attendu :** `test_CASE_ALERT_06`

**Spécification :** `SPEC-ALERT-01`
**Critère d'acceptation :** — (cas limite 5, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la disponibilité de l'application en cas de panne du service
SMS externe au moment de l'envoi d'un avertissement. Si la règle se casse,
une panne d'un service tiers pourrait bloquer l'ensemble du parcours de
réservation ou d'annulation, ce qui va à l'encontre de `SPEC-SYST-01`.

## Cas

```gherkin
Étant donné une sortie prévue le 12 juillet 2026 à 10:00
Et un risque de mauvaises conditions météo
Et que le service SMS externe est indisponible
Quand l'administrateur déclenche l'avertissement le 11 juillet 2026 à 18:00
Alors le système tente l'envoi par SMS et détecte l'échec
Et le système gère l'indisponibilité sans bloquer le reste de l'application
```

## Données

| Élément                   |                    Valeur |
| ------------------------------ | -------------------------: |
| Sortie concernée               |    12 juillet 2026 à 10:00 |
| Service SMS                    |               indisponible |
| Service mail                   |                  disponible |
| Avertissement déclenché        |    11 juillet 2026 à 18:00 |

## Résultat attendu, calculé à la main

| Grandeur                                       | Valeur attendue        | Calcul                          |
| --------------------------------------------------- | ------------------------: | ------------------------------------ |
| Application bloquée par la panne SMS                   |                      non | comportement exigé par `SPEC-SYST-01` |
| Comportement de repli (mail, nouvelle tentative, perte) | (à préciser)             | non défini par la spec                |

## Ce que ce cas ne vérifie pas

- l'envoi normal de l'avertissement sans panne → `CASE-ALERT-01` ;
- une panne du service mail (non traitée par ce cas) ;
- le mécanisme général de détection de disponibilité des services externes → `SPEC-SYST-01` ;
- l'annulation définitive en cas de panne SMS (scénario symétrique côté annulation).

---

## Test automatisé

**Nom attendu :**
`test_CASE_ALERT_06_panne_service_sms_application_non_bloquee`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test simule l'indisponibilité du service SMS au moment de l'envoi de l'avertissement.
- [ ] Le test vérifie que la tentative d'envoi échoue proprement (pas d'exception non gérée).
- [ ] Le test vérifie que le reste de l'application reste fonctionnel (pas de blocage).
- [ ] Le nom du test contient `CASE_ALERT_06`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-ALERT-01` —
il matérialise le « cas limite 5 » de cette spec (ligne 49). Le comportement
exact de repli (nouvelle tentative, bascule sur mail, ou perte de la
notification) est explicitement marqué « à préciser » dans la spec (« Ce qui
n'est pas défini », ligne 53, ambiguïté CR-04 §6) et recoupe le point encore
ouvert de `SPEC-SYST-01`. Ce cas ne vérifie donc que la non-régression sur le
non-blocage de l'application, pas le comportement de repli lui-même — à
compléter une fois ce point tranché avec le client.
