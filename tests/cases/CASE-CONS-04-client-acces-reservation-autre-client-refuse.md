# CASE-CONS-04 — Un client ne peut pas accéder à la réservation d'un autre client

**Statut :** applicable
**Nom attendu :** `test_CASE_CONS_04`

**Spécification :** `SPEC-CONS-01`
**Critère d'acceptation :** — (cas limite 1, aucun AC direct de cette spec — voir remarque)
**Type :** acceptation
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège contre l'accès direct à la réservation d'un autre client, y
compris par manipulation d'un identifiant ou d'une URL. Si la règle se
casse, un client pourrait consulter des données personnelles et financières
appartenant à un autre client (fuite de données).

## Cas

```gherkin
Étant donné un client connecté (email : jean.edouard@email.fr)
Et une réservation appartenant à un autre client (identifiant : R-042)
Quand il tente d'accéder directement à la réservation R-042
Alors l'accès est refusé
```

## Données

| Élément                     |                Valeur |
| ------------------------------ | ---------------------: |
| Client connecté                 | jean.edouard@email.fr |
| Réservation ciblée               |                  R-042 |
| Propriétaire de la réservation   |          autre client |

## Résultat attendu, calculé à la main

| Grandeur          | Valeur attendue | Calcul                          |
| -------------------- | ---------------: | ------------------------------------ |
| Accès accordé          |               non | réservation n'appartenant pas au client |

## Ce que ce cas ne vérifie pas

- la consultation normale de ses propres réservations → `CASE-CONS-01` ;
- l'accès de l'employé ou de l'administrateur à cette même réservation (autorisé, cas différent) → `CASE-CONS-02`, `CASE-CONS-03`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_CONS_04_client_acces_reservation_autre_client_refuse`
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée une réservation appartenant à un client A.
- [ ] Le test connecte un client B distinct.
- [ ] Le test tente l'accès direct à la réservation du client A depuis le compte du client B.
- [ ] Le test vérifie que l'accès est refusé.
- [ ] Le nom du test contient `CASE_CONS_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner
**Remarques :** Ce cas ne correspond à aucun AC numéroté de `SPEC-CONS-01` —
il matérialise le « cas limite 1 » de cette spec (ligne 44), qui n'a pas de
critère d'acceptation dédié.
