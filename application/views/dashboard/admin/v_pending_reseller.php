<!-- Main content -->
<div class="content-wrapper">
		<!-- Basic datatable -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Data user yang pending untuk menjadi Reseller</h5>
			</div>


			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Username</th>
						<th>Nama Lengkap</th>
						<th>Email</th>
						<th>Tanggal Request Approval</th>
						<th>Status Approval</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_resellerpending as $row) { ?>

					<tr>
						<td><?= $row->username ?></td>
						<td><?= $row->first_name ?> <?= $row->last_name ?></td>
						<td><?= $row->email ?></td>
						<td><?= $row->date2 ?></td>

						<?php if($row->status == "Pending"): ?>
							<td><span class="label label-info"><?= $row->status ?></span></td>	
						<?php else: ?>
							<td><span class="label label-success"><?= $row->status ?></span></td>
						<?php endif; ?>

						<td class="text-center">
							<?php if($row->status == "Pending"): ?>
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="<?= base_url('Admins/accupgrade/'.$row->id_user.'/reseller') ?>"><i class="icon-checkmark3"></i> Approve</a></li>
											<li><a href="#"><i class="icon-cross2"></i> Decline</a></li>
										</ul>
									</li>
								</ul>
							<?php else: ?>
								-
							<?php endif; ?>
						</td>
					</tr>

					<?php } ?>

				</tbody>
			</table>
		</div>
		<!-- /basic datatable -->

</div>
<!-- /main content -->