<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TripRepository;

/**
 * Gère la page d'accueil de l'application.
 *
 * Cette classe permet d'afficher les trajets disponibles
 * sur la page principale.
 */
final class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil.
     *
     * Récupère la liste des trajets disponibles à venir
     * et les transmet à la vue.
     *
     * @return void
     */
    public function index(): void
    {
        $tripRepository = new TripRepository();
        $trips = $tripRepository->findAvailableUpcomingTrips();

        $this->view('home/index', [
            'pageTitle' => 'Accueil',
            'trips' => $trips,
        ]);
    }
}