<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index()
    {
        return Examination::all();
    }

    public function getAll()
    {
        return Examination::get(['id', 'title']);
    }
}
