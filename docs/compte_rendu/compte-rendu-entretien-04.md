# Compte rendu n°4

Date : 14/08/2026
Durée : 15 min
Interlocuteur : Monsieur Ti Baleine
Présents pour l'équipe : Emie, Michel, Maxime et Kery

## 1. Ce que le client a dit

Le client souhaite mettre en place un système permettant de prévenir les clients en amont lorsqu'une sortie risque d'être annulée, notamment à cause de mauvaises conditions météo. L'objectif est de ne plus avoir à prévenir les clients à la dernière minute.

Un avertissement serait envoyé la veille à 18 h, par SMS et/ou par mail, afin d'indiquer qu'une annulation est potentiellement possible. À ce stade, la sortie n'est pas encore annulée et les réservations restent ouvertes. Si aucune nouvelle information n'est communiquée après cet avertissement, alors la sortie est considérée comme maintenue.

Le client souhaite également qu'une alerte soit visible directement sur le site ou l'application, notamment pour les personnes qui souhaiteraient réserver après 18 h et qui n'auraient donc pas reçu l'avertissement. Cette alerte pourrait indiquer qu'il existe un risque de mauvaises conditions météo et que le client peut annuler sa réservation sans frais.

Les messages doivent pouvoir être envoyés en français et en anglais, depuis le numéro portable de la société, avec la possibilité de générer un message personnalisé depuis l'application.

Si l'annulation est finalement confirmée, elle peut être décidée tôt le matin, autour de 5 h, tout en veillant à prévenir les clients suffisamment tôt avant le départ. L'annulation peut concerner un seul créneau, plusieurs créneaux, une journée entière ou plusieurs jours. Il doit donc être possible d'annuler séparément les créneaux de 7 h, 10 h ou 14 h.

Les raisons d'une annulation peuvent être liées à la météo, à une décision du skipper, à une cause technique ou à une cause humaine. Le système doit donc permettre d'indiquer le motif de l'annulation.

Lorsqu'une annulation est décidée par l'administrateur, le client souhaite que les clients concernés soient automatiquement prévenus par SMS et/ou par mail. En cas d'annulation par l'administrateur, le remboursement doit être systématique et à 100 %.

Si un client décide lui-même d'annuler sa réservation après avoir reçu l'avertissement de mauvaises conditions météo, il doit également pouvoir bénéficier d'un remboursement à 100 %.

Après une annulation, le client peut choisir entre un remboursement ou un report de la sortie à une autre date ou un autre horaire. C'est au client de revenir vers le prestataire afin d'indiquer son choix.

Concernant les réservations provenant des hôtels, le fonctionnement actuel doit être conservé. Une personne de l'hôtel est responsable du groupe et les hôtels ne sont pas concernés par les SMS ou mails automatiques. L'avertissement continue donc à se faire par appel téléphonique.

Le client souhaite également mettre en place un système de blocage temporaire des places pendant une réservation afin d'éviter que deux personnes achètent la même place en même temps. La place doit être bloquée dès que l'utilisateur clique sur « Réserver » et arrive sur le formulaire. Lorsqu'il passe au paiement, un délai d'environ 15 minutes lui est accordé. Si le paiement n'est pas effectué dans ce délai, la place redevient disponible.

Des tests devront être effectués afin de vérifier le comportement du système lorsque plusieurs utilisateurs tentent de réserver en même temps.

Le client souhaite aussi prévoir un badge ou une indication lorsqu'une nouvelle place devient disponible sur le site, notamment lorsqu'une annulation libère une place alors qu'un utilisateur avait précédemment été informé qu'il n'y avait plus de disponibilité.

Enfin, il souhaite que le système puisse vérifier la disponibilité des services externes utilisés par l'application et gérer correctement les situations dans lesquelles l'un de ces services serait temporairement indisponible.

## 2. Questions posées et réponses obtenues

