<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Core\AdminGuard;

final class DashboardController extends Controller
{
    public function index(): void
    {
        AdminGuard::check();

        $this->view('admin/dashboard', [
            'pageTitle' => 'Administration',
        ]);
    }
}