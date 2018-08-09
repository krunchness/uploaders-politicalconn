<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FileInfo extends Model
{
    protected $fillable = ['title', 'uploaded_by', 'filename', 'file_desc', 'file_format'];

    // public function created_date($date)
    // {
    // 	$carbon = new Carbon($date);
    // 	return $carbon;
    // }
}
