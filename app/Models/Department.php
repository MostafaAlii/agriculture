<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model implements TranslatableContract{
    
    use HasFactory,Translatable,SoftDeletes;
    
    protected $table = "departments";
    protected $fillable = ['parent_id','country_id','province_id','area_id','state_id','village_id'];

    protected $with=['translations'];
    public $translatedAttributes=['name','description','keyword','slug'];

    public $timestamps = true;

    protected $hidden = ['pivot'];
    
    public function childs() :HasMany{
        return $this->hasMany('App\Models\Department','parent_id','id') ;
    }

    public function department_country() : BelongsTo{
        return $this->belongsTo(Country::class,'country_id')->withDefault() ;
    }

    public function department_province(): BelongsTo {
        return $this->belongsTo(Province::class,'province_id')->withDefault();
    }
    
    public function department_area(): BelongsTo {
        return $this->belongsTo(Area::class,'area_id')->withDefault();
    }

    public function department_state(): BelongsTo {
        return $this->belongsTo(State::class,'state_id')->withDefault();
    }

    public function department_village(): BelongsTo {
        return $this->belongsTo(Village::class,'village_id')->withDefault();
    }
    

    public function related(){

        $found_or_no=0;
        
        $output='<center>';
        if (count(Admin::where('department_id', $this->id)->get())> 0){
            $found_or_no++;
            $output.='<h3>'. __('Admin\departments.relate_with_users').'</h3>';
        }
        if (count(Farmer::where('department_id', $this->id)->get()) > 0){
            $found_or_no++;
            $output.= '<h3>'. __('Admin\departments.relate_with_farmers').'</h3>';
        }
        if (count(User::where('department_id', $this->id)->get()) > 0){
            $found_or_no++;
            $output.= '<h3>'. __('Admin\departments.relate_with_vendors').'</h3>';
        }
        if (count(Category::where('department_id', $this->id)->get()) > 0){
            $found_or_no++;
            $output.= '<h3>'. __('Admin\departments.relate_with_category').'</h3>';
        }
        if (count(Department::where('parent_id', $this->id)->get()) > 0){ //check if there are sub depart for this depart
            $found_or_no++;
            $output.= '<h3>'. __('Admin\departments.relate_with_sub').'</h3>';
        }
        $output.= '</center>';
        
        if($found_or_no>0){
            $output.= '<center><h3 style="color:red">'. __('Admin\departments.confirm_deletion').'</h3></center>';
        }else{
            $output.= '<center><h3 style="color:red">'. __('Admin/site.warning').'</h3></center>';
        }
        echo $output;
    }



/*
       public function department_country() {
        return $this->belongsTo('App\Models\Country','country_id') ;
    }

     public function department_province() {
        return $this->belongsTo('App\Models\Province','province_id') ;
    }
   
    public function department_area() {
        return $this->belongsTo('App\Models\Area','area_id') ;
    }

   public function department_state() {
        return $this->belongsTo('App\Models\State','state_id') ;
    }

    public function department_village() {
        return $this->belongsTo('App\Models\Village','village_id') ;
    }
*/

}
