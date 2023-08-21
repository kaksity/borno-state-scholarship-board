<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\RemitaServiceInterface;
use Illuminate\Support\Facades\Http;

class RemitaServiceImplementation implements RemitaServiceInterface {
    public function initiatePayment($options)
    {
        $orderId = generateTransactionReferenceCode();
        $remitaConfigurations = $this->getRemitaConfigurations();

        $serviceTypeId = $options['service_type_id'];
        $totalAmount = $options['amount'];
        
        $apiHash = $this->generateRemitaHash([
            'merchant_id' => $remitaConfigurations['merchant_id'],
            'service_type_id' => $serviceTypeId,
            'order_id' => $orderId,
            'amount' => $totalAmount,
            'api_key' => $remitaConfigurations['api_key']
        ], true);

        $url = "{$remitaConfigurations['url']}/echannelsvc/merchant/api/paymentinit";
        dd("remitaConsumerKey={$remitaConfigurations['merchant_id']},remitaConsumerToken={$apiHash}",json_encode([
            "serviceTypeId" => $serviceTypeId,
            "amount" => $totalAmount,
            "orderId" => $orderId,
            "payerName" => "{$options['surname']} {$options['other_names']}",
            "payerEmail" =>  $options['email_address'],
            //"payerPhone" => $options['phone_number'],
            "description" => $options['description'],
        ]));
        $response = Http::withHeaders([
            "Authorization" => "remitaConsumerKey={$remitaConfigurations['merchant_id']},remitaConsumerToken={$apiHash}"
        ])->post($url,[
            "serviceTypeId" => $serviceTypeId,
            "amount" => $totalAmount,
            "orderId" => $orderId,
            "payerName" => "{$options['surname']} {$options['other_names']}",
            "payerEmail" =>  $options['email_address'],
            //"payerPhone" => $options['phone_number'],
            "description" => $options['description'],
        ]);

        $responseData = $response->body();

        $preparedJsonResponse = str_replace(['jsonp (', ')'],'',$responseData);
        $remita = json_decode($preparedJsonResponse);
        dd($remita);
        return [
            'order_id' => $orderId,
            'api_hash' => $apiHash,
            'rrr' => $remita->RRR,
            'amount' => $totalAmount
        ];
    }

    public function getRemitaConfigurations()
    {
        return [
            'merchant_id' => env('REMITA_MERCHANT_ID'),
            'api_key' => env('REMITA_API_KEY'),
            'url' => env('REMITA_URL'),
            // 'service_type_id' => env('REMITA_SERVICE_TYPE_ID'),
            'public_key' => env('REMITA_PUBLIC_KEY')
        ];
    }

    public function generateRemitaHash($options, $payment = true)
    {
        if ($payment == true) {
            return hash(
                'sha512',
                "{$options['merchant_id']}{$options['service_type_id']}{$options['order_id']}{$options['amount']}{$options['api_key']}"
            );
        } else {
            return hash(
                'sha512',
                "{$options['rrr']}{$options['api_key']}{$options['merchant_id']}"
            );
        }
        
    }

    public function verifyPayment($options)
    {
        $remitaConfigurations = $this->getRemitaConfigurations();
        $merchantId = $remitaConfigurations['merchant_id'];

        $apiVerificationHash = $this->generateRemitaHash([
            'merchant_id' => $merchantId,
            'rrr' => $options['rrr'],
            'api_key' => $remitaConfigurations['api_key'],
        ], false);

        $url = "{$remitaConfigurations['url']}/echannelsvc/{$merchantId}/{$options['rrr']}/{$apiVerificationHash}/status.reg";

        $response = Http::withHeaders([
            'Authorization' => "remitaConsumerKey={$merchantId},remitaConsumerToken={$apiVerificationHash}",
            'Content-Type' => 'application/json',
        ])->get($url);

        return json_decode($response->body());
    }
}
