<?php

namespace App\DataFixtures;

use App\Entity\Spot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpotsFixtures extends Fixture
{
    const SPOTS = [
        [
            'name' => "la saline - trou d'eau",
            'subtitle' => null,
            'position' => 'Cote Ouest de la Réunion, à la partie Sud du Lagon de l’Hermitage.',
            'access' => 'Plage de Trou d’Eau, accès parking : plage de Trou d’Eau ou Restaurant “L’uni-vert”.',
            'description' => 'Très joli spot en zone Lagon, peu profond, assez flat à orientation Freeride, Freestyle. Il s’agit d’un des deux spots les plus fréquentés de l’île selon les conditions et orientations du vent.<br/>3 zones de décollage / atterrissage :<br/><ul>
    <li>Au sud du restaurant Planche Alizée</li>
    <li>En face du restaurant “L’uni-vert”</li>
    <li>Entre le restaurant “La Bodega” et le borne de secours orange située sur la plage.</li></ul>',
            'orientation' => 'Fonctionne avec du vent à prédominance de Sud : SSE, SE, S, SW. A déconseiller par vent de Nord.  Pour la force du vent et prévisions : explications dans l’onglet METEO',
            'water' => 'Flat à Clapoteux (marée haute et vent fort).  Privilégier horaire de marée haute pour éviter d’abimer les coraux.',
            'dangers' => 'Coraux affleurants, Oursins, zone de décollage/atterrissage étroite, vent souvent rafaleux, spot très fréquenté, proximité arbres/habitations, partage espace avec autres usagers (windsurfer, baigneurs, plagistes etc…)',
            'more' => 'Présence d’une zone de RESERVE MARINE INTEGRALE -> Navigation strictement INTERDITE matérialisée par 4 bouées Jaune : deux dans le lagon, deux à l’extérieure.<br/>Merci de consulter la Page “Réglementation Spot de Trou d’Eau”. Vous y trouverez un Plan du spot ainsi que la zone de Navigation autorisée.',
            'security' => null,
        ], [
            'name' => 'La Gendarmerie',
            'subtitle' => 'Spot réservé aux pratiquants confirmés, renseignez vous auprès des locaux avant de vous mettre à l’eau.<br/>Attention au courant dans la passe par jour de forte houle ! Ne sortez pas surtoilé !!',
            'position' => 'Au cœur de la ville de Saint-Pierre.',
            'access' => 'Sur le front de mer, entre la Gendarmerie et le Cimetière.',
            'description' => 'Spot emblématique de la Réunion ou se sont déroulés les championnats de kitesurf, mélangeant lagon étroit, peu profond, accès zone plein océan et spot de vagues ! <br/>Importance de respecter les zones de navigation , les horaires de marées, les règles de priorité dans le lagon et sur les vagues !',
            'orientation' => 'Fonctionne avec du vent en prédominance de Sud : ESE, SE. Vent généralement très régulier et souvent fort en période australe.',
            'water' => 'Choppy – small waves – waves. Zone de Flat, plus profonde sur l’extrémité gauche du spot.',
            'dangers' => 'Requins, oursins ++, zone de décollage / atterrissage délicate : étroite et déventé dans la partie sous le vent contre le mur, Fort courant dans la passe lors des fortes houles.',
            'more' => null,
            'security' => 'Bouée de Sauvetage et Touret de Corde sur le toit du Snack “Chez Lenny”.',
        ], [
            'name' => 'La Ravine Blanche',
            'position' => 'Ville de Saint-Pierre, sortie “Ravine Blanche” depuis la 4 voies.',
            'access' => 'Sur le front de mer de Saint-Pierre, au nord de la ville. Accès au spot de vagues via le Spot de la Gendarmerie ou Décollage depuis la Canalisation. ',
            'description' => 'Très beau spot de vague qui a été choisi pour l’épreuve Vague du championnat de la Réunion. <br/>Spot partagé avec les windsurfers, bonne entente sur l’eau, merci de respecter les priorités<br/>Renseignez vous auprès des locaux avant d’aller sur ce spot.//<br/>Niveau expérimenté en Surf-Kite exigé !',
            'orientation' => 'Fonctionne avec du vent en prédominance de Sud : ESE, SE. ',
            'water' => 'Waves',
            'dangers' => 'Requins, oursins, Courants, zone de décollage/atterrissage délicate, spot exigeant, niveau Expert.',
            'more' => null,
            'security' => null,
            'subtitle' => null,
        ], [
            'name' => 'Boucan Canot',
            'position' => 'Plage de Boucan Canot. Dans le nord-ouest de l’île.',
            'access' => 'Accès piétons uniquement, utiliser les parkings alentours.',
            'description' => 'Très joli spot (plein océan) qui fonctionne en période estival. Eau turquoise par beau temps. Belle plage de sable fin.',
            'orientation' => 'Fonctionne avec du vent en prédominance de Nord : ENE, NE, N, NW, NNW…',
            'water' => 'Choppy – small waves – waves si forte houle.',
            'dangers' => 'Requins, ATTENTION à  la dalle de corail pouvant affleurer la surface à marée basse, elle est tapissée d’oursins. Large zone de décollage / atterrissage mais attention à la dévente . En cas de houle, shore brake  important.',
            'more' => null,
            'security' => null,
            'subtitle' => null,
        ], [
            'name' => 'Pointe au Sel',
            'subtitle' => 'Ne jamais naviguer seul !',
            'position' => 'Au nord de la Pointe au Sel',
            'access' => 'Pas de parking spécifique, accès bord de route, puis enjamber la glissière de sécurité pour rejoindre la plage.',
            'description' => 'Spot de vague réputé par conditions de Sud, destiné aux kitesurfeurs  chevronnés.<br/>Vent Side OFF, pouvant chuter brutalement. S’assurer d’avoir une sécurité bateau ou jet ski.',
            'orientation' => 'S-SSE  :Vagues / NW : Freeride',
            'water' => 'Vague  ( Gauche )',
            'dangers' => 'La vague termine sur un platier corallien très peu profond, coupant etc. Risque Requins! Conditions Side OFF, Zone de décollage / atterrissage délicate.',
            'more' => null,
            'security' => null,
        ], [
            'name' => 'Etang Salé',
            'subtitle' => 'Grande baie avec de la place permettant du freestyle sans crainte des patates de corail !! Spot historique des windsurfers et surfeurs. Merci de respecter le bon relationnel entre les différents pratiquants.',
            'position' => 'Baie d’Etang Salé. Dans le sud-ouest de l’île, spot peu fréquenté, conditions de vent peu adaptées.Comment s’y rendre :  Accès via la plage d’Etang Salé. Eloignez vous des baigneurs. Ne jamais naviguer seul.',
            'access' => null,
            'description' => 'Kite en plein océan + vagues (Gauche adaptée par vent de Sud).',
            'orientation' => 'Fonctionne avec du vent en prédominance de Sud : SSE / S, mais également N à W.',
            'water' => 'Plein océan, vagues ( Gauche ).',
            'dangers' => 'Requins, dévente. Bateau sécurité recommandé.',
            'more' => 'l’accès et la navigation au bassin Pirogue est interdite d’autant plus qu’il existe une zone de Protection Maritime Intégrale (Cf Réglementations).',
            'security' => 'A la moindre variation de vent difficulté pour revenir à terre. Prévoir sécurité bateau ou autres. Spot très agréable l’été par vent de Nord / NO.',
        ], [
            'name' => 'Saint Leu',
            'subtitle' => 'Renseignez vous auprès des locaux.<br/>Interdiction de décoller depuis la plage de Saint Leu. Zone de décollage à l’embouchure de la Ravine.',
            'position' => 'La baie de Saint Leu (Ouest de l’île) Au niveau de la mythique “Gauche”, vague de réputation mondiale dans le milieu du Surf. Spot peu kité du aux conditions de vent non adaptées (dévente).',
            'access' => 'A l’entrée de Saint Leu coté Nord.',
            'description' => 'Navigation dans la baie de Saint Leu, plein océan. Spot historiquement fréquenté par les windsurfers et surfeurs. Merci de respecter le bon relationnel et les règles de priorité entre les différents pratiquants.',
            'orientation' => 'Fonctionne avec du vent en prédominance de Sud : S-SSE (dévente) ou en saison estival par N à NW.',
            'water' => 'Plein océan / Vague',
            'dangers' => 'Requins, zone de décollage / atterrissage délicate très déventée.',
            'more' => null,
            'security' => null,
        ], [
            'name' => 'La Possession',
            'position' => 'Baie de la possession (Nord-Ouest) .',
            'access' => 'Accès en longeant le grillage de la station EDF Port Est au niveau de la ravine.',
            'description' => 'Spot peu fréquenté entre sortie du Port Est et du petit Port de Pêche de la Possession.',
            'orientation' => 'Fonctionne avec du vent en prédominance de Nord : NNW à ENE<br/>Saison Estivale essentiellement.',
            'water' => 'Choppy',
            'dangers' => 'Requins, zone de décollage / atterrissage délicate, spot mauvaise réputation. Réservé aux plus téméraires 😉',
            'more' => null,
            'security' => null,
            'subtitle' => null,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SPOTS as $spot) {
            $spot = (new Spot())
                ->setName($spot['name'])
                ->setSubtitle($spot['subtitle'])
                ->setPosition($spot['position'])
                ->setAccess($spot['access'])
                ->setDescription($spot['description'])
                ->setOrientation($spot['orientation'])
                ->setWater($spot['water'])
                ->setDangers($spot['dangers'])
                ->setMore($spot['more'])
                ->setSecurity($spot['security']);
            $manager->persist($spot);
        }

        $manager->flush();
    }
}
