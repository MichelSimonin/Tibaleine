## SPEC-JUSTIF-01 — Justificatif d'acompte et facture finale

**Exigence :** REQ-024
**Statut :** brouillon (cahier des charges V5, `impact-CR-001.md`)
**Version :** v1

### Règle

> Un justificatif est généré automatiquement après le paiement de l'acompte
> (`SPEC-PAY-01`). Une facture finale est générée après le paiement intégral
> du solde (`SPEC-PAY-BALANCE-02`), que ce paiement ait eu lieu en ligne ou
> sur place (R-099). Ces documents sont mis à disposition du client.

### Portée

Ce que cette spécification couvre, et surtout **ce qu'elle ne couvre pas**. Nommer
explicitement les cas voisins traités ailleurs, avec leur ID.

- Ne couvre pas le paiement de l'acompte lui-même → `SPEC-PAY-01`
- Ne couvre pas le paiement du solde lui-même → `SPEC-PAY-BALANCE-02`
- Ne couvre pas le calcul des montants (acompte, solde, remboursement) → `SPEC-PAY-01`, `SPEC-CANCEL-CLIENT-01`
- Ne couvre pas l'envoi des mails de paiement du solde → `SPEC-PAY-BALANCE-02`

### Scénarios nominaux

```gherkin
Étant donné une réservation dont l'acompte de 30 € vient d'être payé
Quand le paiement de l'acompte est confirmé
Alors un justificatif d'acompte est généré
Et il est mis à disposition du client

Étant donné une réservation dont le solde vient d'être réglé (en ligne ou sur place)
Quand le statut de paiement passe à « intégralement payé »
Alors une facture finale est générée
Et elle est mise à disposition du client
```

### Cas limites

Un cas limite par ligne, avec le comportement attendu.

| # | Situation | Comportement attendu |
|---|---|---|
| 1 | le solde est payé sur place, saisi manuellement par le patron | La facture finale est générée au moment de la saisie, comme pour un paiement en ligne. |
| 2 | une réservation est annulée avant le paiement du solde | Seul le justificatif d'acompte existe ; aucune facture finale n'est générée. |
| 3 | un remboursement (total ou partiel) intervient après la génération de la facture finale | (À préciser) faut-il un avoir ou un document rectificatif ? Non défini par le cahier V5. |
| 4 | le client demande à retélécharger un document déjà généré | (À préciser) accès permanent depuis l'espace client, ou génération à la demande ? |

### Ce qui n'est pas défini

- Format, numérotation et mentions légales exactes du justificatif et de la facture (cahier V5, question ouverte 19).
- Document rectificatif en cas de remboursement après facture finale (cas limite 3).
- Modalités d'accès et de conservation des documents pour le client (cas limite 4).
- Charte graphique des documents : aucune imposée (cohérent avec REQ-104), un format fonctionnel minimal est prévu selon l'analyse d'impact §9.

### Critères d'acceptation

Chacun doit être vérifiable sans interprétation, et donne lieu à au moins un cas
de test.

- [ ] AC-1 — Un justificatif est généré automatiquement après le paiement de l'acompte.
- [ ] AC-2 — Une facture finale est générée automatiquement après le paiement intégral du solde, quel que soit le canal (en ligne ou sur place).
- [ ] AC-3 — Les deux documents sont mis à disposition du client.
- [ ] AC-4 — Aucune facture finale n'est générée tant que le solde n'est pas intégralement réglé.

### Revue IA

Consigne utilisée :

> Analyse cette spécification. Recherche les ambiguïtés, contradictions,
> comportements non définis, cas limites oubliés et exigences impossibles à
> tester. Ne réécris pas la spécification.

| Remarque de l'IA | Décision | Motif |
|---|---|---|
| Nouvelle spec créée suite au cahier des charges V5 et à `docs/impacts/impact-CR-001.md` (§4) | tranchée | REQ-024 et R-099 n'avaient pas de spec dédiée |
| Format, numérotation et contenu légal des documents non définis | à trancher | Renvoi cahier V5, question ouverte 19 |
| Cas d'un remboursement après facture finale (avoir ou document rectificatif) | à trancher | Non couvert par le cahier V5 |
| Cette spec ne couvre que la génération, pas la comptabilité/fiscalité éventuelle des documents | OK | Hors périmètre du projet à ce stade (aucune exigence comptable/fiscale exprimée par le client) |

Les refus se reportent aussi dans `docs/journal.md`.
