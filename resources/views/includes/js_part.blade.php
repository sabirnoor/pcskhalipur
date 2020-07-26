<script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/js/shine.js')}}"></script>
<script src="{{asset('public/assets/js/lightgallery.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap-dropdownhover.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/js/jquery.easy-ticker.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.9/datepicker.min.js"></script>
<script type="text/javascript">

	$(document).ready(function () {

		$('#lightgallery').lightGallery();

	});

</script>

<script type="text/javascript">

$(document).ready(function(){

$('.numbers').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
	var dd = $('.vticker').easyTicker({

		direction: 'up',

		easing: 'easeInOutBack',

		speed: 'slow',

		interval: 2000,

		height: 'auto',

		visible: 3,

		mousePause: 0,

		controls: {

			up: '.up',

			down: '.down',

			toggle: '.toggle',

			stopText: 'Stop !!!'

		}

	}).data('easyTicker');

	

	cc = 1;

	$('.aa').click(function(){

		$('.vticker ul').append('<li>' + cc + ' Triangles can be made easily using CSS also without any images. This trick requires only div tags and some</li>');

		cc++;

	});

	

	$('.vis').click(function(){

		dd.options['visible'] = 3;

		

	});

	

	$('.visall').click(function(){

		dd.stop();

		dd.options['visible'] = 0 ;

		dd.start();

	});

	

});

</script>   
