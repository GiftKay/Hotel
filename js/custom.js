$(function() {
    $("#dates").flatpickr({
        mode:'range',
        minDate:'today',
        altFormat:'d F y',
        altInput: true,
        onClose : function(dates, dateStr, instance) {
            var checkIn = moment(dates[0]).format('D MMMM YYYY');
            var checkOut = moment(dates[1]).format('D MMMM YYYY');
            var days = moment(dates[1]).diff(moment(dates[0]),'days');
            $("#dates_range").find('label').text("Dates - "+days+" days");
            $("#check_in").val(checkIn);
            $("#check_out").val(checkOut);
            console.log(checkIn, checkOut, days);
            $('#check_in').val();
        }
    });

    var date1 ="";
    var date2 = "";

    $("#dates_modal").flatpickr({
        mode:'range',
        minDate:'today',
        altFormat:'d F y',
        altInput: true,
        onClose : function(dates, dateStr, instance) {
            var checkIn = moment(dates[0]).format('D MMMM YYYY');
            var checkOut = moment(dates[1]).format('D MMMM YYYY');
            var days = moment(dates[1]).diff(moment(dates[0]),'days');
            $("#dates_range_modal").find('label').text("Dates - "+days+" days");
            $("#checkIn").val(checkIn);
            $("#checkOut").val(checkOut);
            console.log(checkIn, checkOut, days);
        }
    });

    if($("#listDiv").children().length <=0)
    {
        $("#listDiv").append('<div class="alert alert-info"><p>No rooms found!</p></div>');
    }

    $('#reserveForm').on('submit', function(e) {
        $('#reserveForm').find('p').fadeOut();
        if($('#dates_modal').val() =='')
        {
            e.preventDefault();
            $('#dates_modal').parents('.form-group').find('p').text('Dates are required').fadeIn();
        }
        $(e.currentTarget).submit();
    })
});