<?php

namespace App\Services;

use App\Models\Model;

class Installer
{
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function migrate()
    {
    }

    public function registerResources()
    {
        return 'register resources';
    }
    public function registerPermissions()
    {
        return 'register permissions';
    }

    public function cacheConfigs()
    {
    }

    public function registerRootUser()
    {
        return 'register root user';
    }

    public function setSiteConfig()
    {
        return 'register site config';
    }

    /**
     * 读取资源配置文件
     * @return [type] [description]
     */
    protected function getResources(){

    }
}
