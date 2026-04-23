<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Core\AdminGuard;
use App\Core\Flash;
use App\Repository\TripRepository;

final class TripController extends Controller
{
    public function index(): void
    {
        AdminGuard::check();

        $repository = new TripRepository();

        $this->view('admin/trips/index', [
            'pageTitle' => 'Trajets',
            'trips' => $repository->findAllForAdmin(),
        ]);
    }

    public function delete(int $id): never
    {
        AdminGuard::check();

        $repository = new TripRepository();
        $repository->delete($id);

        Flash::set('success', 'Trajet supprimé avec succès.');
        $this->redirect('/admin/trips');
    }
}