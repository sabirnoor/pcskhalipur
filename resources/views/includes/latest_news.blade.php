<h3>Latest News & Events </h3>
<?php $getLatesNews = getLatesNews(); ?>
  <div class="vticker demof">
		<ul>
		<?php if($getLatesNews){ foreach($getLatesNews as $k=>$val){ ?>
			<li <?php if($k!=0){echo 'class="odd"';} ?>><a href="#"><?=strtoupper($val['eventtitle'])?></a>
				<strong><?=date('d-M-Y',strtotime($val['eventdate']))?></strong>
				<?=$val['eventdetails']?>
			</li>
		<?php } } ?>

			<!--<li class="odd"><a href="#">
			GYANDEEP PUBLIC SCHOOL</a><p>Vidyapati Nagar, Samastipur.<br>
			Issue of Information Broucher &amp; Application Form From <strong>27th January</strong>.Last Date
			of Form Submission on <strong>10th February</strong>. Entrance Test <strong>11th February</strong>, Venue SCHOOL
			CAMPUS. Result <strong>14th February</strong>. Admission from <strong>16th February</strong>. Distribution of
			Books from <strong>1st March</strong>. Classes will begin from <strong>16th March</strong>.</p>
			</li>

			<li class="odd"><a href="#">
			GYANDEEP PUBLIC SCHOOL</a><p>Vidyapati Nagar, Samastipur.<br>
			Issue of Information Broucher &amp; Application Form From <strong>27th January</strong>.Last Date
			of Form Submission on <strong>10th February</strong>. Entrance Test <strong>11th February</strong>, Venue SCHOOL
			CAMPUS. Result <strong>14th February</strong>. Admission from <strong>16th February</strong>. Distribution of
			Books from <strong>1st March</strong>. Classes will begin from <strong>16th March</strong>.</p>
			</li>

			<li class="odd"><a href="#">
			GYANDEEP PUBLIC SCHOOL</a><p>Vidyapati Nagar, Samastipur.<br>
			Issue of Information Broucher &amp; Application Form From <strong>27th January</strong>.Last Date
			of Form Submission on <strong>10th February</strong>. Entrance Test <strong>11th February</strong>, Venue SCHOOL
			CAMPUS. Result <strong>14th February</strong>. Admission from <strong>16th February</strong>. Distribution of
			Books from <strong>1st March</strong>. Classes will begin from <strong>16th March</strong>.</p>
			</li>

			<li class="odd"><a href="#">GYANDEEP PUBLIC SCHOOL</a><p>Vidyapati Nagar, Samastipur.<br>
			Issue of Information Broucher &amp; Application Form From <strong>27th January</strong>.Last Date
			of Form Submission on <strong>10th February</strong>. Entrance Test <strong>11th February</strong>, Venue SCHOOL
			CAMPUS. Result <strong>14th February</strong>. Admission from <strong>16th February</strong>. Distribution of
			Books from <strong>1st March</strong>. Classes will begin from <strong>16th March</strong>.</p>
			</li>-->

		</ul>
	</div>