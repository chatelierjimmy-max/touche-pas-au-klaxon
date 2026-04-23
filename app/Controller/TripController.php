<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Flash;
use App\Core\Request;
use App\Repository\AgencyRepository;
use App\Repository\TripRepository;
use App\Core\Validator;

final class TripController extends Controller
{
    public function create(): void
    {
        $agencyRepository = new AgencyRepository();

        $this->view('trips/create', [
            'pageTitle' => 'Créer un trajet',
            'agencies' => $agencyRepository->findAll(),
            'user' => Auth::user(),
        ]);
    }

    public function store(): never
{
    $data = [
        'departure_agency_id' => Request::input('departure_agency_id'),
        'arrival_agency_id' => Request::input('arrival_agency_id'),
        'departure_date' => Request::input('departure_date'),
        'departure_time' => Request::input('departure_time'),
        'arrival_date' => Request::input('arrival_date'),
        'arrival_time' => Request::input('arrival_time'),
        'total_places' => Request::input('total_places'),
    ];

    $validator = new Validator($data);

    $validator
        ->required('departure_agency_id', 'L’agence de départ est obligatoire.')
        ->required('arrival_agency_id', 'L’agence d’arrivée est obligatoire.')
        ->required('departure_date', 'La date de départ est obligatoire.')
        ->required('departure_time', 'L’heure de départ est obligatoire.')
        ->required('arrival_date', 'La date d’arrivée est obligatoire.')
        ->required('arrival_time', 'L’heure d’arrivée est obligatoire.')
        ->required('total_places', 'Le nombre de places est obligatoire.')
        ->integer('departure_agency_id', 'L’agence de départ est invalide.')
        ->integer('arrival_agency_id', 'L’agence d’arrivée est invalide.')
        ->minInt('total_places', 1, 'Le nombre de places doit être supérieur à 0.')
        ->different('departure_agency_id', 'arrival_agency_id', 'L’agence de départ doit être différente de l’agence d’arrivée.')
        ->afterDateTime(
            'departure_date',
            'departure_time',
            'arrival_date',
            'arrival_time',
            'La date/heure d’arrivée doit être postérieure au départ.'
        );

    if ($validator->fails()) {
        Flash::set('error', (string) $validator->firstError());
        $this->redirect('/trips/create');
    }

    $departureDatetime = (string) $data['departure_date'] . ' ' . (string) $data['departure_time'] . ':00';
    $arrivalDatetime = (string) $data['arrival_date'] . ' ' . (string) $data['arrival_time'] . ':00';
    $totalPlaces = (int) $data['total_places'];

    $tripRepository = new TripRepository();
    $tripRepository->create([
        'departure_agency_id' => (int) $data['departure_agency_id'],
        'arrival_agency_id' => (int) $data['arrival_agency_id'],
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
            'user' => Auth::user(),
        ]);
    }

    public function edit(int $id): void
    {
        $tripRepository = new TripRepository();
        $trip = $tripRepository->findById($id);

        if ($trip === null) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        if ((int) Auth::user()['id'] !== (int) $trip['user_id']) {
            http_response_code(403);
            echo 'Accès interdit';
            return;
        }

        $agencyRepository = new AgencyRepository();

        $this->view('trips/edit', [
            'pageTitle' => 'Modifier un trajet',
            'trip' => $trip,
            'agencies' => $agencyRepository->findAll(),
        ]);
    }

    public function update(int $id): never
{
    $tripRepository = new TripRepository();
    $trip = $tripRepository->findById($id);

    if ($trip === null) {
        http_response_code(404);
        echo 'Trajet introuvable';
        exit;
    }

    if ((int) Auth::user()['id'] !== (int) $trip['user_id']) {
        http_response_code(403);
        echo 'Accès interdit';
        exit;
    }

    $data = [
        'departure_agency_id' => Request::input('departure_agency_id'),
        'arrival_agency_id' => Request::input('arrival_agency_id'),
        'departure_date' => Request::input('departure_date'),
        'departure_time' => Request::input('departure_time'),
        'arrival_date' => Request::input('arrival_date'),
        'arrival_time' => Request::input('arrival_time'),
        'total_places' => Request::input('total_places'),
    ];

    $validator = new Validator($data);

    $validator
        ->required('departure_agency_id', 'L’agence de départ est obligatoire.')
        ->required('arrival_agency_id', 'L’agence d’arrivée est obligatoire.')
        ->required('departure_date', 'La date de départ est obligatoire.')
        ->required('departure_time', 'L’heure de départ est obligatoire.')
        ->required('arrival_date', 'La date d’arrivée est obligatoire.')
        ->required('arrival_time', 'L’heure d’arrivée est obligatoire.')
        ->required('total_places', 'Le nombre de places est obligatoire.')
        ->integer('departure_agency_id', 'L’agence de départ est invalide.')
        ->integer('arrival_agency_id', 'L’agence d’arrivée est invalide.')
        ->minInt('total_places', 1, 'Le nombre de places doit être supérieur à 0.')
        ->different('departure_agency_id', 'arrival_agency_id', 'L’agence de départ doit être différente de l’agence d’arrivée.')
        ->afterDateTime(
            'departure_date',
            'departure_time',
            'arrival_date',
            'arrival_time',
            'La date/heure d’arrivée doit être postérieure au départ.'
        );

    if ($validator->fails()) {
        Flash::set('error', (string) $validator->firstError());
        $this->redirect('/trips/' . $id . '/edit');
    }

    $departureDatetime = (string) $data['departure_date'] . ' ' . (string) $data['departure_time'] . ':00';
    $arrivalDatetime = (string) $data['arrival_date'] . ' ' . (string) $data['arrival_time'] . ':00';
    $totalPlaces = (int) $data['total_places'];

    $tripRepository->update($id, [
        'departure_agency_id' => (int) $data['departure_agency_id'],
        'arrival_agency_id' => (int) $data['arrival_agency_id'],
        'departure_datetime' => $departureDatetime,
        'arrival_datetime' => $arrivalDatetime,
        'total_places' => $totalPlaces,
        'available_places' => $totalPlaces,
    ]);

    Flash::set('success', 'Le trajet a bien été modifié.');
    $this->redirect('/');
}

    public function delete(int $id): never
    {
        $tripRepository = new TripRepository();
        $trip = $tripRepository->findById($id);

        if ($trip === null) {
            http_response_code(404);
            echo 'Trajet introuvable';
            exit;
        }

        if ((int) Auth::user()['id'] !== (int) $trip['user_id']) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }

        $tripRepository->delete($id);

        Flash::set('success', 'Le trajet a bien été supprimé.');
        $this->redirect('/');
    }
}