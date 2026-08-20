## SPEC-SYST-01 — Disponibilité des services externes

**Exigence :** REQ-020
**Statut :** modifiée (cahier des charges V5, `impact-CR-001.md`)
**Version :** v2
**Amendée par :** `SPEC-SYST-01-A1`

> Cette version est conservée pour l’historique. La règle actuellement applicable est définie dans `SPEC-SYST-01-A1`.


### Règle

> Le système vérifie la disponibilité des services externes utilisés par
> l'application (paiement, SMS, email) et gère leur indisponibilité afin qu'une
> panne d'un service tiers ne bloque ni ne perturbe le fonctionnement de
> l'application. Depuis le paiement fractionné (`SPEC-PAY-BALANCE-02`), ce
> périmètre couvre aussi l'envoi planifié du mail contenant le lien de
> paiement du solde (déclenché à H-24), la création et l'expiration de ce
> lien (à H-12), et la réception des webhooks de confirmation de paiement
> (acompte et solde) — y compris lorsqu'ils arrivent en retard ou pas du
> tout.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas la sécurité de l'application (failles) → `REQ-103`
- Ne couvre pas le paiement en ligne lui-même → `SPEC-PAY-01`, `SPEC-PAY-BALANCE-02`
- Ne couvre pas l'envoi des alertes/annulations → `SPEC-ALERT-01`
- Ne couvre pas la génération des justificatifs et factures → `SPEC-JUSTIF-01`

### Scénarios nominaux

```gherkin
Étant donné un service de paiement indisponible
Quand un client tente de payer
Alors le système gère l'indisponibilité sans panne
Et le client est informé du problème

Étant donné un service SMS indisponible
Quand un avertissement ou une annulation doit être envoyé
Alors le système gère l'indisponibilité sans bloquer l'application
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le service de paiement est indisponible | Le client ne peut pas payer mais l'application reste fonctionnelle (message d'erreur adapté). |
| 2 | le service SMS est indisponible lors d'une annulation | (À préciser) la notification est-elle reportée, passée en mail, ou perdue ? |
| 3 | le service email est indisponible | (À préciser) comportement dégradé attendu. |
| 4 | l'envoi planifié du mail de solde (H-24) échoue (service email indisponible à ce moment précis) | Le solde reste dû ; le patron doit pouvoir voir qu'un solde reste à encaisser malgré l'échec d'envoi (renvoi `SPEC-PAY-BALANCE-02` cas limite 5). |
| 5 | le webhook de confirmation d'un paiement (acompte ou solde) n'arrive jamais ou arrive en double | (À préciser) risque de double encaissement ou de paiement jamais reconnu — renvoi `SPEC-PAY-BALANCE-02` cas limite 3, nécessite une règle d'idempotence. |

### Ce qui n'est pas défini

- Comportement exact en cas de panne d'un service externe (ambiguïté du CR-04 §6).
- Stratégie de reprise (nouvelle tentative, file d'attente) en cas de panne.
- Stratégie de reprise spécifique pour un webhook de paiement manqué (nouvelle tentative du prestataire, requête de statut, ou réconciliation manuelle par le patron).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Le système détecte l'indisponibilité d'un service externe.
- [ ] AC-2 — Une panne d'un service externe ne bloque pas l'application.
- [ ] AC-3 — Le client est informé en cas d'indisponibilité du service concerné.
- [ ] AC-4 — L'échec de l'envoi planifié du mail de solde à H-24 n'empêche pas le patron de voir qu'un solde reste dû.
- [ ] AC-5 — Un webhook de confirmation de paiement manquant ou en double n'entraîne ni perte de paiement ni double encaissement.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| « Vérifie la disponibilité » : mécanisme de détection non défini (healthcheck, test au moment de l'appel ?) | à trancher | |
| Cas 2 et 3 (« à préciser ») : comportement en panne SMS/email non défini — cœur de la spec non validable en l'état | à trancher | Ambiguïté CR-04 §6 |
| AC-1 non testable sans mécanisme de détection défini | à trancher | |
| AC-3 « le client est informé » : comment informer si le canal (SMS/email) est en panne ? | à trancher | |
| Portée : renvoi vers `REQ-103` qui est une exigence, pas une spec | à trancher | Corriger le renvoi |
| Liste exacte des services externes et tableau de bord de disponibilité pour le patron non définis | à trancher | |
| Cahier des charges V5 : le paiement fractionné introduit un envoi planifié (mail H-24) et des webhooks de confirmation, absents du périmètre d'origine | tranchée | Règle et portée étendues ; cas limites 4 et 5 ajoutés, tous deux renvoyés vers `SPEC-PAY-BALANCE-02` pour le détail métier |

Les refus se reportent aussi dans `docs/journal.md`.
