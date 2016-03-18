<?php

namespace App\Http;

use Request;
use Response;
use Laravel\Lumen\Routing\Controller as Controller;

class Installer extends Controller
{
    protected $params;

    public function install(Request $request, Response $response)
    {
        $func = $request->input('step');
        $this->params = $request->all();

        return $this->$func();
    }

    protected function migrate()
    {
    }

    protected function cacheConfigs()
    {
    }

    protected function storeResources()
    {
    }

    protected function stroePermissions()
    {
    }

    protected function registerRootUser()
    {
    }

    protected function setSiteConfig()
    {
    }
}
