<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Session;
use App\Gym;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $session = Session::find($this->session_id);
        return [
            "id"=> $this->id,
            "attendanded_at" => $this->attended_at,
            "session" => Session::find($this->session_id)->name,
            "gym" => Gym::find($session->gym_id)->name
        ];
    }
}
