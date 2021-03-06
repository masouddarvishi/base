<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseResource extends Resource
{
    protected $includes = [];

    public function with($request)
    {
        return empty($this->includes) ? [] : ['included' => $this->includes];
    }

    public function withResponse($request, $response)
    {
        $response
            ->setStatusCode(Response::HTTP_OK)
            ->header('Content-Type', enum('system.response.json'));
    }
}
