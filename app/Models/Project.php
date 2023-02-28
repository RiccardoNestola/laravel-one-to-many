<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = array("title", "description", "category", "year", 'type_id', "thumb", "date_added");

    public function isImageAUrl()
    {
        return filter_var($this->thumb, FILTER_VALIDATE_URL);
    }


    public function type() {
        return $this->belongsTo(Type::class);
}

}
