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
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus dolor aliquid omnis consequatur est deserunt, odio neque blanditiis aspernatur, mollitia ipsa distinctio, culpa fuga obcaecati!
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
						<td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">

							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<tr>
									<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
										<img src="https://litmus-builder.s3.amazonaws.com/1526381094067" width="125" height="120" style="display: block; border: 0px;" /><br>
										<h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
											Thank You For Your Order! 
											<br>Order Date: <b> <?= $trans_history->date ?>
											</h2>
										</td>
									</tr>
									<tr>
										<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
											<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
												<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam. -->
											</p>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-top: 20px;">
											<table cellspacing="0" cellpadding="0" border="0" width="100%">
												<tr>
													<td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
														Order Confirmation #
													</td>
													<td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
														<a href="<?= base_url('order/details/'.$trans_history->id_transaction) ?>" target="_blank"><?= $trans_history->id_transaction ?></a>
													</td>
												</tr>

												<?php $cart = unserialize($trans_history->cart); ?>

												<?php foreach($cart as $items): ?>
													<tr>
														<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
															<a href="<?= base_url('product/'.$items['name']) ?>" target="_blank"><?= $items['name'] ?></a>
														</td>
														<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
															Rp. <?= number_format($items['price'], 0, ',', '.') ?>
														</td>
													</tr>
												<?php endforeach; ?>
												<tr>
													<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
														Shipping
													</td>
													<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
														Rp. <?= number_format($trans_history->totalongkir, 0, ',', '.') ?>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-top: 20px;">
											<table cellspacing="0" cellpadding="0" border="0" width="100%">
												<tr>
													<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
														TOTAL
													</td>
													<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
														<?php 
														$total = $trans_history->totalprice + $trans_history->totalongkir + $trans_history->kode_unik;
														$kode_unik = $trans_history->kode_unik;
														$withoutkodeunik = substr($total, 0, -3);
														?>
														Rp. <?= number_format($withoutkodeunik, 0, ',', '.') ?>.<font color="red"><?= $kode_unik ?></font>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-top: 20px;">
											<span width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 800; line-height: 24px; padding: 10px;">
												*angka yang berwarna merah adalah kode unik pembayaran
											</span>
										</td>
									</tr>
								</table>

							</td>
						</tr>
						<tr>
							<td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">

								<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
									<tr>
										<td align="center" valign="top" style="font-size:0;">

											<div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

												<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
													<tr>
														<td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
															<p style="font-weight: 800;">Delivery Address</p>
															<p><?= $shipment->alamat ?>, <?= $shipment->kodepos ?><br><?= $shipment->telephone ?></p>

														</td>
													</tr>
												</table>
											</div>
											<div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
												<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
													<tr>
														<td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <!-- <p style="font-weight: 800;">Estimated Delivery Date</p>
                                            	<p>January 1st, 2016</p> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

           <tr>
            	<td align="center" style=" padding: 35px; background-color: #42a5f5;" bgcolor="#42a5f5">

            		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            			<tr>
            				<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
            					<h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
            						Konfirmasi Transfer Pembayaran
            					</h2>
            				</td>
            			</tr>
            			<tr>
            				<td align="center" style="padding: 25px 0 15px 0;">
            					<table border="0" cellspacing="0" cellpadding="0">
            						<tr>
            							<td align="center" style="border-radius: 5px;" bgcolor="#3582c0">
            								<a href="<?= base_url('account/profile#riwayat') ?>" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #3582c0; padding: 15px 30px; border: 1px solid #66b3b7; display: block;">Konfirmasi</a>
            							</td>
            						</tr>
            					</table>
            				</td>
            			</tr>
            		</table>

            	</td>
            </tr>

<!--               <tr>
            	<td align="center" style=" padding: 35px; background-color: #1b9ba3;" bgcolor="#1b9ba3">

            		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            			<tr>
            				<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
            					<h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;">
            						Get 25% off your next order.
            					</h2>
            				</td>
            			</tr>
            			<tr>
            				<td align="center" style="padding: 25px 0 15px 0;">
            					<table border="0" cellspacing="0" cellpadding="0">
            						<tr>
            							<td align="center" style="border-radius: 5px;" bgcolor="#66b3b7">
            								<a href="http://litmus.com" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #66b3b7; padding: 15px 30px; border: 1px solid #66b3b7; display: block;">Awesome</a>
            							</td>
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
            					<img src="https://preview.ibb.co/fuur8y/favicon.png" width="37" height="37" style="display: block; border: 0px;"/>
            				</td>
            			</tr>
            			<tr>
            				<td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
            					<p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
            						675 Massachusetts Avenue<br>
            						Cambridge, MA 02139
            					</p>
            				</td>
            			</tr>
            			<tr>
            				<td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
            					<p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
            						 If you didn't create an account using this email address, please ignore this email or <a href="http://litmus.com" target="_blank" style="color: #777777;">unsusbscribe</a>.
            					</p>
            				</td>
            			</tr>
            		</table>

            	</td>
            </tr> -->
        </table>

    </td>
</tr>
</table>

</body>
</html>