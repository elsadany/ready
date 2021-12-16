<?php
namespace Elsayednofal\BackendRoles\Models;

class Roles extends Base\Roles
{
    function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->rules();
    }
    
    function rules()
    {
        $this->rules = array_merge(
            $this->rules,
            [
               
            ]
        );
    }
}

?>