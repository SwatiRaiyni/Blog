<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'Title','Title_hi',
    //     'Description','Description_hi',
    //     'start_date','start_date_hi',
    //     'end_date','end_date_hi',
    //     'user_id','user_id_hi',
    //     'Image','Image_hi',

    // ];
    protected $guarded = ['id'];
    public $table = 'user_post';
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
