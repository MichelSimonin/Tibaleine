# Librairies recommandées — TI Baleine App

| Informations | Détails |
|---|---|
| **Projet** | TI Baleine App |
| **Équipe** | 200ping |
| **Date** | 20/08/2026 |
| **Stack cible** | PHP / Symfony / Doctrine (ADR-001-stack) |
| **Source** | `Cahier_des_charges_200ping_V5.md`, ADR-001, MCD/MLD V3 |

> Ce document référence les librairies utiles au projet, cohérentes avec la
> stack retenue (Symfony/Doctrine, ADR-001) et reliées aux besoins du cahier des
> charges. Le §2 détaille l'exemple demandé : l'envoi automatisé de SMS/Email
> pour les réservations.

---

## 1. Vue d'ensemble

| Besoin | REQ / règle | Librairie | Paquet Composer | Rôle |
|---|---|---|---|---|
| **SMS + Email automatisés** (confirmation, avertissement météo, annulation, lien de solde) | REQ-016/017/018, R-73 | **Symfony Notifier** + **Mailer** | `symfony/notifier`, `symfony/mailer` | Abstraction unifiée des canaux SMS/Email, avec ponts vers les prestataires |
| **Planification temporelle** (alerte 18 h, fenêtre 24 h → 12 h) | REQ-016/022, R-67 | Symfony Messenger + Cron | `symfony/messenger` | Envois asynchrones et rappels planifiés |
| **Paiement en ligne** (acompte 30 %/50 %, solde, remboursement) | REQ-006/021/023/024, R-42 | Stripe SDK PHP | `stripe/stripe-php` | Checkout, webhooks, idempotence (REQ-108) |
| **Génération PDF** (justificatif d'acompte, facture finale) | REQ-024, R-99 | Dompdf (ou KnpSnappy) | `dompdf/dompdf` | Factures et justificatifs PDF |
| **Internationalisation FR/EN** (interface, alertes, messages) | REQ-014/107, R-71 | Symfony Translation | composant intégré (`symfony/translation`) | Catalogues de traductions |
| **Authentification & rôles** (client / employé / patron, hôtel) | REQ-003/102 | Symfony Security | `symfony/security-bundle` | Login, rôles, contrôles d'accès |
| **Formulaires & validation** (inscription, réservation) | REQ-001/002, R-18 | Symfony Form + Validator | `symfony/form`, `symfony/validator` | Saisie et validation des données |
| **Appels services externes** + gestion d'indisponibilité | REQ-020, REQ-103 | Symfony HttpClient | `symfony/http-client` | Appels Stripe, SMS, email, avec timeout/retry |
| **Tests** | — | PHPUnit + Fixtures (+ Panther) | `symfony/test-pack`, `doctrine/doctrine-fixtures-bundle` | Tests TDD, jeux de données, tests E2E |
| **Performance / cache** | REQ-100 | Symfony Cache + Profiler | `symfony/cache`, `symfony/profiler-pack` | Temps de réponse < 2 s, débogage |

---

## 2. Focus — Notifications SMS / Email automatisées

Pour les réservations, le système doit envoyer automatiquement des messages :
confirmation de prise en charge, avertissement météo la veille à 18 h,
annulation de sortie, lien de paiement du solde — le tout **en français et en
anglais** selon la langue du client (R-71, SPEC-LANG-01).

### 2.1 Emails — Symfony Mailer

La brique officielle pour tout envoi d'email, directement branchée sur
Symfony. On choisit un prestataire via un « bridge » (pont) :

| Bridge | Paquet | Usage |
|---|---|---|
| Brevo (ex-Sendinblue) | `symfony/brevo-mailer` | Europe, prix abordable, bon pour une petite structure |
| Mailjet | `symfony/mailjet-mailer` | Alternative européenne |
| SendGrid | `symfony/sendgrid-mailer` | International |
| Amazon SES | `symfony/amazon-mailer` | Volume + faible coût |
| SMTP simple | — | Envoi via le SMTP de l'hébergeur (zéro coût) |

**Exemple d'usage** (confirmation de réservation) :

```php
// src/Service/NotificationService.php
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

public function envoyerConfirmation(Reservation $r): void
{
    $email = (new Email())
        ->from('no-reply@tibaleine.re')
        ->to($r->getUtilisateur()->getEmail())
        ->subject($this->trad->trans('confirmation.sujet', [], null, $r->getUtilisateur()->getLangue()))
        ->html($this->templating->render('emails/confirmation.html.twig', ['reservation' => $r]));

    $this->mailer->send($email);
}
```

### 2.2 SMS — Symfony Notifier (+ bridge Twilio ou Vonage)

Pour l'avertissement météo et les annulations (SMS + email, R-73). La
recommandation est d'utiliser **`symfony/notifier`** comme couche unique pour
tous les canaux (SMS, email, push) — on change de prestataire sans réécrire le
code :

| Canal | Paquet | Remarques |
|---|---|---|
| SMS via **Twilio** | `symfony/notifier`, `symfony/twilio-notifier` | Le plus répandu, API simple |
| SMS via **Vonage** (ex-Nexmo) | `symfony/notifier`, `symfony/vonage-notifier` | Bonne couverture internationale |
| Canal email (via Mailer) | `symfony/mailer-notifier` | Unifie email + SMS dans le même composant |

**Exemple d'usage** (avertissement météo la veille à 18 h, dans la langue du
client) :

