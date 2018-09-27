<?php

namespace App\Http\Controllers;

use App\Services\JsonRpc\Electrum;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'method' => 'required',
            'params' => 'array'
        ]);

        $method = $request->input('method');
        $params = $request->input('params');

        return $this->makeResponse($request, $this->route($request, $method, $params));
    }

    private function route($request, $method, $params) {
        $electrum = new Electrum();
        if(method_exists($electrum, $method)) {
            if(($rules = $electrum->getValidationRules($method)) !== null) {
                $this->validate($request, $rules);
            }
            // https://stackoverflow.com/questions/251485/dynamic-class-method-invocation-in-php
            return call_user_func_array(array($electrum, $method), array($params));
        }
        throw new NotFoundHttpException("Method {$method} not supported.", null, -32601);
    }

    private function makeResponse(Request $request, $result) {
        return [
           'result' => $result,
           'id' => $request->input('id'),
           'error' => null
        ];
    }
}
