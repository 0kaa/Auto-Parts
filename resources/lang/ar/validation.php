<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists'               => 'القيمة المحددة :attribute غير موجودة.',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورةً.',
    'in'                   => ':attribute غير موجود.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصًا من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => 'العنصر :attribute غير صحيح.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب تقديم :attribute.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'             => 'فشل في تحميل الـ :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'                 => ':attribute يجب أن يكون بصيغة UUID سليمة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'desc' => 'الرساله',
        'permissions' => 'الصلاحيات',
        'parent_id'                  => 'نوع القسم',
        'name'                  => 'الاسم ',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم الأول',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmed' => 'تأكيد كلمة المرور',
        'confirm_password' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',

        'military_number'                  => 'الرقم العسكري',
        'job_number'                  => 'الرقم الوظيفي',
        'date_expired'                  => 'تاريخ الانتهاء',
        'contact_number'                  => 'رقم التواصل',
        'name_person'                  => 'اسم شخص قريب',
        'notes'                  => 'الملاحظات ',
        'rays'                  => 'صورة الاشعة',


        'logo'                  => 'اللوجو',
        'image'                  => 'الصوره',
        'name_ar'                  => 'الاسم بالعربيه',
        'name_en'                  => 'الاسم بالانجليزيه',
        'descr_ar'                  => 'التفاصيل بالعربي',
        'descr_en'                  => 'التفاصيل بالانجليزيه',
        'about_ar'                  => 'النبذه التعريفيه بالعربي',
        'about_en'                  => 'النبذه التعريفيه بالانجليزي',
        'descr'                  => 'السبب ',


        'answer' => 'الاجابه',
        'ask_id' => 'السؤال',
        'country_id' => 'الدوله',
        'governorate_id' => 'المحافظه',
        'password_confirmation' => 'تأكيد كلمه المرور',
        'phone_key' => 'مفتاح الدوله',
        'platform' => 'المنصه',
        'device_id' => 'اي دي الخدمه',
        'token' => 'التوكن',
        'lat' => 'خط الطول',
        'lng' => 'خط العرض',
        'city_id' => 'المدينه',
        'special_id' => 'التخصص',
        'ask' => 'السؤال',

        'question_id' => 'الاي دي',
        'follwer_back_id' => 'الاي دي',
        'education_id' => 'الدرجه العلميه',
        'message' => 'الرساله',
        'form_date' => 'تاريخ البدء',
        'to_date' => 'تاريخ الانتهاء',
        'firebase_token' => 'الفايربيز توكن',
        'code' => 'كود التفعيل',
        'category_id' => 'القسم',
        'type_id' => 'النوع',
        'type' => 'النوع',
        'subcategory_id' => 'النوع',
        'category' => 'الفئة',
        'price' => 'السعر',
        'show_phone' => 'عرض الرقم',
        'commercial_register' => 'السجل التجاري',
        'tax_number' => 'الرقم الضريبي',
        'name_bank' => 'اسم البنك',
        'name_account_bank' => 'اسم الحساب ',
        'number_account_bank' => 'رقم الحساب ',
        'number_eban_bank' => 'رقم الايبان ',
        'new_password' => 'كلمة المرور الجديدة',
        'confirm_new_password' => 'تأكيد كلمة المرور الجديدة',
        'old_password' => 'كلمة المرور القديمة',
        'user' => 'المستخدم',
        'image_one' => 'الصورة الاولي',
        'image_two' => 'الصورة الثانية',
        'image_three' => 'الصورة الثالثة',
        'attr' => 'الخصائص والاختيارات',
        'the_walker' => 'الممشي',
        'make_year' => 'سنة الصنع',
        'number_of_shops' => 'عدد المحلات',
        'neighborhood' => 'الحي',
        'street_view' => 'عرض شارع الواجهه',
        'border' => 'الحدود',
        'number_halls_for_two' => 'عدد الصالات في الشقة 2',
        'women_boards_for_two' => 'مجالس النساء في الشقة 2',
        'men_boards_for_two' => 'مجالس الرجال في الشقة 2',
        'number_of_bedrooms_for_two' => 'عدد غرف النوم في الشقة 2',
        'number_halls_for_one' => 'عدد الصالات في الشقة 1',
        'women_boards_for_one' => 'مجالس النساء في الشقة 1',
        'men_boards_for_one' => 'مجالس الرجال في الشقة 1',
        'number_of_bedrooms_for_one' => 'عدد غرف النوم في الشقة 1',
        'shops' => 'محلات تجارية',
        'number_of_sections' => 'عدد الاقسام',
        'inside_height' => 'الارتفاع من الداخل',
        'street_or_lane_width' => 'عرض الشارع او الممر',
        'fuel_tank_capacity' => 'سعة خزانات الوقود',
        'number_pumps' => 'عدد المضخات',
        'on_highway' => 'علي طريق سريع',
        'storehouse' => 'عدد المستودع',
        'number_bathrooms' => 'عدد دورات المياة',
        'number_of_swimming_pools' => 'عدد المسابح',
        'number_halls' => 'عدد الصالات',
        'number_kitchens' => 'عدد المطابخ',
        'women_councils' => 'عدد مجالس النساء',
        'men_boards' => 'عدد مجالس الرجال',
        'number_of_master_bedrooms' => 'عدد غرف النوم الماستر',
        'number_bedroom' => 'عدد غرف النوم',
        'number_of_roles' => 'عدد الادوار',
        'building_erea' => 'مساحة البناء',
        'space' => 'مساحة الارض',
        'commission_amount' => 'مبلغ العمولة',
        'product_code' => 'رقم الاعلان',
        'name_user' => 'اسم المستخدم',
        'transfer_date' => 'تاريخ التحويل',
        'transfer_name' => 'اسم المحول',
        'bank_id' => 'البنك',
        'search'  => 'محتوي البحث',
        'report'  => 'السبب',
        'product_id'  => 'المنتج',
        'numebr_product'  => 'رقم الاعلان',

        
    ],
];
