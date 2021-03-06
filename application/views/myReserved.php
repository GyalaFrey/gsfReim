<script>
	function resBlock(){
		var nREle = document.getElementById("numRes");
		var numRes = nREle.options[nREle.selectedIndex].value;
		
//		alert(numRes);
		$.ajax({
			url: "<?php echo base_url('home/claimBlock'); ?>",
			type: 'POST',
			data: {numRes: numRes},
			success: function(msg) {
				alert(msg);
				location.reload();
			}
		});
	}
	function releaseKill(killID){
		$.ajax({
			url: "<?php echo base_url('home/releaseKill'); ?>",
			type: 'POST',
			data: {killID: killID},
			success: function(msg) {
				alert(msg);
				location.reload();
			}
		});
	}
</script>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-2 col-md-offset-1">
			<h3>Reserve Losses</h3>
			<div class="input-group">
				<span class="input-group-addon">Number</span>
				<select id="numRes" class="form-control">
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="50">50</option>
				</select>
			</div>
			<br>
			<button type="button" class="btn btn-success" onclick="resBlock()" value="Reserve">Reserve</button>
		</div>
		<div class="col-md-8 col-md-offset-1">
			<h3>Your currently reserved losses</h3>
			<?php if($reserved->num_rows() > 0){ ?>
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>Victim</th>
							<th>Ship Type</th>
							<th>System</th>
							<th>Region</th>
							<th>Loss Time</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($reserved->result() as $row){ ?>
							<tr>
								<td><?php echo $row->victimName; ?></td>
								<td><?php echo $row->shipName; ?></td>
								<td><?php echo $row->sysName; ?></td>
								<td><?php echo $row->regName; ?></td>
								<td><?php echo $row->killTime; ?></td>
								<td><button type="button" class="btn btn-xs btn-danger" value="Release" onclick="releaseKill(<?php echo $row->killID; ?>)">Release</button></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } else { ?>
				<h3>You do not have any losses reserved yet.</h3>
			<?php }?>
		</div>
	</div>
</div>
