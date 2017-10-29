   
    //up and down number for quantity in carts
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');
      var rowid = document.getElementById("rowid").value;
      

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");

        var qty = document.getElementById("qty").value;

        window.location = 'http://localhost/ecommercepekanita/shopping/updatecart/' + rowid + '/' + qty;
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

        var qty = document.getElementById("qty").value;

        window.location = 'http://localhost/ecommercepekanita/shopping/updatecart/' + rowid + '/' + qty;
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




    //for nested tabs
    $("#sidebartab .nav-link").on("click", function(){
      var curId = $(this).attr("href");
      $(".tab-pane").removeClass("active show");
      $(".nav-justified .nav-link").removeClass("active");
      // $(".tab-pane" + curId).addClass("active show");
    });