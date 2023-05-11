<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Interfaces\Author\DashboardInterface;


class DashboardController extends Controller
{
    private $interface;

    public function __construct(DashboardInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index()
    {
        return $this->interface->index();
    }

}