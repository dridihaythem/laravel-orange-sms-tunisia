<?php

namespace DridiHaythem\OrangeSMSTunisia\Services;

use DridiHaythem\OrangeSMSTunisia\Models\Log;
use Illuminate\Support\Facades\Http;

class OrangeSMSTunisiaService
{
    private function authentication(): String
    {
        $request = Http::withHeader('Authorization', config('orange_sms_tunisia.authorization_header'))
            ->asForm()
            ->post('https://api.orange.com/oauth/v3/token', [
                'grant_type' => 'client_credentials'
            ]);

        $response = $request->json();

        if (!array_key_exists('access_token', $response)) {
            throw new \Exception('[OrangeSMSTunisia] Bad credentials.');
        }

        return $response['access_token'];
    }

    public function sendSms(int $phone, String $message)
    {
        if (config('orange_sms_tunisia.authorization_header') == null) {
            throw new \Exception('[OrangeSMSTunisia] authorization_header is null.');
        }

        if ($phone == null || $message == null) {
            throw new \Exception('[OrangeSMSTunisia] Phone number or message is null.');
        }

        if (!is_numeric($phone) || strlen($phone) > 8 || strlen($phone) < 8) {
            throw new \Exception('[OrangeSMSTunisia] Phone number is not valid.');
        }

        if (strlen($message) > 160) {
            throw new \Exception('[OrangeSMSTunisia] SMS message length exceeds the maximum limit of 160 characters.');
        }

        if (config('orange_sms_tunisia.enable_log')) {
            $log = Log::create([
                'phone_number' => $phone,
                'message' => $message
            ]);
        }

        $token = $this->authentication();

        $request = Http::withToken($token)
            ->post('https://api.orange.com/smsmessaging/v1/outbound/tel:+216' . config('orange_sms_tunisia.sender') . '/requests', [
                "outboundSMSMessageRequest" => [
                    "address" => "tel:+216" . $phone,
                    "senderAddress" => "tel:+216" . config('orange_sms_tunisia.sender'),
                    "outboundSMSTextMessage" => [
                        "message" => $message
                    ]
                ]
            ]);


        if ($request->created() && config('orange_sms_tunisia.enable_log')) {
            $log->update([
                'success' => true
            ]);
        }
    }
}
