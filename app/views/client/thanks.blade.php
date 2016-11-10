<section id="getappContainer" class="section-80-130 whiteBgSection">
<div class="row">
			<!--contact info-->
    <div class="twelve-col">
    <h1 class="sectionTitle"><?php echo trans('frontend.back_to_home');?></h1>
    <div class="titleSeparator"></div>
    <h3 class="sectionDescription"><?php echo trans('frontend.thank_you_condent1');?>
    </h3>
    <div class="separator80"></div>
    <p style="text-align:center">
    <?php echo trans('frontend.thank_you_condent2');?><br><br>
    <a style="vertical-align:middle" href="#" class="dlButtondark" onclick="return dashbord();"><span class="dlButtonWrap"><span class="dlButtonSmall"> <?php echo trans('frontend.go_to_panel');?></span></span></a>	
    </p>
    </div>
    <div class="clear"></div>
    </div>
<img class="triangleBottom" src="{{ asset('minisite/img/tri-white-bot.png') }}" alt="" />
</section>

<script type="text/javascript">
function dashbord(){
	window.location.href ="{{ URL::to('users/dashboard') }}	";
}
</script>