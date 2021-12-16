<?php
namespace Elsayednofal\BackendRoles\Models;

class Pages extends Base\Pages
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