<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Core\AdminGuard;
use App\Core\Flash;
use App\Core\Request;
use App\Repository\AgencyRepository;
use App\Core\Validator;

final class AgencyController extends Controller
{
    public function index(): void
    {
        AdminGuard::check();

        $repository = new AgencyRepository();

        $this->view('admin/agencies/index', [
            'pageTitle' => 'Agences',
            'agencies' => $repository->findAll(),
        ]);
    }

    public function create(): void
    {
        AdminGuard::check();

        $this->view('admin/agencies/create', [
            'pageTitle' => 'Créer une agence',
        ]);
    }

    public function store(): never
{
    AdminGuard::check();

    $data = [
        'name' => Request::input('name'),
    ];

    $validator = new Validator($data);
    $validator->required('name', 'Le nom de l’agence est obligatoire.');

    if ($validator->fails()) {
        Flash::set('error', (string) $validator->firstError());
        $this->redirect('/admin/agencies/create');
    }

    $repository = new AgencyRepository();
    $repository->create(trim((string) $data['name']));

    Flash::set('success', 'Agence créée avec succès.');
    $this->redirect('/admin/agencies');
}

    public function edit(int $id): void
    {
        AdminGuard::check();

        $repository = new AgencyRepository();
        $agency = $repository->findById($id);

        if ($agency === null) {
            http_response_code(404);
            echo 'Agence introuvable';
            return;
        }

        $this->view('admin/agencies/edit', [
            'pageTitle' => 'Modifier une agence',
            'agency' => $agency,
        ]);
    }

    public function update(int $id): never
{
    AdminGuard::check();

    $data = [
        'name' => Request::input('name'),
    ];

    $validator = new Validator($data);
    $validator->required('name', 'Le nom de l’agence est obligatoire.');

    if ($validator->fails()) {
        Flash::set('error', (string) $validator->firstError());
        $this->redirect('/admin/agencies/' . $id . '/edit');
    }

    $repository = new AgencyRepository();
    $repository->update($id, trim((string) $data['name']));

    Flash::set('success', 'Agence modifiée avec succès.');
    $this->redirect('/admin/agencies');
}

    public function delete(int $id): never
    {
        AdminGuard::check();

        $repository = new AgencyRepository();
        $repository->delete($id);

        Flash::set('success', 'Agence supprimée avec succès.');
        $this->redirect('/admin/agencies');
    }
}