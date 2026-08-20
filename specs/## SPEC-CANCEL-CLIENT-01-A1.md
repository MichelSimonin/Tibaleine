## SPEC-CANCEL-CLIENT-01-A1 — Amendement : calcul et exécution d’une annulation client

**Exigence :** REQ-007, REQ-009
**Statut :** applicable
**Version :** A1
**Amende :** `SPEC-CANCEL-CLIENT-01`
**Motif :** fixer les bornes du barème, la base de calcul et le traitement d’un remboursement ou d’un complément.

### Règle applicable

Les frais d’annulation se calculent sur le montant initial de la réservation :

| Moment de l’annulation | Frais dus |
|---|---:|
| Plus de 7 jours avant le départ | 0 % du montant initial |
| De 7 jours à exactement 48 heures avant le départ | 25 % du montant initial |
| Moins de 48 heures avant le départ | 50 % du montant initial |

Les sommes effectivement encaissées sont comparées aux frais dus :

- si elles sont supérieures aux frais, la différence doit être remboursée ;
- si elles sont inférieures aux frais, la différence reste due par le client ;
- si elles sont égales aux frais, aucun mouvement supplémentaire n’est nécessaire.

Le complément dû est payable par un lien valable 24 heures, puis sur place s’il n’a pas été payé par ce lien.

Lorsqu’un remboursement est dû, le système en calcule le montant et le patron initie le remboursement. Le remboursement n’est enregistré comme effectué qu’après sa confirmation, et une même confirmation ne peut être enregistrée qu’une fois.

La réservation passe à l’état `annulée`. Une réservation dont le départ a déjà eu lieu ou qui est à l’état `réalisée` ne peut plus être annulée.

### Critères d’acceptation

- **AC-1** — Une annulation exactement 48 heures avant le départ applique 25 % de frais.
- **AC-2** — Chaque tranche calcule les frais sur le montant initial, puis déduit les sommes encaissées.
- **AC-3** — Un trop-perçu produit un montant à rembourser et le patron peut initier ce remboursement.
- **AC-4** — Un montant restant dû produit un lien de paiement valable 24 heures, puis reste payable sur place.
- **AC-5** — Une confirmation répétée du même remboursement ne crée pas un second remboursement.
- **AC-6** — Une réservation déjà annulée, réalisée ou dont le départ est passé ne peut pas être annulée de nouveau.
- **AC-7** — Une absence sans annulation formelle ne donne lieu à aucun remboursement.

### Hors périmètre

Cet amendement n’ajoute aucun report automatique après une annulation à l’initiative du client.
