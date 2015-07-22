<li>
        @if(Config::get('app.locale') == 'pt')
            <a href="{{URL::to('lang?lang=Portuguese')}}">
            <img src="images/icon/flags/pt-br.png">
            {? $extra_lang = 'English' ?}
            {? $extra_lang_img = '<img src="images/icon/flags/en-us.png">' ?}
        @else
            <a href="{{URL::to('lang?lang=English')}}">
            <img src="images/icon/flags/en-us.png">
            {? $extra_lang = 'Portuguese' ?}
            {? $extra_lang_img = '<img src="images/icon/flags/pt-br.png">' ?}
        @endif
    </a>
</li>
<li>
        <a href="{{URL::to('lang?lang='. $extra_lang)}}" title="{{$extra_lang}}">{{$extra_lang_img}}</a>
</li>