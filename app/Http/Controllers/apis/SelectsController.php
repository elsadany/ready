<?php

namespace App\Http\Controllers\apis;

use App\Models\Location;
use App\Models\Cuisine;
use Elsayednofal\BackendLanguages\Models\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cuisines;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OffersNotifications;
class SelectsController extends Controller {

    function getLocations(Request $request) {
        $locations = Location::all();
        return response()->json(['status' => 200, 'data' => $locations->toArray()]);
    }

    function getLanguages() {
        $languages = Languages::all();
        return response()->json(['status' => 200, 'data' => $languages->toArray()]);
    }

    function getCuisines() {
        $cuisines = Cuisine::all();
        $data = Cuisines::collection($cuisines);
        return response()->json(['status' => 200, 'data' => $data]);
    }

    function getCategories() {
        $categories = \App\Models\Category::all();
        $data = CategoryResource::collection($categories);
        return response()->json(['status' => 200, 'data' => $data]);
    }

    function getFilters() {
        $filters = \App\Models\GeneralTag::all();
        $data = \App\Http\Resources\GeneralTagResource::collection($filters);
        return response()->json(['status' => 200, 'data' => $data]);
    }
    function getOffersnotifications(Request $request){
        $notifications= \App\Models\OffersNotification::orderBy('id','desc')->get();
        return response()->json(['status'=>200,'data'=> OffersNotifications::collection($notifications)]);
    }

}
