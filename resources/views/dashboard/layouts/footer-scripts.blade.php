<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('assetsdashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assetsdashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assetsdashboard/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assetsdashboard/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('assetsdashboard/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('assetsdashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('assetsdashboard/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assetsdashboard/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('assetsdashboard/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('assetsdashboard/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('assetsdashboard/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('assetsdashboard/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assetsdashboard/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assetsdashboard/plugins/side-menu/sidemenu.js')}}"></script>
@livewireScripts

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c4b4bd704946343fc922', {
      cluster: 'mt1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
</script>