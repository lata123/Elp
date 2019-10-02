    $( document ).ready(function() {
        console.log( "document loaded" );
        //Get Card
        getCard();
    });

    function getCard()
    {
       $('.alert-success,.alert-danger').addClass('hide').removeClass('show');
        var user_id = $("input[name=user_id]").val();
        $.ajax({
           type:'POST',
           url:'/stripe/cards',
           data:{user_id:user_id},
           success:function(data){
               if(data.requestStatus == 'success')
               {
                  var card_html = '';
                  $.each(data.data, function(idx, obj) {
                      card_html+= '<div class="row py-1">';
                      card_html+= '<div class="col-6 pl-2r pr-0"><input class="form-check-input" type="radio" name="card_id" checked value="'+obj.id+'"><label class="form-check-label">'+obj.brand+'</label></div> <div class="col-3 pl-0 pr-0"><p>****'+obj.card_number+'</p></div> ';
                      if(obj.set_primary == 1)
                      {
                           card_html+= '<div class="col-3"><button class="btn-money-primary">Primary</button></div>';
                      }
                      card_html+= '</div>'
                  });
                  $('.card-list').html(card_html);
                  $("#wait-card").css("display", "none");
               }else{
                   $('.card-list').html(data.message);
                   $("#wait-card").css("display", "none");
               }


           }
        });
    }

    function addMoney()
    {
        $(".amount_err").hide();
        $("#amount").removeClass("is-invalid");
        $("#wait-money").css("display", "block");
        $('.alert-success-money,.alert-danger-money').addClass('hide').removeClass('show');
        var user_id = $("input[name=user_id]").val();
        var amount = $("input[name=amount]").val();
        var card_id = $("input[name=card_id]:checked").val();
        console.log(amount);
        $err = false;
        if(amount == '')
        {
            $("#amount").addClass("is-invalid");
            $(".amount_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(card_id == '' || card_id == undefined)
        {
            $("#card_id").addClass("is-invalid");
            $(".card_id_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(!$err)
        {
            $.ajax({
               type:'POST',
               url:'/stripe/add-money',
               data:{user_id:user_id,amount:amount,card_id:card_id},
               success:function(data){
                   if(data.requestStatus == 'success')
                   {
                       $('.alert-success-money').html('<p class="mb-0 text-center">'+data.message+'<p>').addClass('show');
                       $("#addmoney_form")[0].reset();
                       $("#wait-money").css("display", "none");
                   }else{
                       $('.alert-danger-money').html('<p class="mb-0 text-center">'+data.message+'<p>').addClass('show');
                       $("#wait-money").css("display", "none");
                   }
               }
            });
        }
    }

  function addCard()
    {
        $(".card_err, .month_err, .year_err,.cvv_err").hide();
        $("#card_no, #card_month, #card_year,#card_cvv").removeClass("is-invalid");
        $("#wait-card").css("display", "block");
        $('.alert-success-card,.alert-danger-card').addClass('hide').removeClass('show');
        var user_id = $("input[name=user_id]").val();
        var card_no = $("input[name=card_no]").val();
        var card_month = $("input[name=card_month]").val();
        var card_year = $("input[name=card_year]").val();
        var card_cvv = $("input[name=card_cvv]").val();
        var set_primary = $("input[name=set_primary]:checked").val();
        if(set_primary != 1)
            set_primary =0;

        $err = false;
        if(card_no == '')
        {
            $("#card_no").addClass("is-invalid");
            $(".card_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(card_month == '')
        {
            $("#card_month").addClass("is-invalid");
            $(".month_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(card_year == '')
        {
            $("#card_year").addClass("is-invalid");
            $(".year_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(card_cvv == '')
        {
            $("#card_cvv").addClass("is-invalid");
            $(".cvv_err").show();
             $err = true;
        }else{
            $err = false;
        }
        if(!$err)
        {
            $.ajax({
               type:'POST',
               url:'/stripe/add-card',
               data:{user_id:user_id,card_no:card_no,card_month:card_month,card_year:card_year,card_cvv:card_cvv,set_primary:set_primary},
               success:function(data){
                   if(data.requestStatus == 'success')
                   {
                       getCard();
                       $('.alert-success-card').html('<p class="mb-0 text-center">'+data.message+'<p>').addClass('show');
                       $("#addcard_form")[0].reset();
                   }else{
                       $('.alert-danger-card').html('<p class="mb-0 text-center">'+data.message+'<p>').addClass('show');
                   }
                   $("#wait-card").css("display", "none");
               }
            });
        }else{
            $("#wait-card").css("display", "none");
        }
    }
    $( window ).on( "load", function() {
        console.log( "window loaded" );
    });
