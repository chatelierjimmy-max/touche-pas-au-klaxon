<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TripRepository;

final class HomeController extends Controller
{
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