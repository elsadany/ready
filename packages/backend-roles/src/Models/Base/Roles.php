<?php
namespace Elsayednofal\BackendRoles\Models\Base;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
*
 */
abstract class Roles extends BaseModel
{
    protected $table = 'roles';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'name'=>'required|unique:roles,name',
    ];
    
    
    
    //=========Relations===============
        
    public function pages()
    {
        return $this->hasMany('\App\Models\RolesPages', 'role_id' );
    }
    
}

?>