<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\LandmarkUser;
use Illuminate\Http\Request;

class LandmarkUserController extends Controller
{
    public function getLandmarkData(Request $request)
    {
        $lat = 51.5182503350964;
        $lng = -0.030778508268127783;
        $idUser = 1;

        $openMapData = Http::get(
            'https://nominatim.openstreetmap.org/reverse?lat='
                . $lat
                . '&lon='
                . $lng
                . '&format=json&
            '
        )->json();

        $lm = LandmarkUser::where('id_user', $idUser)
            ->where('id_landmark', $openMapData['place_id'])
            ->first();

        return response()->json([
            'display_name' => $openMapData['display_name'] ?: null,
            'is_favourite' => $lm ? $lm->is_favourite : null,
            'status' => $lm ? $lm->status : null,
            'mark' => $lm ? $lm->mark : null,
        ]);
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

        return response()->json([
            'status' => 'success'
        ]);
    }
}
