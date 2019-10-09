<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : Response
    {
        // CODE CHALLENGE: Search Filter
        $domains = Domain::where('is_active', 1)->get();
        // Create HTTP response, 200 ok.
        $response = new Response($domains, Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        // $rules = [
        //     'domain_name' => 'required',
        // ];
        // $validator = Validator::make($request->all(), $rules);

        // print_r($validator->fails());exit;
        $domains = $this->validate($request, [
            'domain_name' => 'required|unique:domains',
        ]);
        // print_r($domains);exit;
        foreach($domains as $domain) {
            $response = Domain::insert($domain);
        }
        return new Response(['created' => $response, Response::HTTP_OK]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : Response
    {
        // CODE CHALLENGE: Toggle Imprint
        $updated = Domain::where('id', $id)->update(['is_imprinted' => $request->is_imprinted]);
        return new Response(['updated' => $updated, Response::HTTP_OK]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) : Response
    {
        $destroyed = Domain::where('id', '=', $id)->update(['is_active' => 0]);
        return new Response(['destroyed' => $destroyed], Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $domains = Domain::where('domain_name', 'like', '%' . $request->get('query') . '%')->get();
        return Response($domains);
    }
}