| Id  | Question posée                                                                                                          | Réponse                                                                                                                                                                                                                                                |
| --- | ----------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Q48 | Quand faut-il prévenir les clients en cas de potentielles mauvaises conditions météo ?                                  | Il faut envoyer un avertissement la veille à 18 h pour dire que potentiellement la sortie peut être annulée. L'objectif est de ne plus devoir prévenir à la dernière minute. Au moment de la prévention, il n'y a pas encore d'annulation. Si rien n'est dit après l'avertissement, alors la sortie est maintenue. |
| Q49 | Par quel moyen faut-il envoyer l'avertissement ?                                                                         | L'avertissement doit être envoyé par SMS et/ou par mail. Le message pourra être un message personnalisé généralisé depuis l'application. Le SMS doit être envoyé depuis le numéro portable de la société.                                               |
| Q50 | Pour quelles raisons peut-on envoyer un avertissement et/ou annuler une sortie ?                                         | la météo ; une décision du skipper ; des causes techniques ; des causes humaines. Il faut donc avoir la possibilité d'indiquer un motif.                                                                                                                 |
| Q51 | Que doit contenir l'avertissement envoyé au client ?                                                                     | Le message doit prévenir qu'il y a de potentielles mauvaises conditions météo pour le lendemain. Il faut également prévoir le message en français et en anglais.                                                                                          |
| Q52 | Faut-il afficher une alerte directement sur le site ?                                                                    | Oui. Il faut avoir la possibilité de faire une alerte sur l'application / le site concernant le mauvais temps, notamment pour les personnes qui voudraient réserver après 18 h.                                                                          |
| Q53 | Est-ce que les réservations restent possibles après l'envoi de l'avertissement ?                                         | Oui. Au moment de l'avertissement, il n'y a pas encore d'annulation et il est encore possible de réserver. Les réservations sont donc maintenues tant qu'aucune annulation définitive n'a été décidée.                                                   |
| Q54 | Quand l'annulation définitive est-elle décidée ?                                                                         | S'il y a effectivement une annulation, elle peut être décidée vers 5 h. L'annulation définitive doit être communiquée au client avant la sortie. Il avait également été indiqué : toujours 2 h avant. Au moment du vrai message d'annulation, la sortie est réellement annulée. |
| Q55 | Peut-on annuler seulement certains créneaux de la journée ?                                                              | Oui. Les sorties peuvent être annulées sur toute la journée ou sur plusieurs jours. Il faut également pouvoir annuler indépendamment chaque créneau. Il doit donc être possible d'annuler le créneau de 7 h et/ou 10 h et/ou 14 h.                         |
| Q56 | Que se passe-t-il lorsqu'une annulation est décidée par l'administrateur ?                                               | Si l'administrateur annule une sortie, le système doit automatiquement envoyer un SMS et/ou un mail aux clients concernés. Les clients concernés sont tous prévenus au même moment.                                                                      |
| Q57 | Que se passe-t-il pour le remboursement lorsqu'une sortie est annulée par l'administrateur ?                             | Si l'administrateur annule, le client doit bénéficier d'un remboursement à 100 %. Le remboursement est systématique.                                                                                                                                    |
| Q58 | Que se passe-t-il si le client souhaite annuler après avoir reçu l'avertissement ?                                       | Si le client annule pendant la phase d'avertissement, il est également remboursé à 100 %. L'alerte doit donc lui indiquer qu'il a la possibilité d'annuler sa réservation sans frais.                                                                     |
| Q59 | Que peut faire le client après une annulation de la sortie ?                                                             | Le report ou le remboursement dépend de la volonté du client. En cas d'annulation à cause de la météo, c'est au client de revenir vers le prestataire afin de demander un remboursement ou un report de la sortie à une date ultérieure. Le client fait donc l'initiative de revenir pour un changement d'horaire, un changement de date ou un remboursement. |
| Q60 | Comment gérer les réservations provenant des hôtels ?                                                                    | Pour les hôtels, le fonctionnement actuel est conservé. Il y a une personne de l'hôtel en charge du groupe. Les hôtels ne sont pas concernés par les SMS / mails automatiques. Pour les hôtels, on garde donc les appels téléphoniques. L'avertissement se fait directement par appel uniquement pour les hôtels. |
| Q61 | Comment éviter que deux clients achètent la même place au même moment ?                                                  | Il faut mettre en place un blocage temporaire de la réservation. La place doit être bloquée dès le début du clic sur « Réserver », à l'arrivée sur le formulaire. Au clic sur « Payer », un temps limité doit être donné au client, par exemple 15 minutes. Au-delà de ces 15 minutes, si le paiement n'a pas été effectué, la place redevient libre. Ce blocage permet d'éviter que deux clients achètent la même place. |
| Q62 | Que faire lorsqu'une nouvelle place devient disponible ?                                                                 | Il faut prévoir un badge lorsqu'une nouvelle place arrive sur le site. Cela concerne notamment les cas spéciaux où une annulation fait apparaître une nouvelle place alors qu'on avait auparavant averti l'utilisateur qu'il n'y avait plus de place.    |
| Q63 | Que faut-il prévoir concernant les services externes ?                                                                   | Il faut vérifier si les services externes sont disponibles. Il faut également gérer les cas où les services externes ne sont pas disponibles, notamment pour éviter qu'une indisponibilité d'un service externe bloque ou perturbe le fonctionnement du système. |

