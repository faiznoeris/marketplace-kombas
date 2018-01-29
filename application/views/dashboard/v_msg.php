<!-- Basic modal -->
<div id="modal_req_seller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradeseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Basic modal -->
<div id="modal_req_reseller_<?= $session["id_user"] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Request Approval Menjadi Re-Seller</h5>
			</div>

			<div class="modal-body">
				<!-- <h6 class="text-semibold">Text in a modal</h6> -->
				<p>Request untuk menjadi re-seller? <br><b>Anda tidak bisa meng-undo setelah melakukan requet untuk menjadi re-seller!</b></p>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<a href="<?= base_url('Account/upgradereseller/'.$session["id_user"]) ?>" class="btn btn-primary">Confirm</a>

			</div>
		</div>
	</div>
</div>
<!-- /basic modal -->
<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<div class="row">
			<div class="col-lg-9">

				<div class="panel panel-flat timeline-content">
					<div class="panel-heading">
						<?php 
						$username = $this->m_users->select($this->uri->segment(3))->row()->username;
						?>
						<h6 class="panel-title">Conversation with <i><?= $username ?></i></h6>

					</div>

					<div class="panel-body">
						<ul class="media-list chat-list content-group">


							<?php foreach($data_msg as $row): ?>

								<?php if($row->id_sender == $session["id_user"]): ?>

									<li class="media reversed">
										<div class="media-body">
											<div class="media-content"><?= $row->msg ?></div>
											<span class="media-annotation display-block mt-10"><?= $row->date ?><a href="#"></i></a></span>
										</div>

										<div class="media-right">
											<a href="assets/images/placeholder.jpg">
												<img src="assets/images/placeholder.jpg" class="img-circle img-md" alt="">
											</a>
										</div>
									</li>

								<?php else: ?>

									<li class="media">
										<div class="media-left">
											<a href="assets/images/placeholder.jpg">
												<img src="assets/images/placeholder.jpg" class="img-circle img-md" alt="">
											</a>
										</div>

										<div class="media-body">
											<div class="media-content"><?= $row->msg ?></div>
											<span class="media-annotation display-block mt-10"><?= $row->date ?><a href="#"></a></span>
										</div>
									</li>

								<?php endif; ?>

							<?php endforeach; ?>





						</ul>
						<form method="post" action="<?php echo base_url('Message/send/'.$this->uri->segment(3));?>">
							<textarea name="message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

							<div class="row">
								<div class="col-xs-6"></div>

								<div class="col-xs-6 text-right">
									<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /messages -->

			<!-- Connections -->
			<div class="col-lg-3">	
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Latest connections</h6>
						<div class="heading-elements">
							<!-- <span class="badge badge-success heading-text">+32</span> -->
						</div>
					</div>

					<ul class="media-list media-list-linked pb-5">

						<?php foreach($data_connection as $row): ?>

							<?php if($row->id_receiver != $session["id_user"]): ?>

								<?php 
								$connection_detail = $this->m_users->select($row->id_receiver)->row();
								?>

								<li class="media">
									<a href="<?= base_url('dashboard/messages/'.$row->id_receiver) ?>" class="media-link">
										<div class="media-left"><img src="<?= base_url($connection_detail->ava_path) ?>" class="img-circle img-md" alt=""></div>
										<div class="media-body" style="padding-top: 8px;">
											<span class="media-heading text-semibold"><?= $connection_detail->username ?></span>
											<!-- <span class="media-annotation">UI/UX expert</span> -->
										</div>
									</a>
								</li>

							<?php endif; ?>

						<?php endforeach; ?>

					</ul>
				</div>
			</div>
		</div>
		<!-- /connections -->

		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content