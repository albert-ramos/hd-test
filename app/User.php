<?php

namespace App;

use Firebase\JWT\JWT;
use App\Models\Widget;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    /**
     * HELPERS
     */
    static public function isLoginValid($data) {
        $user = self::where('email', $data['email'])->first();

        if($user === null)
            return false;

        if(Hash::check($data['password'], $user->password))
            return $user;

        return false;
    }


    public function createAuthToken() {
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $this->id,
            'iat' => time(),
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }


    /**
     * RELATIONSHIPS
     */
    public function widgets() {
        return $this->hasMany(Widget::class);
    }
}
