<?php

namespace JobMetric\GlobalVariable\Http\Controllers;

use Illuminate\Http\Response;
use JobMetric\GlobalVariable\Object\Document;

class JsController
{
    /**
     * render js file
     *
     * @return Response
     */
    public function index(): Response
    {
        $contents = '/*!
 * Global js
 *
 * type: jquery, test
 *
 * Date: '.now().'
 */';

        return response($contents)->header('Content-Type', 'text/javascript');
    }
}
