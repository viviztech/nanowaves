<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class Msg91Service
{
    protected $authKey;
    protected $senderId;
    protected $route;
    protected $baseUrl = 'https://control.msg91.com/api/v5';

    public function __construct()
    {
        $this->authKey = config('msg91.auth_key');
        $this->senderId = config('msg91.sender_id', 'NANOWS');
        $this->route = config('msg91.route', '4'); // 4 = Transactional, 1 = Promotional
    }

    /**
     * Send OTP to mobile number
     *
     * @param string $mobileNumber
     * @param int $otpLength
     * @param int $expiryMinutes
     * @return array
     */
    public function sendOTP(string $mobileNumber, int $otpLength = 6, int $expiryMinutes = 10): array
    {
        try {
            // Clean mobile number (remove spaces, dashes, etc.)
            $mobileNumber = preg_replace('/[^0-9]/', '', $mobileNumber);
            
            // Ensure mobile number starts with country code (91 for India)
            if (strlen($mobileNumber) == 10) {
                $mobileNumber = '91' . $mobileNumber;
            }

            // Generate OTP
            $otp = $this->generateOTP($otpLength);
            
            // Store OTP in cache for verification
            Cache::put("otp_{$mobileNumber}", $otp, now()->addMinutes($expiryMinutes));
            Cache::put("otp_attempts_{$mobileNumber}", 0, now()->addMinutes($expiryMinutes));

            // Prepare request data for MSG91 OTP API
            $data = [
                'authkey' => $this->authKey,
                'mobile' => $mobileNumber,
                'message' => config('msg91.otp_message', 'Your OTP for NanoWaves registration is {{otp}}. Valid for 10 minutes.'),
                'sender' => $this->senderId,
                'otp' => $otp,
                'otp_length' => $otpLength,
                'otp_expiry' => $expiryMinutes,
            ];

            // Send OTP via MSG91 API
            $response = Http::post($this->baseUrl . '/otp', $data);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if (isset($responseData['type']) && $responseData['type'] == 'success') {
                    Log::info('MSG91 OTP sent successfully', [
                        'mobile' => $mobileNumber,
                        'request_id' => $responseData['request_id'] ?? null,
                    ]);

                    return [
                        'success' => true,
                        'message' => 'OTP sent successfully',
                        'request_id' => $responseData['request_id'] ?? null,
                    ];
                } else {
                    Log::error('MSG91 OTP send failed', [
                        'mobile' => $mobileNumber,
                        'response' => $responseData,
                    ]);

                    return [
                        'success' => false,
                        'message' => $responseData['message'] ?? 'Failed to send OTP',
                    ];
                }
            } else {
                Log::error('MSG91 API request failed', [
                    'mobile' => $mobileNumber,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'message' => 'Failed to send OTP. Please try again.',
                ];
            }
        } catch (\Exception $e) {
            Log::error('MSG91 OTP exception', [
                'mobile' => $mobileNumber,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while sending OTP. Please try again.',
            ];
        }
    }

    /**
     * Verify OTP
     *
     * @param string $mobileNumber
     * @param string $otp
     * @return array
     */
    public function verifyOTP(string $mobileNumber, string $otp): array
    {
        try {
            // Clean mobile number
            $mobileNumber = preg_replace('/[^0-9]/', '', $mobileNumber);
            
            if (strlen($mobileNumber) == 10) {
                $mobileNumber = '91' . $mobileNumber;
            }

            // Check OTP attempts
            $attempts = Cache::get("otp_attempts_{$mobileNumber}", 0);
            if ($attempts >= 5) {
                return [
                    'success' => false,
                    'message' => 'Maximum verification attempts exceeded. Please request a new OTP.',
                ];
            }

            // Get stored OTP
            $storedOTP = Cache::get("otp_{$mobileNumber}");

            if (!$storedOTP) {
                return [
                    'success' => false,
                    'message' => 'OTP expired or invalid. Please request a new OTP.',
                ];
            }

            // Increment attempts
            Cache::put("otp_attempts_{$mobileNumber}", $attempts + 1, now()->addMinutes(10));

            // Verify OTP
            if ($storedOTP === $otp) {
                // Clear OTP and attempts from cache
                Cache::forget("otp_{$mobileNumber}");
                Cache::forget("otp_attempts_{$mobileNumber}");
                
                // Mark phone as verified
                Cache::put("phone_verified_{$mobileNumber}", true, now()->addHours(24));

                Log::info('MSG91 OTP verified successfully', [
                    'mobile' => $mobileNumber,
                ]);

                return [
                    'success' => true,
                    'message' => 'Phone number verified successfully',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid OTP. Please try again.',
                    'attempts_remaining' => 5 - ($attempts + 1),
                ];
            }
        } catch (\Exception $e) {
            Log::error('MSG91 OTP verification exception', [
                'mobile' => $mobileNumber,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while verifying OTP. Please try again.',
            ];
        }
    }

    /**
     * Check if phone number is verified
     *
     * @param string $mobileNumber
     * @return bool
     */
    public function isPhoneVerified(string $mobileNumber): bool
    {
        $mobileNumber = preg_replace('/[^0-9]/', '', $mobileNumber);
        
        if (strlen($mobileNumber) == 10) {
            $mobileNumber = '91' . $mobileNumber;
        }

        return Cache::has("phone_verified_{$mobileNumber}");
    }

    /**
     * Generate random OTP
     *
     * @param int $length
     * @return string
     */
    protected function generateOTP(int $length = 6): string
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= rand(0, 9);
        }
        return $otp;
    }

    /**
     * Resend OTP
     *
     * @param string $mobileNumber
     * @return array
     */
    public function resendOTP(string $mobileNumber): array
    {
        // Clear previous OTP and attempts
        $mobileNumber = preg_replace('/[^0-9]/', '', $mobileNumber);
        
        if (strlen($mobileNumber) == 10) {
            $mobileNumber = '91' . $mobileNumber;
        }

        Cache::forget("otp_{$mobileNumber}");
        Cache::forget("otp_attempts_{$mobileNumber}");

        return $this->sendOTP($mobileNumber);
    }
}

