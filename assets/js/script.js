   
    //up and down number for quantity in carts
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');


      var id = $(this).prop('id').replace("Hidden", "");
      var rowid = document.getElementById("rowid" + id).value;
      

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");

        var qty = document.getElementById("qty" + id).value;

        window.location = 'http://localhost/ecommerce/shopping/updatecart/' + rowid + '/' + qty;
        // alert(rowid);
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");

        var qty = document.getElementById("qty" + id).value;

        window.location = 'http://localhost/ecommerce/shopping/updatecart/' + rowid + '/' + qty;
        // alert('http://localhost/ecommerce/shopping/updatecart/' + rowid + '/' + qty);
      });

    });





    //reveal password
    $(".reveal").on('click',function() {
      var $pwd = $(".pwd");
      if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
      } else {
        $pwd.attr('type', 'password');
      }
    });

    $(".reveal2").on('click',function() {
      var $pwd = $(".pwd2");
      if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
      } else {
        $pwd.attr('type', 'password');
      }
    });




    //for nested tabs in user account
    $("#sidebartab .nav-link").on("click", function(){
      var curId = $(this).attr("href");
      $(".tab-pane").removeClass("active show");
      $(".nav-justified .nav-link").removeClass("active");
      // $(".tab-pane" + curId).addClass("active show");
    });




    //registration form validation
    (function() {
      'use strict';

      window.addEventListener('load', function() {
        var form = document.getElementById('needs-validation');
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      }, false);
    })();



    //SET AUTOFOCUS KE PALING BAWAH KALO ADA ERROR DI REGISTER
    $(function() {
      var link = location.href;
      if(link.includes("gagal") || link.includes("dashboard/adduser/sukses")){
        $("#btnsubmit").get(0).focus();
      }
    });
