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
Pesanan anda telah dikirim!
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
                <td align="center" style="padding: 35px; background-color: #f7f7f7;" bgcolor="#f7f7f7">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <img src="https://litmus-builder.s3.amazonaws.com/1526383622216" width="150" height="150" style="display: block; border: 0px;"/><br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                Produk pesanan anda telah dikirim!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 15px;">
                            <p style="font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;">
                                Hello <?= $user->username ?>,
                            </p>
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                Produk atau barang yang anda pesan telah dikirim oleh Seller, untuk melihat detail pesanan yang telah dikirim silahkan klik tombol dibawah.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 15px 0;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="border-radius: 5px;" bgcolor="#ed8e20">
                                        <a href="<?= base_url('order/details/'.$id_transaction) ?>" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ed8e20; padding: 15px 30px; border: 1px solid #ed8e20; display: block;">View Order</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px; background-color: #f7f7f7;" bgcolor="#f7f7f7">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">

                            <!-- <p style="font-size: 20px; font-weight: 800; line-height: 24px; color: #333333; margin: 0;">Estimated Delivery Date:</p> -->
                            <!-- <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">January 1, 2016 - 1:30PM EST</p> -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 15px 0;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="border-radius: 5px;" bgcolor="#ed8e20">
                                      <!-- <a href="http://litmus.com" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ed8e20; padding: 15px 30px; border: 1px solid #ed8e20; display: block;">Track Order</a> -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                  </table>

                </td>
            </tr>
            <tr>
                <td align="center" style=" padding: 35px; background-color: #f7f7f7;" bgcolor="#f7f7f7">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
                                <!-- While you're waiting, enjoy 20% off your next purchase. -->
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 25px 0 15px 0;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7">
                                      <!-- <a href="http://litmus.com" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #66b3b7; padding: 15px 30px; border: 1px solid #66b3b7; display: block;">Awesome</a> -->
                                    </td>
                                </tr>
                            </table>
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
