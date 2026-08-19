# ADR-006 — Persistance

**Statut :** proposé 
**Date :** 19/08/2026
**Décidé par :** l'équipe 200ping

Un ADR conserve la trace d'une décision et de ses raisons : *voilà ce que nous
avons décidé, et pourquoi*. Il ne se réécrit pas quand on change d'avis — on en
crée un nouveau qui remplace celui-ci.

À distinguer :
- une **spec** dit ce que le système doit faire ;
- une **RFC** propose une manière de résoudre un problème, pour discussion ;
- un **ADR** enregistre une décision prise.

---

## Contexte

Le système doit stocker les réservations, les clients, les places disponibles, les paiements et les notifications.

On a besoin de :
- garder les données fiables,
- éviter les réservations doublées sur le même créneau,
- garder un historique de réservation et d'état de paiement,
- pouvoir faire des recherches simples sur les dates, les activités et les clients,
- faire évoluer le modèle sans tout réécrire.

Le projet a aussi des contraintes de gestion de places, de réservations simultanées et de facturation. Il faut un stockage qui supporte bien les transactions et les mises à jour cohérentes.

## Options envisagées

### Option A — Base de données PostgreSQL

| | |
|---|---|
| Ce qu'elle apporte | Stockage fiable, transactions, schéma clair, facile à faire évoluer. |
| Ce qu'elle coûte | Un peu plus de setup que des fichiers plats. |
| Ce qu'elle rend difficile plus tard | Il faut penser au schéma et aux migrations, mais c'est gérable. |

### Option B — Fichiers XML / JSON / système de fichiers

| | |
|---|---|
| Ce qu'elle apporte | Simple à mettre en place au départ. |
| Ce qu'elle coûte | Peu de structure, plus fragile, plus difficile à gérer correctement. |
| Ce qu'elle rend difficile plus tard | Risque de bugs sur les données, de conflits, de doublons et de lecture/écriture complexe. |

## Décision

Nous gardons les données dans une base de données PostgreSQL.

## Raisons

On choisit PostgreSQL parce que le projet a besoin d'un stockage sûr et structuré :
- les réservations doivent être cohérentes,
- les places doivent être mises à jour proprement,
- plusieurs utilisateurs peuvent réserver en même temps,
- les paiements et les notifications doivent rester liés aux bons états.

Un système de fichiers est trop limité pour ce type de besoin. Il est simple au début, mais il devient vite fragile quand il faut gérer plusieurs règles métier et plusieurs clients en même temps.

## Conséquences acceptées

- Il faut faire des migrations pour modifier le schéma.
- Le projet a une base de données à maintenir, pas seulement des fichiers.
- On doit prévoir les contraintes métier et les transactions dès le départ.

## Ce qui nous ferait revenir dessus

- Si le projet devait rester très simple, avec presque aucune donnée persistante et sans logique de réservation complexe, on pourrait revoir ce choix.
- Si l'équipe devait changer complètement de stack et ne pas utiliser de base relationnelle, alors il faudrait réexaminer cette décision.

---
