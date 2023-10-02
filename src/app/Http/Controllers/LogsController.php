<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LogsController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Logs/Index', [
            'auth' => auth()->user(),
        ]);
    }
}
