<?php namespace App;

//use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['user_id', 'name', 'email', 'phone'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
