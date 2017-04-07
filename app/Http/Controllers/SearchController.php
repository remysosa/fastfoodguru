<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;

class SearchController extends Controller
{
    public function index(Request $request) {

        if(isset($_GET['limit'])) {
            $this->validate($request, [
                'limit' => 'numeric|min:0|max:50',
                ]
            );
        }

        $position = Location::get();
        $latitude = $position->latitude;
        $longitude = $position->longitude;
        $openNow = $request->input('openNow', null);
        $limit = $request->input('limit', '50');

        $searchTerm = $request->input('searchTerm', null);
        $searchResultsURL = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$searchTerm.'&location='.$latitude.','.$longitude.'&radius=50&key=AIzaSyA61Aa_d3pjQB3aF_Dsj5VoYUbgynrlgk8';
        $searchResultsJSON = file_get_contents($searchResultsURL);
        $searchResultsArray = json_decode($searchResultsJSON, true);

        return view('welcome')->with([
            'position' => $position,
            'searchTerm' => $searchTerm,
            'searchResultsArray' => $searchResultsArray,
            'searchResultsURL' => $searchResultsURL,
            'openNow' => $openNow,
            'limit' => $limit
        ]);
    }

    public function search($id) {
            return view('review')->with(['id' => $id]);
        }
}
