# ADR-007 — Cycle de vie d'une réservation : état et statut de paiement séparés

**Statut :** proposé
**Date :** 20/08/2026
**Décidé par :** l'équipe 200ping
**Remplace :** `ADR-003-cycle-de-vie-reservation.md`

Un ADR conserve la trace d'une décision et de ses raisons : *voilà ce que nous
avons décidé, et pourquoi*. Il ne se réécrit pas quand on change d'avis — on en
crée un nouveau qui remplace celui-ci.

---

## Contexte

`ADR-003` décrivait deux états (`payée | annulée`), hérités d'un paiement
intégral unique versé à la réservation. Le cahier des charges V5 (CR-05)
remplace ce paiement intégral par un acompte obligatoire (30 % standard /
50 % privatisation, `REQ-021`) suivi d'un solde différé, payable en ligne
entre H-24 et H-12 puis sur place (`REQ-022`, `REQ-023`).

Une réservation peut donc être confirmée (acompte payé) sans que son
financement soit complet, et le rester jusqu'à la prestation elle-même : le
règlement intégral du solde ne suffit pas à faire passer la réservation à
« réalisée ». Il faut désormais décrire deux questions indépendantes : où en
est la réservation (a-t-elle eu lieu, a-t-elle été annulée) et où en est son
financement (quelle part a été réglée) — alors qu'`ADR-003` ne portait qu'un
seul axe, adapté à l'ancien paiement en un bloc.

## Options envisagées

### Option A — Un seul axe étendu (`en_attente | acompte_payee | solde_payee | realisee | annulee`)

| | |
|---|---|
| Ce qu'elle apporte | un seul champ à interroger |
| Ce qu'elle coûte | mélange deux questions indépendantes : le règlement intégral du solde ne rend pas la prestation « réalisée » — il faudrait un état intermédiaire ambigu (« intégralement payée mais pas encore réalisée ») |
| Ce qu'elle rend difficile plus tard | le cas de l'hôtel (`R-101`), qui n'a pas d'acompte mais est bien « réservée » dès la création : il faudrait une exception au barème normal des états |

### Option B — Deux axes indépendants : état (`réservée \| réalisée \| annulée`) et statut de paiement (`en_attente_paiement \| acompte_paye \| integralement_paye \| rembourse`)

| | |
|---|---|
| Ce qu'elle apporte | chaque axe répond à une seule question ; le règlement intégral du solde ne modifie que le statut de paiement, jamais l'état (`R-101`) ; un hôtel est simplement « réservée » + « en attente de paiement », sans exception au modèle |
| Ce qu'elle coûte | deux champs à tenir cohérents plutôt qu'un seul |
| Ce qu'elle rend difficile plus tard | — |

## Décision

`Reservation.etat` vaut **`réservée` \| `réalisée` \| `annulée`** (`R-90`).
`Reservation.statut_paiement` vaut **`en_attente_paiement` \| `acompte_paye` \|
`integralement_paye` \| `rembourse`**, et évolue **indépendamment** de l'état
(`R-91`, `REQ-025`).

## Raisons

- le règlement complet du solde ne fait pas passer la réservation à
  « réalisée » — seule la prestation elle-même le fait (`R-101`,
  `SPEC-BOOK-01`, `SPEC-PAY-BALANCE-02`) : un seul axe empilé rendrait cette
  règle inexprimable sans état artificiel ;
- une réservation hôtel est « réservée » dès sa création, sans acompte,
  avec le statut « en attente de paiement » (`R-101`, `SPEC-BOOK-02`,
  `SPEC-BOOK-02-A1`) : le second axe absorbe cette exception sans complexifier
  le premier ;
- la facturation hôtel fait évoluer le statut de paiement à réception du
  règlement, jamais l'état de la réservation (`SPEC-FACT-01-A1`) — cohérent
  avec la séparation des deux axes.

## Conséquences acceptées

- deux champs à maintenir cohérents plutôt qu'un seul : un contrôle
  applicatif est nécessaire pour interdire toute transition d'état sans
  statut de paiement valide ;
- `ADR-003` est remplacé par le présent ADR — toute référence restante à un
  état `payée` (code, tests, documentation) est désormais fausse.

## Ce qui nous ferait revenir dessus

- si le client demandait un jour à distinguer plusieurs niveaux de
  « réalisée » (par exemple une prestation partiellement remboursée après
  coup).

## Note historique

Cet ADR corrige aussi une divergence documentaire : `docs/impacts/impact-CR-001.md`
a été écrit sur une version antérieure du cahier V5 et décrit encore l'ancien
modèle (état `payée`, trois statuts sans distinction état/paiement) sans avoir
été mis à jour après coup. Il ne doit plus être pris comme source sur ce point
— voir la Revue IA de `SPEC-BOOK-01`.