## 3. Ce que nous avons compris

Nous avons compris que le système devra permettre de gérer une phase d'avertissement distincte d'une annulation définitive. Lorsqu'un risque est identifié, notamment en cas de mauvaises conditions météorologiques, l'administrateur pourra déclencher un avertissement la veille à 18 h. Les clients concernés seront alors informés par SMS et/ou par mail, mais leur réservation restera active tant qu'aucune annulation définitive n'aura été décidée.

Une alerte devra également être affichée sur le site afin d'informer les personnes qui souhaitent effectuer une réservation après l'envoi de l'avertissement. Les réservations resteront donc possibles pendant cette phase.

En cas d'annulation définitive, l'administrateur devra pouvoir sélectionner précisément les sorties concernées : un créneau particulier, plusieurs créneaux, une journée entière ou plusieurs jours. Il devra également pouvoir préciser la raison de l'annulation, par exemple la météo, une cause technique, humaine ou une décision du skipper.

Lorsqu'une sortie est annulée, le système devra prévenir automatiquement l'ensemble des clients concernés, par SMS et/ou par mail. Les messages devront pouvoir être proposés en français et en anglais.

Nous avons également compris qu'un client pourra annuler sans frais après avoir reçu un avertissement, avec un remboursement à 100 %. En cas d'annulation de la sortie par le prestataire, le client devra également pouvoir bénéficier d'un remboursement à 100 % ou demander un report de sa sortie.

Les réservations provenant des hôtels devront être traitées différemment : la personne responsable du groupe au sein de l'hôtel continuera à être prévenue directement par téléphone et ne sera pas concernée par les notifications automatiques prévues pour les clients classiques.

Concernant la réservation, nous avons compris qu'il faudra mettre en place un système de blocage temporaire des places afin d'éviter que plusieurs clients puissent acheter la même place simultanément. Une place sera temporairement réservée pendant le parcours de réservation et un délai d'environ 15 minutes sera accordé au moment du paiement. Une fois le délai dépassé, la place devra redevenir disponible si le paiement n'a pas été effectué.

Lorsqu'une place devient de nouveau disponible, notamment à la suite d'une annulation, le site devra pouvoir mettre en avant cette nouvelle disponibilité, par exemple à l'aide d'un badge.

Enfin, le système devra être capable de détecter et gérer l'indisponibilité des services externes afin qu'une panne d'un service tiers ne provoque pas un comportement incorrect de l'application.

## 4. Parties prenantes identifiées

| Personne / rôle       | Ce qu'elle fait                                                                  | Comment on l'a découverte                          |
| --------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------- |
| Patron                | Accès complet                                                                    |                                                    |
| Employé               | Utilisateur en lecture seule                                                     |                                                    |
| Client                | Utilisateur en lecture seule ou en droit de modification lorsqu'il a un compte client |                                                |
| Dev                   | Maintenance                                                                      |                                                    |
| Prestataire financier | Intermédiaire du paiement                                                        |                                                    |
| Hotel                 | Utilisateur en lecture seule                                                     | Nouvelle proposition du client lors de ce compte rendu |

## 5. Règles métier découvertes

