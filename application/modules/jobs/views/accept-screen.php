		<div class="container">
			<div class="wa2">
				<div class="wa1-top-space">  </div>
				<div class="wa2-pic-welcome">
					<div class="wa2logo"> <img src="<?=base_url()?>resource/images/wa2logo.png" alt="logoss"> </div>
					<h2>Job Response</h2>
				</div>
					<ul class="wa2-form">
						<li style="text-align:center; font-size:16px;">
						<b>
						<?php if($confirm=="Booked") { ?>
							<span style="color: green;">
							Your Job Accepted Successfully.
							</span>
						<?php } elseif ($confirm=="Canceled") { ?>
							<span style="color: red;">
							Your Job Canceled Successfully.
							</span>
						<?php } elseif ($confirm=="Job Missed") { ?>
							<span style="color: red;">
							Your Already Missed this Job.
							</span>
						<?php } ?>
						</b>
						</li>
						<br>
						<li style="text-align:center;">
							<span style="color: black;">
							You want to go your panel please <a href="<?=base_url()?>">click here</a> or we are automatically redirect to your panel in 10 seconds.
							</span>
						 </li>
						<!-- <li> <input type="submit" value="login" class="btn-nxt"> </li> -->
					</ul>
			</div>
		</div>

