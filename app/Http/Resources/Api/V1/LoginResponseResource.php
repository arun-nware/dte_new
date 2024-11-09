<?php

namespace App\Http\Resources\Api\V1;

use App\Traits\TariffConfigurationTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponseResource extends JsonResource
{
    use TariffConfigurationTrait;

    public $data;

    public function __construct($response)
    {
        $this->data = $response;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $time = date("H:i:s", strtotime($request["reqTime"]));

        return [
            "reqDate" => $request["reqDate"],
            "reqTime" => $request["reqTime"],
            "response" => "SUCCESS",
            "respCode" => "200",
            "resDate" => date('Ymd'),
            "resTime" => date('His'),
            "userType" => $request["userType"],
            "userName" => $request["userName"],
            "firstName" => $this->data["user"]['first_name'],
            "lastName" => $this->data["user"]['last_name'],
            "mobileNumber" => $this->data["user"]['phone'],
            "output" =>
                [
                    "tariff" => $this->getTodayTariffs($time)
                ],
            "token" => $this->data['token']
        ];
    }
}
