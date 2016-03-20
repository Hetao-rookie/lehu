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

    /**
     * 环境检查.
     *
     * @return [type] [description]
     */
    public function enevnorment()
    {
    }

    public function migrate()
    {
    }

    public function registerResources()
    {
        $status = null;

        $resources = $this->getResources();

        $table = $this->model->getTable('RESOURCE');

        foreach ($resources as $row) {
            $exsit = $this->model->table($table)->where('ident', $row['ident'])->get();

            if ($exsit) {
                $status[$row['ident']] = 'exist';
                continue;
            }

            if ($this->model->table($table)->insert($row)) {
                $status[$row['ident']] = 'success';
            }
        }

        return $status;
    }
    public function registerPermissions()
    {
        $status = null;

        $permissions = $this->getPermissions();

        $table = $this->model->getTable('PERMISSION');

        foreach ($permissions as $row) {
            $exsit = $this->model->table($table)->where('ident', $row['ident'])->get();

            if ($exsit) {
                $status[$row['ident']] = 'exist';
                continue;
            }

            if ($this->model->table($table)->insert($row)) {
                $status[$row['ident']] = 'success';
            }
        }

        return $status;
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
     * 读取资源配置文件.
     *
     * @return [type] [description]
     */
    protected function getResources()
    {
        $defaultResources = config('resources');

        return $this->generateResourceRows($defaultResources);
    }

    /**
     * 处理资源前缀
     *
     * @param string/array $resources 资源标示或资源数组
     *
     * @return array 处理后的资源数组
     */
    protected function generateResourceRows($resources)
    {
        $result = [];

        foreach ($resources as $resource => $table) {
            $resource = trim($resource);

            if (strpos($resource, 'L:') === 0) {
                continue;
            }

            $row['name'] = trans("resources.$resource");
            $row['ident'] = $resource;
            $row['source'] = 'LEHU';

            array_push($result, $row);
        }

        return $result;
    }

    /**
     * 获取系统权限.
     *
     * @return [type] [description]
     */
    protected function getPermissions()
    {
        $defaultPermissions = config('permissions');

        return $this->generatePermissionRows($defaultPermissions);
    }

    protected function generatePermissionRows($permissions)
    {
        $result = [];

        foreach ($permissions as $permission) {
            $permission = trim($permission);

            if (strpos($permission, 'T:') === 0) {
                $permission = trim(substr($permission, 2));
                $row['type'] = ':type';
            } else {
                $row['type'] = 'single';
            }

            $row['name'] = trans("permissions.$permission");
            $row['ident'] = $permission;
            $row['resource_ident'] = $this->getPermissionResourceIdent($permission);
            $row['source'] = 'LEHU';

            array_push($result, $row);
        }

        return $result;
    }

    protected function getPermissionResourceIdent($permission)
    {
        return explode('_', $permission)[0];
    }
}
