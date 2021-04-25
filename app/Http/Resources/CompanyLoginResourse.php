<?php

namespace App\Http\Resources;

use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;

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
                'foundation_name' => $this->profile->foundation_name,
            ],
            "access_token" => [
                'token' => $token,
                'token_type' => 'Bearer',
            ],

        ];
    }
}
