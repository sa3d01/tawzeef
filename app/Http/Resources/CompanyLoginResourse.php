<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyLoginResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $token = auth('api')->login(User::find($this->id));
        User::find($this->id)->update([
            'last_login_at' => Carbon::now(),
            'last_ip' => $request->ip(),
        ]);
        return [
            "user" => [
                'id' => (int)$this->id,
                'type' => $this->type,
                'email' => $this->email,
                'avatar' => $this->avatar,
                'cover' => $this->profile->cover,
                'foundation_name' => $this->profile->foundation_name,
            ],
            "access_token" => [
                'token' => $token,
                'token_type' => 'Bearer',
            ],

        ];
    }
}
