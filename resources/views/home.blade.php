<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  @if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.title') != '')
  <title>{{ config('advanced-config.title') }}</title>
  @else
  <title>{{ config('app.name') }}</title>
  @endif

  <?php $cleaner_input = strip_tags($message->home_message); ?>

  @if(env('CUSTOM_META_TAGS') == 'true')
  @include('layouts.meta') 
  @else
  <meta name="description" content="{{ $cleaner_input }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @endif

  <!-- Custom icons font-awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" integrity="sha384-fZCoUih8XsaUZnNDOiLqnby1tMJ0sE7oBbNk2Xxf5x8Z4SvNQ9j83vFMa/erbVrV" crossorigin="anonymous"/>

  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  @if(file_exists(base_path("littlelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif

@if(config('advanced-config.home_theme') != '' and config('advanced-config.home_theme') != 'default')

  <!-- LittleLink Custom Theme: "{{config('advanced-config.home_theme')}}" -->

  <link rel="stylesheet" href="themes/{{config('advanced-config.home_theme')}}/brands.css">
  <link rel="stylesheet" href="themes/{{config('advanced-config.home_theme')}}/skeleton-auto.css">
@if(file_exists(base_path('themes/' . config('advanced-config.home_theme') . '/animations.css')))
  <link rel="stylesheet" href="<?php echo asset('themes/' . config('advanced-config.home_theme') . '/animations.css') ?>">
@else
  <link rel="stylesheet" href="{{ asset('littlelink/css/animations.css') }}">
@endif

@else
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animations.css') }}">
  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  @elseif (config('advanced-config.theme') == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  @elseif (config('advanced-config.theme') == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-auto.css') }}">
  @endif
@endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('littlelink/fonts/littlelink-custom.otf') }}) format("opentype")}</style>

</head>
<body>

@if(config('advanced-config.home_theme') != '' and config('advanced-config.home_theme') != 'default')
    <!-- Enables parallax background animations -->
    <div class="background-container">
    <section class="parallax-background">
      <div id="object1" class="object1"></div>
      <div id="object2" class="object2"></div>
      <div id="object3" class="object3"></div>
      <div id="object4" class="object4"></div>
      <div id="object5" class="object5"></div>
      <div id="object6" class="object6"></div>
      <div id="object7" class="object7"></div>
      <div id="object8" class="object8"></div>
      <div id="object9" class="object9"></div>
      <div id="object10" class="object10"></div>
      <div id="object11" class="object11"></div>
      <div id="object12" class="object12"></div>
    </section>
    </div>
    <!-- End of parallax background animations -->
@endif

<?php
$pages = DB::table('pages')->get();
foreach($pages as $page)
{
	//Gets value from database
}
?>

  <div class="container">
    <div class="row">
    <div class="sign" style="margin-top: 30px; text-align: right;">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('studioIndex') }}" class="underline spacing">Studio</a>
                    @else
                        <a href="{{ route('login') }}" class="underline spacing">Log in</a>

                        @if (Route::has('register') and $page->register == 'true')
                            <a href="{{ route('register') }}" class="underline spacing">Register</a>
                        @elseif (env('REGISTER_OVERRIDE') === true)
                            <a href="{{ route('register') }}" class="underline spacing">Register</a>
                        @endif
                    @endauth
              @endif
    </div>
      <div class="column" style="margin-top: 15%">
        <!-- Your Image Here -->
        @if(file_exists(base_path("littlelink/images/avatar.png" )))
        <img alt="avatar" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px">
        @else
        <div class="logo-container fadein">
           <img class="rotate" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="width:150px; height:150px;">
           <div class="logo-centered">l</div>
        </div>
        @endif

        <!-- Your Name -->
        <h1 class="mt-5 fadein"> {{ config('app.name') }} </h1>

        <!-- Short Bio -->
        <div class="mt-5 fadein">
		      <?php echo $message->home_message; ?>
        </div>
        

        <!-- Buttons -->
<?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
@if(config('advanced-config.use_custom_buttons') == 'true')
        <?php $array = config('advanced-config.buttons'); ?>
        @foreach($array as $button)
         @php $linkName = str_replace('default ','',$button['button']) @endphp
         @if($button['button'] === "custom" and $button['custom_css'] === "" or $button['custom_css'] === "NULL")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $button['button'] }} button button-hover icon-hover" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif>@if($button['icon'] == 'llc')<img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}llc.svg">@else<i style="color: {{ $button['icon'] }}" class="icon hvr-icon fa {{ $button['icon'] }}"></i>@endif{{ $button['title'] }}</a></div>
         @elseif($button['button'] === "custom" and $button['custom_css'] != "")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $button['custom_css'] }}" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif>@if($button['icon'] == 'llc')<img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}llc.svg">@else<i style="color: {{ $button['icon'] }}" class="icon hvr-icon fa {{ $button['icon'] }}"></i>@endif{{ $button['title'] }}</a></div>
         @elseif($button['button'] === "buy me a coffee")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-coffee button button-hover icon-hover" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif><img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}coffee.svg">Buy me a Coffee</a></div>
         @elseif($button['button'] === "custom_website"and $button['custom_css'] === "" or $button['custom_css'] === "NULL")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-custom_website button button-hover icon-hover" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif><img alt="button-icon" class="icon hvr-icon" src="http://www.google.com/s2/favicons?domain={{$link->link}}">{{ $button['title'] }}</a></div>
         @elseif($button['button'] === "custom_website" and $button['custom_css'] != "")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $button['custom_css'] }}" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif><img alt="button-icon" class="icon hvr-icon" src="http://www.google.com/s2/favicons?domain={{$link->link}}">{{ $button['title'] }}</a></div>
         @elseif($button['button'] === "space")
         <?php 
          if (is_numeric($button['title']) and $button['title'] < 10)
          echo str_repeat("<br>",$button['title']);
          elseif (is_numeric($button['title']) and $button['title'] >= 10)
          echo str_repeat("<br>",10);
          else
          echo "<br><br><br>"
          ?>
         @elseif($button['button'] === "heading")
         <h2>{{ $button['title'] }}</h2>
         @else
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $button['button'] }} button button-hover icon-hover" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif><img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . $linkName }}.svg">{{ ucfirst($linkName) }}</a></div>
         @endif
        @endforeach
@else
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-github button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/github.svg') }}">Github</div></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-twitter button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/twitter.svg') }}">Twitter</div></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-instagram button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/instagram.svg') }}">Instagram</div></div>
@endif
        </br></br>

      <div class="fadein">
        @if(config('advanced-config.home_footer') == 'custom')
        <p><?php $year = date("Y"); echo strtr(config('advanced-config.custom_home_footer_text'), array('{year}' => $year)); ?></p>
        @elseif(config('advanced-config.home_footer') == 'alt')
        <p><i style="position:relative;top:1px;" class="fa-solid fa-infinity"></i> - Button combinations</p>
        @elseif(config('advanced-config.home_footer') == 'false')
        @else
        <p>and {{ $countButton - 3 }} other buttons ...</p>
        @endif
      </div>

        <hr class="my-4" style="display:none">

        <p style="display:none">updated pages</p>

        <div class="updated" style="display:none">
        @foreach($updatedPages as $page)
          @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
          <a href="{{ url('') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" srcset="{{ asset("img/$page->littlelink_name" . "@2x.png 2x") }}" width="50px" height="50px">
          </a>
          @else
          <a href="{{ url('') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="50px" height="50px">
          </a>
          @endif
        @endforeach
        </div>

        @include('layouts.footer')

      </div>
    </div>
  </div>
</body>
</html>
