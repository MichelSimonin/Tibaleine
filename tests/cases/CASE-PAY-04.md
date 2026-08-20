# CASE-PAY-04 — La place est libérée après 15 minutes sans paiement

**Amendé par :** `CASE-PAY-04-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-PAY-04-A1`.

**Spécification :** `SPEC-PAY-01`  
**Critère d'acceptation :** `AC-04`  
**Type :** acceptation  
**Niveau de risque :** élevé

## Ce que ce cas protège

Ce cas protège la libération de la place lorsque le client ne paie pas dans les
15 minutes. Si la règle se casse, une place reste bloquée indéfiniment et n'est
plus réservable par les autres clients.

## Cas

```gherkin
Étant donné une place bloquée pendant la phase de paiement
Quand le client ne paie pas dans les 15 minutes
Alors la place redevient disponible
```

## Données

| Élément | Valeur |
|---|---:|
| Délai accordé | 15 minutes |
| Paiement effectué | non |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Place après expiration | disponible |

## Ce que ce cas ne vérifie pas

- l'enregistrement du paiement → `CASE-PAY-01` (AC-01) ;
- le passage à l'état « payée » → `CASE-PAY-02` (AC-02) ;
- la mise à jour des places après paiement → `CASE-PAY-03` (AC-03) ;
- le blocage initial de la place → `SPEC-BOOK-03`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_PAY_04_place_libérée_apres_15_minutes`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test bloque une place et n'effectue pas le paiement.
- [ ] Le test vérifie que la place redevient disponible après 15 minutes.
- [ ] Le nom du test contient `CASE_PAY_04`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
