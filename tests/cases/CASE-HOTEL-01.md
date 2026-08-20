# CASE-HOTEL-01 — Création d'un compte hôtel

**Statut :** remplacé

**Amendé par :** `CASE-HOTEL-01-A1`

> Ce cas est conservé pour l’historique. Le comportement actuellement applicable est défini dans `CASE-HOTEL-01-A1`.

**Spécification :** `SPEC-HOTEL-01`  
**Critère d'acceptation :** `AC-01`  
**Type :** acceptation  
**Niveau de risque :** moyen

## Ce que ce cas protège

Ce cas protège la création d'un compte hôtel permettant à l'hôtel de se connecter
et d'accéder à son espace. Si la règle se casse, l'hôtel ne peut pas consulter
ses créneaux ni ses réservations.

## Cas

```gherkin
Étant donné un hôtel partenaire
Quand le patron crée un compte hôtel (email de l'hôtel)
Alors le compte hôtel est créé
Et l'hôtel peut se connecter avec ses identifiants
```

## Données

| Élément | Valeur |
|---|---:|
| Email du compte | hotel@email.fr |
| Créateur | patron |

## Résultat attendu, calculé à la main

| Grandeur | Valeur attendue |
|---|---:|
| Compte créé | oui |
| Connexion possible | oui |

## Ce que ce cas ne vérifie pas

- la consultation des créneaux → `CASE-HOTEL-02` (AC-02) ;
- la consultation des réservations → `CASE-HOTEL-03` (AC-03) ;
- la réservation hôtel (qui passe par le patron) → `SPEC-BOOK-02`.

---

## Test automatisé

**Nom attendu :**
`test_CASE_HOTEL_01_creation_compte_hotel`  
**Fichier :** à renseigner après automatisation

## Revue du test automatisé

- [ ] Le test crée un compte hôtel.
- [ ] Le test vérifie que l'hôtel peut se connecter.
- [ ] Le nom du test contient `CASE_HOTEL_01`.
- [ ] Aucune assertion étrangère à ce cas n'a été ajoutée.

**Relu par :** à renseigner  
**Remarques :** à renseigner