| Règle                                          | Formulation exacte du client                                                                                                 | Sûre ?       |
| ---------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ------------ |
| Envoi d'un avertissement la veille à 18 h      | « Envoyer un avertissement la veille pour dire que potentiellement la sortie est annulée. » / « Envoyer un avertissement la veille à 18H. » | Oui          |
| Envoi de l'avertissement par SMS ou mail       | « SMS ou mail. » / « Par sms et/ou email. »                                                                                   | Oui          |
| Envoi depuis le numéro de la société           | « Depuis numéro portable de la société. »                                                                                     | Oui          |
| L'avertissement ne correspond pas encore à une annulation | « Au moment de la prévention, pas encore d'annulation. C'est au moment du vrai message que y a annulation. »                                                | Oui          |
| La sortie reste maintenue s'il n'y a pas d'annulation après l'avertissement | « Si rien est dit après avertissement, alors sortie maintenue. »                                                              | Oui          |
| Les réservations restent possibles pendant la phase d'avertissement | « Les réservations sont maintenus » / « Encore possibilité de réserver »                                                      | Oui          |
| Affichage d'une alerte météo sur le site ou l'application | « Possibilité de faire une alerte sur l'appli concernant le mauvais temps »                                                   | Oui          |
| L'alerte concerne notamment les réservations après 18 h | « utile notamment pour des personnes qui voudraient réserver après 18h »                                                       | Oui          |
| Possibilité pour le client d'annuler sans frais pendant l'avertissement | « vous avez la possibilité d'annuler votre réservation sans frais »                                                            | Oui          |
| Remboursement à 100 % si le client annule pendant l'avertissement | « Si client annule pendant phase avertissement, il est remboursement » / « Si client annule suite à l'avertissement alors aussi 100%. » | Oui          |
| Possibilité d'indiquer un motif d'annulation   | « Météo ou skipper, donc possibilité de motif. »                                                                               | Oui          |
| Annulation possible pour différents créneaux   | « causes météo, causes techniques, causes humaines »                                                                           | Oui          |
| Annulation possible par créneaux               | « pouvoir annuler le créneau de 7h et/ou le créneau de 10h et/ou le créneau de 14h »                                           | Oui          |
| Annulation possible sur une journée ou plusieurs jours | « Les sorties peuvent être annulées sur la journée ou plusieurs jours. »                                                       | Oui          |
| Notification automatique en cas d'annulation   | « Si il y a une annulation tout se fait en automatique, le SMS/mail est envoyé aux clients concernés »                         | Oui          |
| Tous les clients concernés sont prévenus au même moment | « si annulation alors tout le monde est prévenu au même moment »                                                               | Oui          |
| Remboursement à 100 % en cas d'annulation par l'administrateur | « Annulation par admin remboursement à 100% »                                                                                  | Oui          |
| Remboursement systématique en cas d'annulation | « Remboursement à 100%. Remboursement systématique. »                                                                          | Oui          |
| Choix entre report et remboursement            | « Le report ou remboursement dépend de la volonté du client. »                                                                 | Oui          |
| Le client doit revenir vers le prestataire pour le report ou remboursement | « c'est au client de revenir vers le prestataire pour effectuer un remboursement ou reporter la date de sortie à une date ultérieure » | Oui          |
| Messages disponibles en plusieurs langues      | « Message en français et en anglais au cas où »                                                                                | Oui          |
| Les hôtels restent gérés par appel             | « Hotel on garde les appels. Pas concerné par les messages. »                                                                  | Oui          |
| Une personne de l'hôtel est responsable du groupe | « Une personne hotel en charge du groupe »                                                                                    | Oui          |
| Les avertissements pour les hôtels se font uniquement par appel | « Avertissement directement appel uniquement pour hotel »                                                                      | Oui          |
| Blocage temporaire d'une place pendant la réservation | « Bloquer la place au début du clique sur réserver, à l'arrivée sur formulaire. »                                               | Oui          |
| Délai de 15 minutes lors du paiement           | « Au clic sur payer, donner un temps (15 min) au-delà la place se libère. »                                                    | Oui          |
| Une place redevient disponible après expiration du délai | « au-delà la place se libère »                                                                                                 | Oui          |
| Empêcher deux clients d'acheter la même place  | « Blocage de la réservation pendant un certain temps -> évite que deux clients achètent la même place. »                        | Oui          |
| Tester les réservations simultanées            | « Test deux réservations en même temps. »                                                                                      | Oui          |
| Afficher un badge lorsqu'une place redevient disponible | « badge quand nouvelle place arrive sur site »                                                                                 | Oui          |
| Afficher une nouvelle disponibilité après une annulation | « annulation fait apparaître une nouvelle alors qu'on avait averti à l'utilisateur qu'il n'y avait pas de place »               | Oui          |
| Vérifier la disponibilité des services externes | « Vérifier si les services externes sont disponibles. »                                                                       | Oui          |
| Gérer l'indisponibilité des services externes  | « Gérer les cas où les services externes ne sont pas disponibles. »                                                            | Oui          |
| Annulation vers 5 h en cas de confirmation     | « Si il y a en effet une annulation, ce sera vers 5h. »                                                                        | A confirmer  |
| Prévenir 2 h avant                             | « Toujours 2h avant. »                                                                                                         | A confirmer  |

