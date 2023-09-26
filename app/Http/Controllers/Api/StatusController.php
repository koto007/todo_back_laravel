<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    public function index() {
        $statuses = Status::select('*')
                ->get();
        return StatusResource::collection($statuses);
    }
}
