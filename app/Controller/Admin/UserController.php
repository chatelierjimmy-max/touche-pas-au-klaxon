<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Core\AdminGuard;
use App\Repository\UserRepository;

final class UserController extends Controller
{
    public function index(): void
    {
        AdminGuard::check();

        $repository = new UserRepository();

        $this->view('admin/users/index', [
            'pageTitle' => 'Utilisateurs',
            'users' => $repository->findAll(),
        ]);
    }
}