<div @stack('class_footer')>

    @stack('newsletter')



    <div class="sub-footer">
        <div class="container">
            <div class="row">

                @stack('footer_pages')

                <div class="col-lg-12">
                    <div class="element-footer">
                        <ul>

                            <li> <a href="{{route('website.static-page','about-us')}}"> من نحن</a></li>
                            <li> <a href="{{route('website.static-page','privacy-policy')}}">سياسة الخصوصية </a></li>
                            <li><a href="{{route('website.static-page','user-agreement')}}">اتفاقية المستخدم</a></li>
                            <li> <a href="{{route('website.static-page','help-center')}}">مركز المساعدة</a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="madia">
                        <ul>

                            <li><a href="{{ $instagram->value }}" target="_blank"><i class="fab fa-instagram"></i>  </a></li>
                            <li><a href="{{ $facebook->value }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $snapchat->value }}" target="_blank"><i class="fab fa-snapchat-ghost"></i></a></li>
                            <li><a href="{{ $twitter->value }}" target="_blank"><i class="fab fa-twitter"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="end-page">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p> جميع الحقوق محفوظة   &copy;    لمنصة قطع غيار </p>
                </div>

                <div class="col-lg-6">
                    <a href="https://jaadara.com/"> صنع بكل حب    <i class="fas fa-heart"></i>   في معامل جدارة</a>
                </div>

            </div>

        </div>
    </div>
</div>