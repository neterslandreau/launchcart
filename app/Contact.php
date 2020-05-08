<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['user_id', 'name', 'email', 'phone'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function addContact(string $list_id, Contact $contact)
    {
        $profile = [
        'email' => $contact->email,
            'phone_number' => $contact->phone,
            'name' => $contact->name
        ];

        $url = 'https://a.klaviyo.com/api/v2/list/'.$list_id.'/subscribe';

        $response = Curl::to($url)
            ->withData(['api_key' => env('KLAVIO_API_KEY'), 'profiles' => $profile])
            ->enableDebug('/Users/nilesrowland/Projects/launchcart/curllog.txt')
            ->returnResponseObject()
            ->asJson()
            ->post();
        return $response;
    }

    public static function editContact(string $listId, Contact $contact)
    {
        //
        return true;
    }

    public static function deleteContact(string $listId, Contact $contact)
    {
        $profile = [
            'emails' => [
                $contact->email
            ],
        ];

        $url = 'https://a.klaviyo.com/api/v2/list/'.$listId.'/members';
//        dd(json_encode($profile));
        $response = Curl::to($url)
            ->withData(['api_key' => env('KLAVIO_API_KEY'), 'profiles' => $profile])
            ->enableDebug('/Users/nilesrowland/Projects/launchcart/curllog.txt')
            ->returnResponseObject()
            ->asJson()
            ->delete();
        return $response;
    }
}
