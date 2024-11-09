<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;

trait SendExternalApiTrait
{
    public function sendSms($postData): void
    {
        $authKey = "394926Aa8w1d5zh4SI662f3f25P1";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://control.msg91.com/api/v5/flow/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authkey: $authKey",
                "content-type: application/JSON"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }

    public function callWarehouseDeduction($billNo = "230100106021031169")
    {
        $url = "https://mpwarehousing.mp.gov.in/Warehouse/WS_Paymentdetails.asmx/GetRentBillDetails?RentBillNumber={$billNo}";
        $ch = curl_init();
        $headers = [
            "Accept: text/xml",
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if ($httpCode != 200) {
        // 	return false;
        // }
        $data = curl_exec($ch);

        curl_close($ch);
        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        return $array;
        //return ['{"StorageBillNumber":"212230100106022010321433","RentBillNumber":"230100106021031169","GrossAmount":8336,"TDS":834,"OtherDeduction":0,"PayableAmount":7503,"RentBillAmount":0,"CropYear":"2020-2021","FinancialYear":"2020-2021","Month":"3","Commodity":"Wheat-PSS"}'];
    }
}
