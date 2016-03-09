<?php

namespace App\Http\Models;

use DB;
use App\Services\Coder;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    protected $_parent;

    public function __construct(Coder $coder)
    {
        $this->_parent = $coder;
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

    public function __call($method, $args)
    {
        if (is_callable(array($this->_parent, $method))) {
            return call_user_func_array(array($this->_parent, $method), $args);
        }

        return call_user_func_array(array($this, $method), $args);
    }
}
