<li>
        @if(Config::get('app.locale') == 'pt')
            <a href="{{URL::to('lang?lang=Portuguese')}}">
            <img src="images/icon/flags/pt-br.jpg">
            {? $extra_lang = 'English' ?}
            {? $extra_lang_img = '<img src="images/icon/flags/en-us.jpg">' ?}
        @else
            <a href="{{URL::to('lang?lang=English')}}">
            <img src="images/icon/flags/en-us.jpg">
            {? $extra_lang = 'Portuguese' ?}
            {? $extra_lang_img = '<img src="images/icon/flags/pt-br.jpg">' ?}
        @endif
    </a>
</li>
<li>
        <a href="{{URL::to('lang?lang='. $extra_lang)}}" title="{{$extra_lang}}">{{$extra_lang_img}}</a>
</li>