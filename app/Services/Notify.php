<?php

namespace App\Services;

class Notify{

    static function Create($title_ar, $title_en, $msg_ar, $msg_en, $user_type, $id, $data = null, $route = null, $not_type = null){

        $notificationsRepository = \App::make('App\Repositories\NotificationRepositoryInterface');

        // $not_data = [];
        $not_data['msg_ar'] = $msg_ar;
        $not_data['msg_en'] = $msg_en;
        $not_data['title_ar'] = $title_ar;
        $not_data['title_en'] = $title_en;
        $not_data['notifiable_type'] = $user_type;
        $not_data['notifiable_id'] = $id;
        $not_data['mob_extra_data'] = $data;
        $not_data['web_route'] = $route;
        $not_data['type'] = $not_type;

        return $notificationsRepository->create($not_data);

    }

    public static function getTokens($device_id, $user_id){

        $deviceTokenRepository = \App::make('App\Repositories\DeviceTokenUserRepositoryInterface');

        if($user_id != null){

            $tokens = $deviceTokenRepository->getWhere([ ['user_id', $user_id],
                ['platform_type','!=','web']])->pluck('device_token');
        }
        else{
            $tokens = $deviceTokenRepository->getWhere([['platform_type','!=','web'],
                ['device_id', $device_id]])->pluck('device_token');
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
    public static function NotifyMob($title_ar, $title_en, $msg_ar, $msg_en, $user_id, $device_id,$data = null){

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $tokenList = SELF::getTokens($device_id, $user_id);
        $tokenList;

        $notification = [
            'title' => \App::getLocale() == 'ar' ? $title_ar : $title_en,
            'body' => \App::getLocale() == 'ar' ? $msg_ar : $msg_en,
            'data' => $data,
            'user_id' => $user_id,
            'image' => asset('admin/logo2.png'),
            'sound' => true,
        ];

        $extraNotificationData = [
            'data' => $data,
            'user_id' => $user_id,
            "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
            "sound"=> "default",
            "badge"=> "8",
            "color"=> "#ffffff",
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
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

//         dd(json_decode($result));
        curl_close($ch);
    }



}