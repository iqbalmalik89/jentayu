<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

	public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%");
                    // ->orWhere("email", "LIKE", "%$keyword%")
                    // ->orWhere("blood_group", "LIKE", "%$keyword%")
                    // ->orWhere("phone", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

}