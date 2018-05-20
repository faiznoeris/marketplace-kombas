  $(document).ready(function(){

    //EDIT PRODUCT, DELETE GALLERI 

    $('#cbdelpict_1').change(function (){

      if(this.checked) {
        $('#uniform-uplpict_1').hide();
      }else{
       $('#uniform-uplpict_1').show();
     } 
   });

    $('#cbdelpict_2').change(function (){
     if(this.checked) {
      $('#uniform-uplpict_2').hide();
    }else{
     $('#uniform-uplpict_2').show();
   } 
 });

    $('#cbdelpict_3').change(function (){
     if(this.checked) {
      $('#uniform-uplpict_3').hide();
    }else{
     $('#uniform-uplpict_3').show();
   } 
 });

    $('#cbdelpict_4').change(function (){
     if(this.checked) {
      $('#uniform-uplpict_4').hide();
    }else{
     $('#uniform-uplpict_4').show();
   } 
 });

    $('#cbdelpict_5').change(function (){
     if(this.checked) {
      $('#uniform-uplpict_5').hide();
    }else{
     $('#uniform-uplpict_5').show();
   } 
 });
    
    //EDIT PRODUCT, DELETE GALLERI 

    $('#provinsi').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var prov = $('#provinsi').val();

        // alert(prov);

        $.ajax({
          type : 'GET',
          url : 'http://marketplace-kombas.com/Ajax/getkabupaten/' + prov,
          // data :  'prov_id=' + prov,
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              // alert(prov);
              //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
              $("#kabupaten").html(data.options);
            }else{
              // alert('aa');
            }
          }
        });
      });

    //untuk halaman account kalo misal urlnya profile#riwayat dia langsung buka tab riwayat
    var url = document.location.toString();
    if (url.match('#')) {
      $('.navbar-nav a[href="#' + url.split('#')[1] + '"]').tab('show');
    } 

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      window.location.hash = e.target.hash;
    });

    $('.your-class').slick({
     //arrows: false,
     //variableWidth: true,
     //adaptiveHeight: true
     dots: true,
     infinite: true,
     speed: 1000,
     slidesToShow: 3,
     slidesToScroll: 3,
     cssEase: 'linear',
     autoplay: true,
     responsive: [
     {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    ],

  });



    var $input = $('<li><a href="http://marketplace-kombas.com/shopping/cart" style="background: #fff !important; color: #64B5F6 !important;"><i class="icon-arrow-left7"></i>&emsp;Kembali ke keranjang belanja</a></li>');

    $input.prependTo($('ul[aria-label=Pagination]'));

    $('.product-gallery').slick({
      arrows: false,
      //variableWidth: true,
      //adaptiveHeight: true
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 2,
      slidesToScroll: 2,
      cssEase: 'linear',
      responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
            // arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        ],

      });

    $('#alamat').change(function(){
      var id = $('#alamat').val();

        // alert(prov);

        $.ajax({
          type : 'GET',
          url : 'http://marketplace-kombas.com/Ajax/getalamat/' + id,
          // data :  'prov_id=' + prov,
          dataType: 'json',
          beforeSend:function(){
            $("#alamatbox").html("Loading...");
          },
          success: function (data) {
            if (data.success) {
              // alert(prov);
              //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
              $("#alamatbox").html(data.options);
              $("#alamatbox2").html(data.options);
              $("#alamatbox3").html(data.options);

              $("#ongkir_table").html(data.options2);

              var id_prod = data.list_id_prod;

              var id_split = id_prod.split("|");

              for (i = 0; i < id_split.length; i++) { 
                $("#kurir"+id_split[i+1]).select2();
                // alert(id_split[1]);
              }

              // $("#kurir10").select2();
            }else{
              // alert('aa');
            }
          }
        });
      });

      // $('#kurir').val('jne').trigger('change');

      var id_before = "";
      var duit_before = "";
      var totalongkir = 0;
      var total = 0;

      //INCLUDE SALDO WHEN ORDER

      $('#incl_saldo').on('change', function(){

        if(this.checked) {
          var val = $('#input_total_trf').val();
          var current_saldo = $('#current_saldo_trf').val();
          var total = val - current_saldo;

          var number_string = total.toString(),
          sisa  = number_string.length % 3,
          rupiah  = number_string.substr(0, sisa),
          ribuan  = number_string.substr(sisa).match(/\d{3}/g);

          if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
          }

          rupiah = rupiah.toString().slice(0, -3);
          var kodeunik = $("#kode_unik_trf").val();
         // valnew = valnew.toString().slice(0, -3);


         $('#total_trf').html("<b>Rp. "+ rupiah + "<i style='color: red; font-size: 30px;'>" + kodeunik +"</i></b>");

          // $('[id="total_trf"]').html("<b>Rp. "+ rupiah + "<i style='color: red; font-size: 30px;'>" + rand +"</i></b>");
          $('[id="from_saldo_trf"]').val(current_saldo);

         // alert(valnew);

       }else{
        var total = $('#input_total_trf').val();
        // var current_saldo = $('#current_saldo_trf').val();
        // var total = val + current_saldo;

        var number_string = total.toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        rupiah = rupiah.toString().slice(0, -3);
        var kodeunik = $("#kode_unik_trf").val();
        // valnew = valnew.toString().slice(0, -3);


        $('#total_trf').html("<b>Rp. "+ rupiah + "<i style='color: red; font-size: 30px;'>" + kodeunik +"</i></b>");

        // $('[id="total_trf"]').html("<b>Rp. "+ rupiah + "<i style='color: red; font-size: 30px;'>" + rand +"</i></b>");
        $('[id="from_saldo_trf"]').val('0');

        // alert(valnew);

      }


    });

      $('#ongkir_table').on('click', '.tipepaket', function(){

        // $('#incl_saldo').prop('checked', false);


        var val = this.value;
        var val = val.split("|");

        // alert(id_before + " - " + duit_before);

        // alert(val[4]);

        if(id_before != val[1]){
          totalongkir = totalongkir + parseInt(val[3]);
        }else{
          if(duit_before != val[3]){
            totalongkir = totalongkir - duit_before;
            totalongkir = totalongkir + parseInt(val[3]);
          }
        }

        total = parseInt(val[4]) + totalongkir;

        id_before = val[1];
        duit_before = val[3];

        var number_string = val[3].toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        $('[id="ongkirphase4_'+val[1]+'"]').html("<b>Rp. "+rupiah+"</b>");



        var number_string = totalongkir.toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        $('[id="total_ongkir"]').html("<b>Rp. "+rupiah+"</b>");




        var number_string = total.toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }


        $('[id="total"]').html("<b>Rp. "+rupiah+"</b>");

        var rand = Math.floor((Math.random() * 999) + 1);
        var last3 = rupiah.substr(rupiah.length - 3);

        while(rand < last3){ //get kode unik higher than last 3 digit before random
          rand = Math.floor((Math.random() * 999) + 1);
        }

        rupiah = rupiah.toString().slice(0, -3);
        // rupiah = rupiah + rand;

        $('[id="total_trf"]').html("<b>Rp. "+ rupiah + "<i style='color: red; font-size: 30px;'>" + rand +"</i></b>");

        total = total.toString().slice(0, -3);

        var totalbrg = parseInt(val[4]);
        // totalbrg = totalbrg.toString().slice(0, -3);

        $('[id="total_brg_trf"]').val(totalbrg);
        $('[id="input_total_trf"]').val(total + rand);
        $('[id="kode_unik_trf"]').val(rand);

        var balik_saldo = rand - last3;

        $('[id="balik_saldo_trf"]').val(balik_saldo);

        // $("#ongkir_table_4").append("<tr><td>"+val[3]+"</td></tr>");

        // $(val[3]).appendTo("#ongkirphase4_"+val[0]);

        // alert(val[3]);
      });


      $('#ongkir_table').on('change', 'select', function(){


      // $('.kurir').change(function(){
        // alert('aa');
        var id = this.value;

        var id = id.split("|");

        // alert('aa');

        $.ajax({
          type : 'GET',
          url : 'http://marketplace-kombas.com/Ajax/getongkir/' + id[0] + '/' + id[1] + '/' + id[2] + '/' + id[3] + '/' + id[4] + '/' + id[5],
          // data :  'prov_id=' + prov,
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              // alert(prov);
              //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
              $("#ongkir_"+id[4]).html(data.options);
              // alert(id[4]);
            }else{
              // alert('aa');
            }
          }
        });
      });

    });



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
      var idprod = document.getElementById("idprod" + id).value;
      

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

        window.location = 'http://marketplace-kombas.com/shopping/updatecart/' + rowid + '/' + qty + '/' + idprod;
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

        window.location = 'http://marketplace-kombas.com/shopping/updatecart/' + rowid + '/' + qty + '/' + idprod;
        // alert('http://localhost/ecommerce/shopping/updatecart/' + rowid + '/' + qty);
      });

    });







    //for nested tabs in user account
    $("#sidebartab .nav-link").on("click", function(){
      var curId = $(this).attr("href");
      $(".tab-pane").removeClass("active show");
      $(".nav-justified .nav-link").removeClass("active");
      // $(".tab-pane" + curId).addClass("active show");
    });




    //SET AUTOFOCUS KE PALING BAWAH KALO ADA ERROR DI REGISTER
    $(function() {
      var link = location.href;
      if(link.includes("gagal") || link.includes("dashboard/adduser/sukses")){
        $("#btnsubmit").get(0).focus();
      }
    });
