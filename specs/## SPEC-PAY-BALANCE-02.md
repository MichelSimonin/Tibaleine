## SPEC-PAY-BALANCE-02 — Paiement du solde

**Exigence :** REQ-022, REQ-023
**Statut :** brouillon (cahier des charges V5, corrigée après revue du modèle d'état R-90/R-91/R-101)
**Version :** v2

### Règle

> Le solde restant (montant total moins l'acompte déjà payé, `SPEC-PAY-01`)
> se règle selon la date de la réservation par rapport au départ. Pour une
> réservation créée plus de 24 h avant le départ, un lien de paiement du
> solde est envoyé automatiquement 24 h avant le départ et devient
> inutilisable 12 h avant (R-085). Entre 24 h et 12 h avant le départ, le
> client peut payer la totalité en ligne ou régler le solde sur place
> (R-086). À moins de 12 h du départ, le solde se paie uniquement sur place
> (R-087). Le patron peut enregistrer manuellement un paiement de solde fait
> sur place ; l'acompte, lui, ne peut jamais être enregistré de cette
> manière (R-088). Si le solde exigible n'est pas payé, le client ne peut
> pas embarquer et la réservation est annulée (R-089).
>
> **Le règlement du solde ne change pas l'état de la réservation** — elle
> reste « réservée ». Il fait uniquement passer le statut de paiement de
> « acompte payé » à « intégralement payé ». L'état ne devient « réalisée »
> qu'après la prestation elle-même (R-101, hors périmètre de cette spec).

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le paiement de l'acompte → `SPEC-PAY-01`
- Ne couvre pas le calcul des frais d'annulation → `SPEC-CANCEL-CLIENT-01`
- Ne couvre pas le recalcul du solde après ajout/suppression de participant → `SPEC-MODIF-01`
- Ne couvre pas la génération de la facture finale → `SPEC-JUSTIF-01`
- Ne couvre pas la vérification de disponibilité du service d'envoi de mail → `SPEC-SYST-01`

### Scénarios nominaux

```gherkin
Étant donné une réservation « réservée » (acompte payé) pour un départ dans 5 jours
Quand l'échéance H-24 est atteinte
Alors un lien de paiement du solde est envoyé automatiquement au client

Étant donné un lien de paiement du solde envoyé à H-24
Quand le client paie le solde en ligne avant H-12
Alors la réservation reste à l'état « réservée »
Et le statut de paiement passe à « intégralement payé »

Étant donné un lien de paiement du solde arrivé à expiration (H-12)
Quand le client se présente le jour de la prestation
Alors le patron enregistre manuellement le paiement du solde sur place
Et le statut de paiement passe à « intégralement payé » (l'état reste « réservée »)
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | réservation créée entre 24 h et 12 h avant le départ | Pas de fenêtre H-24 possible : le client paie l'acompte en ligne à la réservation, puis peut payer la totalité en ligne immédiatement ou attendre de régler le solde sur place (R-086). |
| 2 | réservation créée à moins de 12 h avant le départ (mais plus de 2 h, cf. `SPEC-BOOK-01` cas limite 2) | Le solde ne peut être payé que sur place, aucun lien n'est envoyé (R-087). |
| 3 | le client clique sur « Payer » juste avant H-12, mais la confirmation du paiement (validation 3D-Secure, webhook du prestataire) arrive après que le lien a été marqué expiré | (À préciser) le paiement a été débité mais le système considère le solde toujours dû — une règle d'idempotence et un délai de grâce sur la confirmation sont nécessaires pour ne pas facturer deux fois ni perdre le paiement (cf. analyse d'impact §8). |
| 4 | le solde n'est ni payé en ligne ni sur place | Le client ne peut pas embarquer, la réservation passe à l'état « annulée » (R-089). |
| 5 | l'envoi du mail contenant le lien échoue (service indisponible) | Le solde reste dû ; le patron doit pouvoir voir qu'un solde reste à encaisser malgré l'échec d'envoi (analyse d'impact §8). |

### Ce qui n'est pas défini

- Fuseau horaire et précision (à la minute ou non) du calcul des échéances H-24 / H-12 (cahier V5, question ouverte 20).
- Contenu exact du mail de paiement du solde (cahier V5, question ouverte 18).
- Moyens de paiement acceptés pour le solde sur place (cahier V5, question ouverte 22).
- Règle d'idempotence en cas de paiement en ligne et sur place quasi simultanés (cas limite 3).
- Comportement précis en cas d'échec d'envoi du mail à H-24 (cas limite 5).

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Pour une réservation créée plus de 24 h avant le départ, un lien de paiement du solde est envoyé automatiquement à H-24.
- [ ] AC-2 — Le lien de paiement du solde devient inutilisable à H-12.
- [ ] AC-3 — Le client peut payer le solde en ligne entre H-24 et H-12.
- [ ] AC-4 — Le patron peut enregistrer manuellement un paiement du solde effectué sur place.
- [ ] AC-5 — L'acompte ne peut jamais être enregistré comme payé sur place (seul le solde).
- [ ] AC-6 — Si le solde n'est pas payé (ni en ligne, ni sur place), le client ne peut pas embarquer et la réservation passe à l'état « annulée ».
- [ ] AC-7 — Une réservation créée à moins de 24 h du départ suit la règle adaptée (paiement total en ligne possible entre 24h et 12h, sinon solde sur place uniquement).
- [ ] AC-8 — Le règlement du solde (en ligne ou sur place) fait passer le statut de paiement à « intégralement payé » sans changer l'état de la réservation, qui reste « réservée » jusqu'à la prestation.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Nouvelle spec créée suite au cahier des charges V5 et à `docs/impacts/impact-CR-001.md` (§4) | tranchée | Sépare le solde de l'acompte (`SPEC-PAY-01`) pour ne pas mélanger deux mécanismes de paiement distincts |
| Le cas limite 3 imaginait un paiement « exactement » à H-12 — pas réaliste, aucun clic ne tombe pile sur l'instant d'expiration | corrigée | Reformulé : le vrai risque est le délai de confirmation asynchrone (3D-Secure, webhook) d'un paiement initié juste avant H-12 mais confirmé après |
| Risque de double encaissement si la confirmation d'un paiement en ligne arrive après l'expiration du lien, pendant que le solde est aussi collectable sur place | à trancher | Nécessite une règle d'idempotence et un délai de grâce sur la confirmation, avant l'implémentation (cas limite 3) |
| Comportement en cas d'échec d'envoi du mail à H-24 non défini | à trancher | Renvoi `SPEC-SYST-01` ; le solde ne doit pas être perdu de vue côté patron |
| Fuseau horaire et précision des échéances H-24/H-12 non définis | à trancher | Renvoi cahier V5, question ouverte 20 |

Les refus se reportent aussi dans `docs/journal.md`.
