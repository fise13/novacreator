<?php
require_once 'config.php';

function sendPushNotification($clientId, $title, $message, $url = null) {
    $subscriptions = loadSubscriptions();
    $clientSubscriptions = array_filter($subscriptions, function($sub) use ($clientId) {
        return $sub['client_id'] == $clientId;
    });
    
    if (empty($clientSubscriptions)) {
        return false;
    }
    
    $vapidPublicKey = getenv('VAPID_PUBLIC_KEY') ?: 'BAu829izfGzXhqCafmsCdylgoMCqYTKVdzJSIft7orDyAYBxk0VenPv2GOuyxISF3AaleH8Qb3AokrhwHN4Ecg0';
    $vapidPrivateKey = getenv('VAPID_PRIVATE_KEY') ?: 'utERA94z2T_VBXuAeUO1oVUWngAuuOpaCKrlnpDt9-M';
    
    $results = [];
    
    foreach ($clientSubscriptions as $sub) {
        $subscription = $sub['subscription'];
        
        if (!isset($subscription['endpoint']) || !isset($subscription['keys'])) {
            continue;
        }
        
        $endpoint = $subscription['endpoint'];
        $userPublicKey = $subscription['keys']['p256dh'] ?? '';
        $userAuth = $subscription['keys']['auth'] ?? '';
        
        $payload = json_encode([
            'title' => $title,
            'body' => $message,
            'icon' => '/assets/img/logo.svg',
            'badge' => '/assets/img/logo.svg',
            'data' => [
                'url' => $url ?: '/client/dashboard.php'
            ]
        ]);
        
        $encryptedPayload = encryptPayload($payload, $userPublicKey, $userAuth, $vapidPublicKey);
        
        if (!$encryptedPayload) {
            continue;
        }
        
        $audience = parse_url($endpoint, PHP_URL_SCHEME) . '://' . parse_url($endpoint, PHP_URL_HOST);
        $jwt = generateVAPIDJWT($vapidPrivateKey, $vapidPublicKey, $audience);
        
        if (!$jwt) {
            continue;
        }
        
        $headers = [
            'Authorization: vapid t=' . $jwt . ', k=' . base64url_encode($vapidPublicKey),
            'Content-Type: application/octet-stream',
            'Content-Encoding: aes128gcm',
            'TTL: 86400'
        ];
        
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encryptedPayload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        $results[] = [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'http_code' => $httpCode,
            'error' => $error
        ];
    }
    
    return !empty($results);
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function generateVAPIDJWT($privateKey, $publicKey, $audience) {
    $header = [
        'typ' => 'JWT',
        'alg' => 'ES256'
    ];
    
    $claims = [
        'aud' => $audience,
        'exp' => time() + 43200,
        'sub' => 'mailto:contact@novacreatorstudio.com'
    ];
    
    $headerEncoded = base64url_encode(json_encode($header));
    $claimsEncoded = base64url_encode(json_encode($claims));
    
    $signatureInput = $headerEncoded . '.' . $claimsEncoded;
    
    if (function_exists('openssl_sign')) {
        $privateKeyPEM = base64url_decode($privateKey);
        $signature = '';
        
        if (@openssl_sign($signatureInput, $signature, $privateKeyPEM, OPENSSL_ALGO_SHA256)) {
            $signatureEncoded = base64url_encode($signature);
            return $headerEncoded . '.' . $claimsEncoded . '.' . $signatureEncoded;
        }
    }
    
    return null;
}

function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function encryptPayload($payload, $userPublicKey, $userAuth, $vapidPublicKey) {
    if (!function_exists('openssl_encrypt')) {
        return null;
    }
    
    $userPublicKeyBinary = base64url_decode($userPublicKey);
    $userAuthBinary = base64url_decode($userAuth);
    
    $salt = random_bytes(16);
    $keyInfo = 'Content-Encoding: aes128gcm' . "\0";
    $keyInfo .= 'P-256' . "\0" . "\0" . "\0";
    $keyInfo .= chr(strlen($vapidPublicKey)) . $vapidPublicKey;
    $keyInfo .= chr(strlen($userPublicKeyBinary)) . $userPublicKeyBinary;
    
    $ikm = hash_hkdf('sha256', $userAuthBinary, 32, $keyInfo, $salt);
    
    $nonce = random_bytes(12);
    $ciphertext = openssl_encrypt($payload, 'aes-128-gcm', $ikm, OPENSSL_RAW_DATA, $nonce, $tag);
    
    if ($ciphertext === false) {
        return null;
    }
    
    return $salt . $nonce . $ciphertext . $tag;
}

function hash_hkdf($algo, $ikm, $length, $info = '', $salt = '') {
    $prk = hash_hmac($algo, $ikm, $salt, true);
    $okm = '';
    $hashLen = strlen(hash($algo, '', true));
    $rounds = ceil($length / $hashLen);
    
    for ($i = 1; $i <= $rounds; $i++) {
        $okm .= hash_hmac($algo, $okm . $info . chr($i), $prk, true);
    }
    
    return substr($okm, 0, $length);
}
?>

