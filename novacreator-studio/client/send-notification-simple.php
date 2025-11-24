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
    
    $vapidPublicKey = 'BAu829izfGzXhqCafmsCdylgoMCqYTKVdzJSIft7orDyAYBxk0VenPv2GOuyxISF3AaleH8Qb3AokrhwHN4Ecg0';
    $vapidPrivateKey = 'utERA94z2T_VBXuAeUO1oVUWngAuuOpaCKrlnpDt9-M';
    
    if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
        require_once __DIR__ . '/../vendor/autoload.php';
        
        try {
            $webPush = new \Minishlink\WebPush\WebPush([
                'VAPID' => [
                    'subject' => 'mailto:contact@novacreatorstudio.com',
                    'publicKey' => $vapidPublicKey,
                    'privateKey' => $vapidPrivateKey,
                ],
            ]);
            
            foreach ($clientSubscriptions as $sub) {
                $subscription = $sub['subscription'];
                
                try {
                    $webPush->queueNotification(
                        \Minishlink\WebPush\Subscription::create([
                            'endpoint' => $subscription['endpoint'],
                            'keys' => [
                                'p256dh' => $subscription['keys']['p256dh'] ?? '',
                                'auth' => $subscription['keys']['auth'] ?? '',
                            ],
                        ]),
                        json_encode([
                            'title' => $title,
                            'body' => $message,
                            'icon' => '/assets/img/logo.svg',
                            'badge' => '/assets/img/logo.svg',
                            'data' => [
                                'url' => $url ?: '/client/dashboard.php'
                            ]
                        ])
                    );
                } catch (\Exception $e) {
                    error_log('Ошибка добавления уведомления в очередь: ' . $e->getMessage());
                }
            }
            
            foreach ($webPush->flush() as $report) {
                if (!$report->isSuccess()) {
                    error_log('Ошибка отправки push: ' . $report->getReason());
                }
            }
            
            return true;
        } catch (\Exception $e) {
            error_log('Ошибка WebPush: ' . $e->getMessage());
            return false;
        }
    }
    
    return false;
}
?>

