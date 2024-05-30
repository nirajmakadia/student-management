<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;

class ResultApiController extends Controller
{
    public function index()
    {
        return Result::with('student')->get();
    }
}
