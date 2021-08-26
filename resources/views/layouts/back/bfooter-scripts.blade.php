<!-- Scripts
================================================== -->
   
<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-migrate-3.3.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/mmenu.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/chosen.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/rangeslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/tooltips.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/custom.js') }}"></script>
<!-- Scripts
================================================== -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#booking-date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    cb(start, end);
    $('#booking-date-range').daterangepicker({
        "opens": "left",
        "autoUpdateInput": false,
        "alwaysShowCalendars": true,
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

// Calendar animation and visual settings
$('#booking-date-range').on('show.daterangepicker', function(ev, picker) {
    $('.daterangepicker').addClass('calendar-visible calendar-animated bordered-style');
    $('.daterangepicker').removeClass('calendar-hidden');
});
$('#booking-date-range').on('hide.daterangepicker', function(ev, picker) {
    $('.daterangepicker').removeClass('calendar-visible');
    $('.daterangepicker').addClass('calendar-hidden');
});
</script>
</body>
</html>