```php
// src/Service/AlertMeteoService.php
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;

public function alerter(Utilisateur $client, Sortie $sortie): void
{
    $msg = $this->trad->trans('meteo.avertissement', [], null, $client->getLangue());

    $notification = (new Notification($msg, ['sms', 'email']))
        ->content($sortie->getType() . ' — ' . $sortie->getDate()->format('d/m/Y H:i'));

    $this->notifier->send($notification, new Recipient($client->getEmail(), $client->getTelephone()));
}
```

### 2.3 Planification : alerte 18 h la veille et fenêtre 24 h → 12 h

L'envoi n'est pas immédiat : il doit avoir lieu **la veille à 18 h** (REQ-016,
R-67) et le lien de paiement du solde doit être envoyé **24 h avant** le départ
puis devenir inutilisable **12 h avant** (REQ-022). On utilise **Messenger**
(rendu asynchrone, fiable) + une tâche planifiée (cron) :

```yaml
# config/packages/messenger.yaml
framework:
    messenger:
        transports:
            async: '%env(MESSENGER_TRANSPORT_DSN)%'   # ex. Doctrine
        routing:
            'App\Message\EnvoyerAlerteMeteo': async
            'App\Message\EnvoyerLienSolde': async
```

```text
# crontab (exemple) — scan des sorties du lendemain / des échéances
0 18 * * *  php bin/console app:envoi-alerte-meteo
* * * * *   php bin/console messenger:consume async
```

### 2.4 Multilingue FR/EN

Le contenu des messages est traduit selon la langue du client (R-71, REQ-107).
Le composant **Translation** est intégré à Symfony : on prépare un catalogue
`messages.fr.yaml` et `messages.en.yaml`, et on passe la langue du client en
contexte (comme dans les exemples ci-dessus).

---

## 3. Paiement — Stripe

- **Paquet** : `stripe/stripe-php`.
- **Usage** : paiement de l'acompte en ligne (REQ-006/021), solde en ligne entre
  24 h et 12 h (REQ-022), remboursement tracé par le patron (REQ-009).
- **Webhooks** : utiliser la vérification de signature et l'**idempotence** pour
  ne jamais enregistrer deux fois une même opération (REQ-108).

```php
$session = \Stripe\Checkout\Session::create([
    'mode' => 'payment',
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'unit_amount' => (int) round($acompte * 100), // montant en centimes
            'product_data' => ['name' => 'Acompte ' . $reservation->getReference()],
        ],
        'quantity' => 1,
    ]],
    'success_url' => $urlSucces,
    'cancel_url' => $urlAnnulation,
]);
```

---

## 4. Génération PDF — justificatif d'acompte et facture finale

- **Recommandé** : `dompdf/dompdf` (rendu HTML → PDF, aucun binaire externe).
- **Alternative** : `knplabs/knp-snappy` (nécessite `wkhtmltopdf`).
- **Usage** : générer le justificatif après l'acompte et la facture finale après
  le paiement intégral (REQ-024, R-99) ; chaque document est tracé dans la table
  `Document` (référence unique, date d'émission).

```php
$dompdf = new \Dompdf\Dompdf();
$dompdf->loadHtml($this->templating->render('facture/facture.html.twig', ['facture' => $f]));
$dompdf->render();
$pdf = $dompdf->output(); // à stocker / télécharger
```

---

## 5. Sécurité & rôles

- **Paquet** : `symfony/security-bundle`.
- **Usage** : connexion (REQ-003), trois rôles `utilisateur` / `employe` /
  `administrateur` + profil hôtel (REQ-102), blocage des fonctions interdites.
- **Optionnel** : double authentification `scheb/2fa-bundle` (non requis par le
  cahier, à trancher).

---

## 6. Tests

- **Paquet** : `symfony/test-pack` (PHPUnit), `doctrine/doctrine-fixtures-bundle`
  (jeux de données), `hautelook/alice-bundle` (fixtures en YAML), éventuellement
  `symfony/panther` (tests navigateur).
- **Usage** : les tests TDD du dossier `tests/` couvrent les cas de réservation,
  annulation, paiement et notifications.

---

## 7. Performance & cache

- **Paquets** : `symfony/cache`, `symfony/profiler-pack`.
- **Usage** : garder le temps de réponse < 2 s en 4G (REQ-100) — cache des
  créneaux disponibles, cache des traductions.

---

## 8. Points d'attention

- **Choisir le prestataire SMS/email selon la localisation** (l'entreprise est à
  la Réunion) : vérifier la couverture et les tarifs d'envoi vers les numéros
  locaux avant de fixer Twilio vs Vonage vs Brevo.
- **Cohérence avec le modèle** : chaque opération financière (acompte, solde,
  complément, remboursement) est tracée dans `Paiement` ; chaque envoi est tracé
  dans `Notification` — les librairies ne remplacent pas ces tables, elles
  alimentent les services qui les remplissent.
- **Aucune librairie ne remplace la traçabilité** exigée par REQ-108 : utiliser
  l'idempotence côté paiement et horodater chaque notification.
