<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHostRequest;
use App\Http\Resources\HostResource;
use App\Models\Host;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function index() {
        $host = Host::all();
        return HostResource::collection($host);
    }

    public function store(StoreHostRequest $requst) {
        $requst->validated($requst->all());
        $host = Host::create($requst->all());
        return HostResource::make($host);
    }
}
