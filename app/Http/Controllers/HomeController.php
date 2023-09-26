<?php

namespace App\Http\Controllers;

use App\CustomResponse\ApiResponse;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Requests\UpdateHomeRequst;
use App\Http\Resources\HomeResource;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponse;
    public function index() {
        $home = Home::all();
        return $home;
    }

    public function store(StoreHomeRequest $requst) {
        $requst->validated($requst->all());
        $home = Home::create($requst->all());
        return HomeResource::make($home);
    }

    public function update(UpdateHomeRequest $requst, Home $home) {
        $requst->validated($requst->all());
        $home->update($requst->all());
        return HomeResource::make($home);
    }

    public function show(Home $home) {
        // if (Checker::isParamsFoundInRequest()){
        //     return Checker::CheckerResponse();
        // }
        return HomeResource::make($home);
}

    public function destroy(Home $home){
        $home->delete();
        return $this->success($home,'Deleted Successfully From Our System');
    }
}
