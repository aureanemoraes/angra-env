<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthSSO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();

        $bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OTZkMTlkOC1mYjU1LTQ0ZTEtODdkOS0xNDcxYjE3ZDY1ZWMiLCJqdGkiOiJlNTJlMmEzOGVjNWYyN2IzY2ViNmI3Y2FhYjg1MWNmN2ExZTFmODcwZmMzNjE4MWJiOTQzMThjZDg2MWFlNWRiNDZjYzU5YjUzZGZlZTllZCIsImlhdCI6MTY4NjkzOTIxMy43ODMxNzgsIm5iZiI6MTY4NjkzOTIxMy43ODMxODIsImV4cCI6MTY4NzAyNTYxMy43NTQ3NDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.jZbeJAXcncELvFRLXZR2QhuDUFx9LA-0aJ1sWCSYEIuvZZyUGWlAWvE0auqY9IkMOve1sTIH8whwOCJff2DU8UCWnnPY46JVQkTRpO7LKSO96Fun9KQgXq9KUkuHzHkWbG5SvaDmMiCjMLok2719UmjgDTV8AdI_2MAUeAeqmI76dQppUOj6gCWWEIBm1Yz3dcyjMyn49F4DyB8qyIIYLcNqAfoMG_vP6S8R-_qYLWpk2OfhXxCUJ1bOsrroVmXB_DyjcDlcTFQxZ38mF249JpZ4HbTFRkVfxO5cjwTKP7TCKFZw28ZqD-bHD8LTHugiCLt3yZBXCHliZsR_9wgVuod69DPlhKB-BwKuyA9yGnmfPcVaqZJJxoC9nhldSl8fHO6zbuROUVUSUeTbWS_9XfhuLlVJ-zgawVkWmOUckl4s_Tg-YiuPgo28DApb_eo02-fUnL7fKuB6UU8Z8yy_x3F776usQ6nTMrCLleR3mOgYh2jMaYF42J5ER7E6zd-BxddegjBB_-MoiwS8lPbL7BcmWhDqV0FbVn74aOge7uGGL3fsdFR1PU384rL9mWptkPOR-eC3yvA0FWown7Co22sSf7zbxlgdZoOmBx-FOqZ1vENjxNSCuF9rwqmw71SqR1B3JEgzVqI5Jn14yPsIIGa4CA3YTCFWDy5v0CPkpkg';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken
        ])->get('http://authservice.desenv/api/sso');

        if ($response->status() != 200)
            return response()->json($response->json(), $response->status());

        return $next($request);
    }
}
