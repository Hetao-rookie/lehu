<?php

namespace App\Http\Controllers;

use App\Services\Context;
use App\Services\Installer;

class SystemController extends Controller
{
    public function install(Context $context)
    {
        $installer = new Installer();

        $step = $context->params('step');

        $shortcuts = config('shortcuts');

        print_r($shortcuts);

        // switch ($step) {
        //   case 'migrate':
        //     $installer->migrate();
        //     break;
        //   case 'registerResources':
        //     $installer->registerResources();
        //     break;
        //
        //   default:
        //
        //     break;
        // }
        echo $step;
    }

    public function config()
    {
    }
}
