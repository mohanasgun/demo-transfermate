<?php

namespace App\Http\Controllers;

use App\Services\ListServices;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Render list page of authors and books
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return view('list.list');
    }

    /**
     * Fetch list data of authors and books
     *
     * @param Request $request
     * @param ListServices $listServices
     * @return json
     */
    public function list(Request $request, ListServices $listServices)
    {
        $result = $listServices->listData($request->all());
        return response()->json(['status' => true, 'result' => $result]);
    }
}
