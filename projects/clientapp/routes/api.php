<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|   // GOP -> ACCESS_TOKEN
    // CIOPS -> ACCESS_TOKEN
*/

Route::get('/register', function (Request $request) {
    $response = Http::withHeaders([
        'Accept' => 'application/json',
    ])->post('http://authservice.desenv/api/register', [
        'name' => 'User test',
        'email' => 'user@test.com',
        'password' => '12345678',
    ]);

    return $response;
});

Route::get('/login', function (Request $request) {

    /**
     * recebe um username and password from front-end
     */

    $frontendRequest = [
        'username' => 'user@test.com',
        'password' => '12345678'
    ];

    /*
     * Faz a requisição para o authservice
     */
    $response = Http::withHeaders([
        'Accept' => 'application/json',
    ])->post('http://authservice.desenv/oauth/token', [
        'grant_type' => 'password',
        'client_id' => env('PASSPORT_CLIENT_ID', '996d19d8-fb55-44e1-87d9-1471b17d65ec'),
        'client_secret' => env('PASSPORT_SECRET', '8ZAm25qeNop1d0PAZ1rlibWY4VMOCvBM3Xxtbv4f'),
        'username' => $frontendRequest['username'],
        'password' => $frontendRequest['password'],
        'scope' => '',
    ]);

    /**
     * Retornar os tokens de autenticação
     */

    return response()->json($response->json(), $response->status());
});

Route::get('/logout', function (Request $request) {
    $bearerToken = $request->bearerToken();

    $bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OTZjZjNkNy0yOGNkLTQ5MjEtYTA1OS02NGY3NzY4NTcwY2YiLCJqdGkiOiI3YThhODg0NGY1NjM2MDI3NGMyYTcyMmNmNWY2M2RlZjlmZTQxN2QyYjM0Mzk0OGI0MmQ4OTFmMzI3ODVlOWViOGNkMGE0YzE4OGFhYjZjZSIsImlhdCI6MTY4NjkzNjkxMC45ODc1OTYsIm5iZiI6MTY4NjkzNjkxMC45ODc1OTcsImV4cCI6MTY4NzAyMzMxMC45NzU4NjcsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.DHdmYznbeAFRGRQZIaHSgkG0nH5BkUkO7qSxuJA2goeM5HN1ghJLEgiZRO3ynE3Q3pzMelsH7MKPml1K7Te6fTdaeoqfqvjs-2HXHmNqJa2Rh8vjE8Q4YrGNdK5E-rIX90RSKcXw2mzWSjw5byTZhjcEeKtxXEsnQOUD4SPdQkeu6XJGAofKln7DS6lcuw2fHaM736er_sgVmRQ3TkoW3vDKkskmfBexTQcr4ManPZTiny75CRhqiRLIWNpgmTcwxwrtzlgIilzDpP2AZZ2tHDJfAiTQoXyVfyIeNVe4a5-IPnIH6fEOOkV0wXifo22oa9r7HEoqDE3MSpdZZv-2z46h9-dYkZpHRJC5BMT4HFPRUnDScvQ6JO0bl3AXK-7SHk2pSO9mvzOdY5yXXhKlpH5kl41xs1XJ1oiudQ6Pxm1GoOBeZGNvmCSTX8_ycY3gcV7kmK6iHMnckVnX-VtlQhq92_DK2dlQ1xHb2nvXmoTGEGICAHL8Zq0DwVcj5jlQgVykOQxTS3h-klJtxMd6V4n1CMuXc9ogxl1_AZ472jxIEX4KKo0MrUAd9MEaFnQGZ4YsWUdHKrtfdFJf2n6zmBqbYjNexL2-utp19vxHs8IPmu33x7vrKFAFPwdIdCCP6yz8jwHEf-rgNlfNVoiSsLl9-ToDJBdxLTiIKCr3QPA';

    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $bearerToken
    ])->delete('http://authservice.desenv/api/logout/');

    return $response->json();
});

Route::get('/tokens', function (Request $request) {
    $response = Http::asForm()->post('http://authservice.desenv/oauth/token', [
        'grant_type' => 'client_credentials',
        'client_id' => '996cf3d7-28cd-4921-a059-64f7768570cf',
        'client_secret' => 'SFcCXMy57Jln1KZrqaVvbtNahNqVTg7htlfLmVie',
        'scope' => '',
    ]);

    return $response->json();
});

Route::get('/protected-route', function(Request $request) {
    return "Olá!";
})->middleware('auth.sso');



