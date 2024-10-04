<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('search') && $request->search != null) {
            $value = $request->search;
        } else {
            $value = 'su';
        }
        $api = 'https://restcountries.com/v3.1/name/' . $value . '?fields=name,flags,demonyms';

        try {
            $result = Http::timeout(3600)
                ->withoutVerifying()
                ->get($api);

            if ($result->successful()) {
                return collect($result->json())->map(function ($item) {
                    return [
                        'name' => $item['name']['common'] . ' - ' . $item['demonyms']['eng']['m'],
                        'value' => $item['name']['common'],
                        'official' => $item['name']['official'],
                        'flag' => $item['flags']['svg']
                    ];
                });
            } else {
                $data = [
                    'name' => 'No Country Found',
                    'value' => '',
                    'official' => '',
                    'flag' => ''
                ];
                return collect([$data]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: API call failed'], 500);
        }
    }
}
