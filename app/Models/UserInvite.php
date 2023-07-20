<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class UserInvite extends Model
{
    use HasFactory;
    protected $table = "user_invites";
    protected $fillable = ['id','email','token','role_id','billing_provider_ids','token_url','created_by', 'is_resend', 'resend_counter'];

    /**
     * Generates a new invitation token.
     *
     * @return bool|string
     */
    public function generateInvitationToken() {
        return $this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }

    /**
     * @return string
     */
    public function getLink($token) {
        //return urldecode(route('userRegistration') . '?invitation_token=' . $this->invitation_token);
        //$url = URL::temporarySignedRoute( 'users/invitation/accept', now()->addMinutes(300), ['token' => $this->invitation_token] );
        return urldecode(url('/users/invitation/accept', $token));
    }

    public function getRoleInfo()
     {
         return $this->hasOne(Role::class,  'id', 'role_id');
     }
     public function userBilligProviders()
     {
         return $this->hasMany(UserBillingProvider::class,  'user_id', 'id');
     }


}
