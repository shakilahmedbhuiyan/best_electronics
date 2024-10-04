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
        $api= 'https://restcountries.com/v3.1/name/'.$value.'?fields=name,flags,demonyms';

            $result= Http::timeout(3600)
                ->withoutVerifying()
                ->get($api);

            if ($result->successful())
            {
                $result = collect($result->json())->map(function ($item) {
                    return [
                        'name' => $item['name']['common'].' - '.$item['demonyms']['eng']['m'],
                        'value' => $item['name']['common'],
                        'official' => $item['name']['official'],
                        'flag' => $item['flags']['svg']
                    ];
                });
                return $result;
            }
            else {
                return response()->json(['error' => 'Something went wrong'], 500);
            }
    }
}
