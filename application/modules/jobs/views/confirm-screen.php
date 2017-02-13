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
						<?php if($confirm=="yes") { ?>
							<span style="color: green;">
							Your Job Confirmation Saved Successfully.
							</span>
						<?php } elseif ($confirm=="no") { ?>
							<span style="color: red;">
							You can no longer attend this Job Saved Successfully.
							</span>
						<?php } ?>
						</b>
						</li>
						<br>
						<li style="text-align:center;">
							<span style="color: black;">
							This page will automatically redirect in 10 seconds. If it doesn’t, please <a href="<?=base_url()?>">click here</a> to go to your dashboard.
							</span>
						 </li>
						<!-- <li> <input type="submit" value="login" class="btn-nxt"> </li> -->
					</ul>
			</div>
		</div>

