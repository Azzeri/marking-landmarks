<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\LandmarkUser;
use Illuminate\Http\Request;

class LandmarkUserController extends Controller
{
    public function getLandmarkData(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $idUser = 1;

        $openMapData = Http::get(
            'https://nominatim.openstreetmap.org/reverse?lat='
                . $lat
                . '&lon='
                . $lng
                . '&format=json&
            '
        )->json();

        $response = [
            'place_id' => $openMapData['place_id'],
            'osm_id' => $openMapData['osm_id'],
            'display_name' => $openMapData['display_name'] ?: null,
        ];

        $lm = LandmarkUser::where('id_user', $idUser)
            ->where('id_landmark', $openMapData['place_id'])
            ->first();

        if ($lm) {
            $response[] = [
                'is_favourite' => $lm ? $lm->is_favourite : null,
                'status' => $lm ? $lm->status : null,
                'mark' => $lm ? $lm->mark : null,
            ];
        }

        return response()->json($response);
    }

    public function getAllLandmarks()
    {
        $landmarks = LandmarkUser::select('id_landmark')->distinct()->get();

        $result = [];
        foreach ($landmarks as $lm) {
            $omData = Http::get(
                'https://nominatim.openstreetmap.org/details?place_id='
                    . $lm->id_landmark
                    . '&format=json'
            )->json();

            $result[] = [
                'place_id' => $lm->id_landmark,
                'coordinates' => [
                    'lng' => $omData['centroid']['coordinates'][0],
                    'lat' => $omData['centroid']['coordinates'][1]
                ]
            ];
        }

        return response()->json($result);
    }

    public function getAllLandmarksForUser(Request $request)
    {
        $landmarks = LandmarkUser::where('id_user', $request->id_user)
            ->distinct('id_landmark')
            ->get();

        $result = [];
        foreach ($landmarks as $lm) {
            $omData = Http::get(
                'https://nominatim.openstreetmap.org/details?place_id='
                    . $lm->id_landmark
                    . '&format=json'
            )->json();

            $result[] = [
                'id_user' => $request->id_user,
                'is_favourite' => $lm->is_favourite,
                'status' => $lm->status,
                'mark' => $lm->mark,
                'display_name' => $omData['localname'],
                'place_id' => $omData['place_id'],
                'osm_id' => $omData['osm_id'],
                'openMapData' => $omData,
            ];
        }

        return response()->json($result);
    }

    public function updateProperty(Request $request)
    {
        $property = $request->property;
        $idLandmark = $request->idLandmark;
        $idUser = 1;
        $value = $request->value;

        $lm = LandmarkUser::firstOrCreate([
            'id_user' => $idUser,
            'id_landmark' => $idLandmark
        ]);

        $lm->update([
            $property => $value
        ]);

        return response()->json($lm);
    }

    public function delete(Request $request)
    {
        $landmarkUser = LandmarkUser::where('id_landmark', $request->landmarkId)->first();
        $landmarkUser->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
