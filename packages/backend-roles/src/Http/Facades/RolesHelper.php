<?php


namespace Elsayednofal\BackendRoles\Http\Facades;

use Illuminate\Support\Facades\Facade;


class RolesHelper extends Facade {
    protected static function getFacadeAccessor() { return 'Elsayednofal\BackendRoles\Http\Controllers\RolesHelper'; }

}
