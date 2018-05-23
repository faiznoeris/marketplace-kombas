<!-- THIS EMAIL WAS BUILT AND TESTED WITH LITMUS http://litmus.com -->
<!-- IT WAS RELEASED UNDER THE MIT LICENSE https://opensource.org/licenses/MIT -->
<!-- QUESTIONS? TWEET US @LITMUSAPP -->
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* MEDIA QUERIES */
    @media screen and (max-width: 480px) {
        .mobile-hide {
            display: none !important;
        }
        .mobile-center {
            text-align: center !important;
        }
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
       Notifikasi stok barang..
   </div>

   <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">

            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                <tr>
                    <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#42a5f5">

                        <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                <tr>
                                    <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                        <img src="https://image.ibb.co/jsA9vd/logo_light.png" style="font-size: 36px; font-weight: 800; margin: 0;">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">

                        </div>

                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                            <tr>
                                <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; border-bottom: 3px solid #eeeeee;"">
                                    <p style="font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;">
                                        Hello there <?= $reseller->username ?>,
                                    </p>
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                        Karena anda menyalakan notifikasi stok barang pada produk yang bernama <a target="_blank" href="<?= base_url('product/'.$product->url) ?>"><?= $product->nama_product ?></a> maka email ini akan otomatis terkirim apabila stok tersedia pada produk tersebut berubah jumlahnya.
                                    </p>
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                        Product yang bernama <a target="_blank" href="<?= base_url('product/'.$product->url) ?>"><?= $product->nama_product ?></a><br>
                                        <center><img src="<?= base_url($product->sampul_path) ?>" style="width: 150px; height: 150px;"></center>
                                        <br>saat ini tersisa <b><?= $product->stok ?></b> buah.
                                    </p>

                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #ffffff;" bgcolor="#ffffff;">
                        <!-- <img src="https://litmus-builder.s3.amazonaws.com/1526383931531" width="46" height="22" style="display: block; border: 0px;"/> -->
                    </td>
                </tr>
                <tr>
                    <td align="center" style=" padding: 35px; background-color: #ffffff; border-bottom: 20px solid #ffffff;" bgcolor="#ffffff">

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                            <tr>
                                <td align="center">
                                    <table>
                                        <tr>
<!--                                     <td style="padding: 0 10px;">
                                        <a href="http://litmus.com" target="_blank"><img src="https://litmus-builder.s3.amazonaws.com/1526383930700" width="35" height="29" style="display: block; border: 0px;" /></a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="http://litmus.com" target="_blank"><img src="https://litmus-builder.s3.amazonaws.com/1526383930845" width="35" height="29" style="display: block; border: 0px;" /></a>
                                    </td>
                                    <td style="padding: 0 10px;">
                                        <a href="http://litmus.com" target="_blank"><img src="https://litmus-builder.s3.amazonaws.com/1526383931086" width="35" height="29" style="display: block; border: 0px;" /></a>
                                    </td>
                                    <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 24px; padding: 0 10px;">
                                        <a href="http://litmus.com/blog" target="_blank" style="text-decoration: none; color: #ffffff;">BLOG</a>
                                    </td> -->
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center">
                            <!-- <img src="https://litmus-builder.s3.amazonaws.com/1526383621721" width="37" height="37" style="display: block; border: 0px;"/> -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                            <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
                                <!-- 675 Massachusetts Avenue<br>
                                    Cambridge, MA 02139 -->
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
                                    Anda dapat mematikan email otomatis ini dengan menekan tombol Matikan Stok Notifikasi pada <a target="_blank" href="<?= base_url('product/'.$product->url) ?>">halaman produk yang terkait</a>.
                                </p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

    </td>
</tr>
</table>

</body>
</html>
