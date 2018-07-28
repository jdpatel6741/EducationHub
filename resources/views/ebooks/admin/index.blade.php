@php 
  $url = URL::to('/')."/ebooks/admin";
  $furl = URL::to('/'); 
@endphp

    <!--Top NavigationBar-->
    @include('ebooks.navbar')
	@include('ebooks.admin.menu')