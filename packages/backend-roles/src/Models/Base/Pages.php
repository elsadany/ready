<?php
namespace Elsayednofal\BackendRoles\Models\Base;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $link
 * @property string $source
 * @property string $module
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
*
 */
abstract class Pages extends BaseModel
{
    protected $table = 'pages';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'link'=>'required',
        'action'=>'required',
        'module'=>'required',
        'name'=>'required',
    ];
    
    
    
    //=========Relations===============
        
    public function rolesS()
    {
        return $this->hasMany('\App\Models\RolesPages', 'page_id' );
    }
    
}

?>