<?php

namespace App\Services;

class Notify
{

    public static function getTokens($device_id, $user_id)
    {

        $deviceTokenRepository = \App::make('App\Repositories\DeviceTokenUserRepositoryInterface');

        if ($user_id != null) {
            $tokens = $deviceTokenRepository->whereHas('user', ['is_notify' => 1], [['user_id', $user_id]])->pluck('device_token');
        }

        return $tokens;
    }


    // public static function NotifyMob($send_to, $message, $title, $type = 'admin-message', $store_id = null, $order_id = null, $delegate_id = null, $user_id = null){
    // $title_ar, $title_en: title of notification
    // $msg_ar, $msg_en: body of notification
    // $user_id: reciever of notification
    // $type: receiver user type (user - estate_manager)
    // $data: id of created element, updated element, ..... to route to it
    // $not_type: notificfation type (created_reply_not, rent_expire_not, ...)
    public static function NotifyMob($msg_ar, $msg_en, $user_id, $device_id, $data = null)
    {

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $tokenList = null;
        if ($device_id == null) {
            $tokenList = SELF::getTokens($device_id, $user_id);
        }


        $notification = [
            'body' => \App::getLocale() == 'ar' ? $msg_ar : $msg_en,
            'data' => $data,
            'user_id' => $user_id,
            'image' => asset('admin/logo2.png'),
            'sound' => true,
        ];

        $extraNotificationData = [
            'data' => $data,
            'user_id' => $user_id,
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default",
            "badge" => "8",
            "color" => "#ffffff",
            "priority" => "high",
        ];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            'notification' => $notification,
            'data' => $extraNotificationData,
        ];

        // dump($fcmNotification);

        $headers = [
            'Authorization: key=AAAAvm5OHt8:APA91bEjouR_wSChmmz1ZTHOj45DoqfDoRfNmzeFnARWnCXIeLWH7jgbkAXlATU_FjVdBc1tOTxYEfToQCzVbje9Yp22p3a5n4tDLHpOlOvNvauEiywAyPYe0qmhQE2wE_SiG4kzPAas',
            'Content-Type: application/json'
        ];

        // dump($fcmNotification);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

        dd(json_decode($result));
        curl_close($ch);
    }
}
