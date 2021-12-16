<?php
namespace Elsayednofal\BackendRoles\Models\Base;

/**
 * This is the model class for table "roles_pages".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $page_id
 * @property string $created_at
 * @property string $updated_at
*
 */
abstract class RolesPages extends BaseModel
{
    protected $table = 'roles_pages';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'role_id'=>'required|integer',
        'page_id'=>'required|integer',
    ];
    
    
    
    //=========Relations===============
        
    public function page()
    {
        return $this->belongsTo('\App\Models\Pages', 'page_id' );
    }
    
    public function role()
    {
        return $this->belongsTo('\App\Models\Roles', 'role_id' );
    }
    
}

?>