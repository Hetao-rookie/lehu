<?php

namespace App\Http\Controllers;

use App\Services\Status;
use App\Services\Context;
use App\Services\Installer;

class SystemController extends Controller
{
    public function install(Context $context, Status $status)
    {
        $installer = new Installer();

        $step = $context->params('step');

        switch ($step) {
          case 'migrate':
            $result = $installer->migrate();
            break;
          case 'resources':
            $result = $installer->registerResources();
            break;
          case 'permissions':
            $result = $installer->registerPermissions();
            break;
          case 'config':
            $result = $installer->registerResources();
            break;
          default:
           $result = ['nothing'];
            break;
        }

        return $context->response($status->result('success', $result));
    }

    public function config()
    {
    }

    /**
     * 获取系统权限
     * 按照资源分组给出.
     */
    public function getPermissions(Context $context, Status $status)
    {
    }
}
