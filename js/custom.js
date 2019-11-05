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

    if($("#listDiv").children().length <=0)
    {
        $("#listDiv").append('<div class="alert alert-info"><p>No rooms found!</p></div>');
    }

    // $('#reserveForm').on('submit', function(e) {
    //     // e.preventDefault();
    //     var firstname = $('#firstname');
    //     var surname = $('#surname');
    //     var cell = $('#cell');
    //     var email = $('#email');
    //     $(e.currentTarget).find('p').fadeOut();
    //     // if(firstname.val() == '')
    //     // {
    //     //    makeDirty(firstname,'First name is required');
    //     // }
    //     // else
    //     // {
    //     //     if(/A-Za-z/.test(firstname.val()) == false)
    //     //     {
    //     //         makeDirty(cell,'Invalid name was provided');
    //     //     }
    //     // }
    //     // if(surname.val() =='')
    //     // {
    //     //     makeDirty(surname,'Surname is required');
    //     // }
    //     // else
    //     // {
    //     //     if(/A-Za-z/.test(surname.val()) == false)
    //     //     {
    //     //         makeDirty(cell,'Invalid surname was provided');
    //     //     }
    //     // }
    //     // if(cell.val() =='')
    //     // {
    //     //     makeDirty(cell,'Cell is required');
    //     // }
    //     // else
    //     // {
    //     //     if(cell.val().length != 10 )
    //     //     {
    //     //         makeDirty(cell,'Invalid phone was provided');
    //     //     }
    //     // }
    //     // if(email.val() =='')
    //     // {
    //     //     makeDirty(email,'Email is required');
    //     // }

    //     // if(validEmail(email.val()))
    //     // {
    //     //     makeDirty(email,'Email is invalid');
    //     // }

    //     $(e.currentTarget).submit();
    // })

    function makeDirty(e, message)
    {
        $(e).parent('div').find('p').text(message).fadeIn();
    }

    function validEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function validEmail(n) 
    {
        var re = /A-Za-z/;
        return re.test(n);
    }
});