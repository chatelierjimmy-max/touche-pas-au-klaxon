<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Repository\AgencyRepository;
use App\Repository\TripRepository;
use App\Core\Flash;
use App\Core\Request;

final class TripController extends Controller
{
    public function create(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $agencyRepository = new AgencyRepository();

        $this->view('trips/create', [
            'pageTitle' => 'Créer un trajet',
            'agencies' => $agencyRepository->findAll(),
            'user' => Auth::user(),
        ]);
    }

    public function store(): never
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $departureAgencyId = (int) Request::input('departure_agency_id');
        $arrivalAgencyId = (int) Request::input('arrival_agency_id');
        $departureDate = (string) Request::input('departure_date');
        $departureTime = (string) Request::input('departure_time');
        $arrivalDate = (string) Request::input('arrival_date');
        $arrivalTime = (string) Request::input('arrival_time');
        $totalPlaces = (int) Request::input('total_places');

        if ($departureAgencyId === $arrivalAgencyId) {
            Flash::set('error', 'L’agence de départ doit être différente de l’agence d’arrivée.');
            $this->redirect('/trips/create');
        }

        $departureDatetime = $departureDate . ' ' . $departureTime . ':00';
        $arrivalDatetime = $arrivalDate . ' ' . $arrivalTime . ':00';

        if (strtotime($arrivalDatetime) <= strtotime($departureDatetime)) {
            Flash::set('error', 'La date/heure d’arrivée doit être postérieure au départ.');
            $this->redirect('/trips/create');
        }

        if ($totalPlaces <= 0) {
            Flash::set('error', 'Le nombre de places doit être supérieur à 0.');
            $this->redirect('/trips/create');
        }

        $tripRepository = new TripRepository();
        $tripRepository->create([
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
            'departure_datetime' => $departureDatetime,
            'arrival_datetime' => $arrivalDatetime,
            'total_places' => $totalPlaces,
            'available_places' => $totalPlaces,
            'user_id' => Auth::user()['id'],
        ]);

        Flash::set('success', 'Le trajet a bien été créé.');
        $this->redirect('/');
    }

    public function show(int $id): void
    {
    $repository = new TripRepository();
    $trip = $repository->findById($id);

    if ($trip === null) {
        http_response_code(404);
        echo 'Trajet introuvable';
        return;
    }

    $this->view('trips/show', [
        'pageTitle' => 'Détail du trajet',
        'trip' => $trip,
        'user' => \App\Core\Auth::user(),
    ]);
    }
}