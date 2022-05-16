<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::insert([
            [
                'key' => 'title_pro_ar',
                'neckname' => 'local.title_pro_ar',
                'type' => 'text',
                'value' => 'منصة قطع غيار ..',
                'orderby' => 1
            ],  [
                'key' => 'title_pro_en',
                'neckname' => 'local.title_pro_en',
                'type' => 'text',
                'value' => 'spare parts platform ..',
                'orderby' => 1
            ], [
                'key' => 'descr_pro_en',
                'neckname' => 'local.descr_pro_en',
                'type' => 'textarea',
                'value' => 'It seeks to achieve the most difficult equation, which is linking the merchant and the customer in a framework of transparency and mutual interest and achieving the general benefit of both the merchant or the service provider and the service requester.
                         . Or buy auto parts',
                'orderby' => 1
            ], [
                'key' => 'descr_pro_ar',
                'neckname' => 'local.descr_pro_ar',
                'type' => 'textarea',
                'value' => 'تسعى لتحقيق المعادلة الأصعب و هي الربط بين التاجر وا لعميل في إطار من الشفافية  و المصلحة المتبادلة و تحقيق النفع العام لكل من التاجر أو مقدم الخدمة و طالب الخدمة  منصة قطع غيار تسعى لتوفير الجهد و اختصار الوقت و تقليل التكلفة في عملية بيع
                        . أو اقتناء قطع غيار السيارات ',
                'orderby' => 1
            ], [
                'key' => 'desc_our_services_gallery_en',
                'neckname' => 'local.desc_our_services_gallery_en',
                'type' => 'textarea',
                'value' => 'This text is an example of text that can be replaced in the same space',
                'orderby' => 1
            ], [
                'key' => 'desc_our_services_gallery_ar',
                'neckname' => 'local.desc_our_services_gallery_ar',
                'type' => 'textarea',
                'value' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة',
                'orderby' => 1
            ],
            [
                'key' => 'image_pro_index',
                'neckname' => 'local.image_pro_index',
                'type' => 'file',
                'value' => 'images/01234.png',
                'orderby' => 1
            ],
            [
                'key' => 'email',
                'neckname' => 'local.email',
                'type' => 'email',
                'value' => 'auto-part@gmail.com',
                'orderby' => 1
            ],
            [
                'key' => 'phone',
                'neckname' => 'local.phone',
                'type' => 'number',
                'value' => '96655566586',
                'orderby' => 1
            ],
            [
                'key' => 'address',
                'neckname' => 'local.address',
                'type' => 'address',
                'value' => ' الرياض , المملكة العربية السعودية',
                'orderby' => 1
            ],
            [
                'key' => 'lat',
                'neckname' => 'local.lat',
                'type' => 'hidden',
                'value' => '42.6656456',
                'orderby' => 1
            ],
            [
                'key' => 'lng',
                'neckname' => 'local.lng',
                'type' => 'hidden',
                'value' => '42.6656456',
                'orderby' => 1
            ],
            [
                'key' => 'facebook',
                'neckname' => 'local.facebook',
                'type' => 'text',
                'value' => 'https://facebook.com',
                'orderby' => 1
            ],
            [
                'key' => 'instagram',
                'neckname' => 'local.instagram',
                'type' => 'text',
                'value' => 'https://instagram.com',
                'orderby' => 1
            ],
            [
                'key' => 'snapchat',
                'neckname' => 'local.snapchat',
                'type' => 'text',
                'value' => 'https://snapchat.com',
                'orderby' => 1
            ],
            [
                'key' => 'twitter',
                'neckname' => 'local.twitter',
                'type' => 'text',
                'value' => 'https://twitter.com',
                'orderby' => 1
            ],
            [
                'key' => 'website',
                'neckname' => 'local.website',
                'type' => 'text',
                'value' => 'https://twitter.com',
                'orderby' => 1
            ],
        ]);
    }
}
