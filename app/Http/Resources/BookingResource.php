<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{

    // public static $wrap = "bookings";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'entry_date_time' => $this->entry_date_time,
            'departure_date_time' => $this->departure_date_time,
            'entry_place' => $this->entry_place,
            'departure_place' => $this->departure_place,
            'status' => $this->status,
            'booking_type' => $this->bookingDetails->booking_type,
            'phone_number' => $this->bookingDetails->phone_number,
            'flight_number' => $this->bookingDetails->flight_number,
            'vehicle_brand' => $this->bookingDetails->vehicle_brand,
            'vehicle_model' => $this->bookingDetails->vehicle_model,
            'vehicle_registration' => $this->bookingDetails->vehicle_registration,
            'vehicle_color' => $this->bookingDetails->vehicle_color,
            'additional_notes' => $this->bookingDetails->additional_notes,
            'booking_id' => $this->bookingDetails->booking_id,
            'wash_type' => $this->bookingDetails->wash_type,
            'total_amount' => $this->bookingDetails->total_amount
        ];
    }
}
