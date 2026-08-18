# Plan de délégation — `SPEC-CANCEL-PRESTATAIRE-02`

> Reconstruit a posteriori à titre d'exemple, à partir du travail déjà fait le
> 2026-08-18. Pour les prochaines specs, écrire la partie « Avant » **avant**
> de confier la première tâche — un plan écrit après coup ne vaut rien (voir
> gabarit).
>
> **Ce plan documente un échec non résolu**, pas une réussite : contrairement
> aux autres plans de cette série, la tâche 2 ci-dessous n'a jamais été menée
> à terme malgré plusieurs signalements. C'est volontairement gardé tel quel
> plutôt que maquillé — c'est exactement le genre d'écart que ce document est
> censé rendre visible (voir gabarit, « Ce qui sera regardé »).

---

## Avant — le découpage

| # | Tâche | Test qui doit passer au vert | Ce que l'agent reçoit | Ce qu'il ne touche pas |
|---|---|---|---|---|
| 1 | Vérifier que le cas existant (`CASE-CANCEL-PRESTATAIRE-01`) teste bien ce que son titre annonce (l'envoi de l'avertissement à 18h, AC-1) | *(aucun — tâche d'audit)* | `SPEC-CANCEL-PRESTATAIRE-02`, `CASE-CANCEL-PRESTATAIRE-01` | les autres `SPEC-CANCEL-*` |
| 2 | Réécrire le contenu de `CASE-CANCEL-PRESTATAIRE-01` pour qu'il teste réellement AC-1, au lieu du scénario client <48h copié-collé | `CASE-CANCEL-PRESTATAIRE-01` | `SPEC-CANCEL-PRESTATAIRE-02`, `SPEC-ALERT-01` (référence, structure de cas comparable) | les autres `CASE-CANCEL-*` |

---

## Après — ce qui s'est passé

Complété a posteriori (voir remarque en tête de fichier) — normalement à
faire au rituel de 16h15, le même jour.

| # | Résultat | Ce qui a fait reprendre la main |
|---|---|---|
| 1 | `conforme` | L'audit a confirmé l'écart : le titre et « Ce que ce cas protège » parlent de l'envoi obligatoire de la notification à 18h côté prestataire (AC-1), mais le Gherkin, les Données et le Résultat attendu testent en réalité une annulation **client** avec 50 % de retenue — un contenu identique à `CASE-CANCEL-CLIENT-01`, jamais adapté au bon scénario. Le nom de test attendu (`test_CASE_CANCEL_01_...`) est lui aussi resté celui du cas client. |
| 2 | *(non réalisée)* | Signalée à trois reprises au fil de la session (revue initiale, vérification du 2026-08-18, revue complète du projet) sans jamais être reprise. Seul un nettoyage cosmétique a eu lieu entre-temps, fait par l'équipe : le H1 (`CASE-CANCEL-01` → `CASE-CANCEL-PRESTATAIRE-01`) et la référence spec (`SPEC-CANCEL_PRESTATAIRE-02` → `SPEC-CANCEL-PRESTATAIRE-02`) ont été corrigés, mais le contenu métier reste celui du cas client. Aucune des quatre valeurs du tableau ci-dessous ne décrit correctement cet état — d'où la mention littérale plutôt qu'une étiquette forcée. |

| Résultat | Sens |
|---|---|
| `conforme` | la tâche a produit ce qui était prévu, le test attendu est passé au vert |
| `repris` | le résultat a demandé une intervention manuelle avant d'être gardé |
| `redécoupé` | la tâche a dû être scindée ou reformulée, puis relancée |
| `abandonné` | la tâche a été retirée à l'agent et faite à la main |

---

## Ce qui sera regardé

Pas le nombre de `conforme`. Ce qui se lit, c'est **l'écart entre ce que vous aviez
prévu et ce qui est arrivé, et le fait que vous l'ayez vu**.

Une équipe avec quatre `repris` qui sait dire pourquoi pilote mieux qu'une équipe
avec six `conforme` qui n'a rien observé. Ce plan-ci a un statut « non réalisée » :
c'est le cas d'école que cette dernière phrase du gabarit vise à empêcher de
disparaître sous le tapis.
