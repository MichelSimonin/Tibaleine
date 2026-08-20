# CASE-MODIF-06 — Modification refusée hors capacité ou délai

**Spécification :** `SPEC-MODIF-01-A1`
**Critère d'acceptation :** `AC-7`
**Statut :** applicable

## Cas

```gherkin
Plan du scénario: modification refusée
Étant donné une réservation existante
Et une demande de modification <condition>
Quand le patron tente de l’enregistrer
Alors la modification est refusée
Et les participants, les montants et le solde restent inchangés

Exemples:
| condition |
| dépassant la capacité disponible |
| reçue après le délai autorisé |
```

## Test automatisé

**Nom attendu :** `test_CASE_MODIF_06_refus_capacite_delai`