## 6. Ambiguïtés détectées

| #    | Ambiguïté                    | Pourquoi c'est ambigu                                                                                     |
| ---- | ---------------------------- | --------------------------------------------------------------------------------------------------------- |
| 1    | Gestion d'un service externe indisponible | Le client demande de gérer l'indisponibilité des services externes, mais le comportement attendu en cas de panne n'a pas été défini. |

## 7. Contraintes évoquées

| #  | Contrainte                                                                                                                 | Nature                    |
| -- | -------------------------------------------------------------------------------------------------------------------------- | ------------------------- |
| 04 | L'avertissement concernant une potentielle annulation doit être envoyé la veille à 18 h.                                    | Temporelle / métier       |
| 05 | Une annulation doit pouvoir concerner un ou plusieurs créneaux, une journée ou plusieurs jours.                             | Fonctionnelle             |
| 06 | Les clients concernés par une annulation doivent être prévenus automatiquement par SMS et/ou mail.                          | Fonctionnelle             |
| 07 | En cas d'annulation par l'administrateur, le remboursement est de 100 %.                                                    | Financière / métier       |
| 08 | Un client qui annule pendant la phase d'avertissement bénéficie également d'un remboursement à 100 %.                       | Financière / métier       |
| 09 | Les hôtels doivent être prévenus par téléphone et ne sont pas concernés par les notifications automatiques.                  | Métier                    |
| 10 | Une place doit être temporairement bloquée afin d'éviter deux réservations simultanées.                                      | Technique / fonctionnelle |
| 11 | Lors de la phase de paiement, la place est bloquée pendant 15 minutes avant d'être libérée.                                 | Temporelle / technique    |
| 12 | Les messages doivent pouvoir être proposés en français et en anglais.                                                        | Fonctionnelle             |
| 13 | Le système doit gérer le cas où un service externe est indisponible.                                                         | Technique                 |

## 8. Questions à poser au prochain entretien

| Priorité | Question                                                                                                                        | Pourquoi elle compte                                                                                          |
| -------- | ------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------- |
|          | Que faire dans le cas où le client ne peut pas être présent en physique pour le remboursement ? (le client a réservé une sortie un mois en avance en pensant venir en vacances mais au final ne peut pas partir pour X raison) | Car on aimerait savoir si on implémente sur le site un moyen pour le remboursement. |

## 9. Ce que nous n'avons pas abordé

- Le fonctionnement attendu de l’historique des paiements
- Le moment auquel les passagers sont affectés à un bateau et la personne responsable de cette affectation.
- La gestion des bateaux depuis l’application : ajout, modification ou désactivation d’un bateau.
- Le format de la référence d’une réservation.
- Le comportement attendu lorsqu’un client ne peut pas être présent physiquement pour recevoir un remboursement.
- Le comportement précis du système lorsqu’un service externe est indisponible.
- Le fonctionnement à appliquer lorsqu’un paiement échoue ou expire pendant le blocage temporaire des places.
- Les modalités précises du badge « nouvelle place disponible », notamment sa durée d’affichage et les utilisateurs concernés.
