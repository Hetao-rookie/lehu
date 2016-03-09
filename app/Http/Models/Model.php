<?php

namespace App\Http\Models;

use DB;
use App\Services\Coder;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    protected $coder;

    public function __construct()
    {
        $this->coder = new Coder();
    }

    public function code($code, $result)
    {
        return [
        'code' => $code,
        'result' => $result,
      ];
    }

    public function transaction($callback)
    {
        DB::beginTransaction();

          // We'll simply execute the given callback within a try / catch block
          // and if we catch any exception we can rollback the transaction
          // so that none of the changes are persisted to the database.
          try {
              $result = $callback($this);

              DB::commit();
          }

          // If we catch an exception, we will roll back so nothing gets messed
          // up in the database. Then we'll re-throw the exception so it can
          // be handled how the developer sees fit for their applications.
          catch (\Exception $e) {
              DB::rollBack();

              return $e->getMessage();
          }

        return $result;
    }
}
