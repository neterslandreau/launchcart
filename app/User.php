<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ixudra\Curl\Facades\Curl;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'contact_list',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function createList(string $name)
    {
        $response = Curl::to('https://a.klaviyo.com/api/v2/lists')
            ->withData(['api_key' => env('KLAVIO_API_KEY'), 'list_name' => $name])
            ->asJson()
            ->post();
        return $response->list_id;
    }

}
