<?php if (isset($treeview)) { ?>
<script src="<?=base_url()?>resource/js/jquery-checktree.js"></script>
<script type=text/javascript>
    $('#tree').checktree();
</script>
<?php } ?>


<?php if (isset($slider)) { ?>
<script type="text/javascript">
$('.carousel').carousel({
    interval: false,
    wrap:false
});
$('.slide-prev').click(function() {
  $('#carousel-example-generic').carousel('prev');
});

$('.slide-next').click(function() {
  $('#carousel-example-generic').carousel('next');
});
</script>
<?php } ?>

<?php if (isset($editor)) { ?>
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css" rel="stylesheet"  type="text/css">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js"></script>
<script type="text/javascript">
$('.foeditor').summernote({
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  });
$('.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table').remove();
</script>
<?php } ?>

<?php if (isset($datepicker)) { ?>
<script src="<?=base_url()?>resource/js/datepicker/bootstrap-datepicker.js" cache="false"></script>
<script type="text/javascript">
  $(".datepicker-input").each(function() {
      $(this).datepicker({format: 'mm/dd/yyyy'});
  });
</script>
<?php } ?>

<?php if (isset($timepicker)) { ?>
<link rel="stylesheet" href="<?=base_url()?>resource/js/timepicker/jquery.timepicker.css" type="text/css" cache="false" />
<script src="<?=base_url()?>resource/js/timepicker/jquery.timepicker.js" cache="false"></script>
<script src="<?=base_url()?>resource/js/timepicker/datepair.js" cache="false"></script>
<script type="text/javascript">
        ////////////// For Job & Event Add ///////////////////////////////
        $('#timepick .time').timepicker({
            'showDuration': true,
            'timeFormat': 'h:i A'
        });
        var basicExampleEl = document.getElementById('timepick');
        var datepair = new Datepair(basicExampleEl);

        ///////////////// Morning Block Time For Staff ///////////////////
        $('.mtime').timepicker({
            'minTime': '12:00am',
            'maxTime': '12:00pm',
            'timeFormat': 'h:i A'
        });

        ///////////////// Evening Block Time For Staff ///////////////////
        $('.etime').timepicker({
            'minTime': '12:00pm',
            'maxTime': '11:30pm',
            'timeFormat': 'h:i A'
        });
      <?php if(isset($staffSchedule)) { $staffSchedule=(array)$staffSchedule[0];
            $blocktime=$staffSchedule['blocktime']; ?>
            ///////////////// All Time For Staff ///////////////////
            $('.alltime').timepicker({
                'timeFormat': 'h:i A'
                <?php if($blocktime!='') { ?>,'disableTimeRanges': <?php echo $blocktime; } ?>
            });
      <?php } ?>
</script>
<?php } ?>

<?php if (isset($validator)) { ?>
<link href="<?=base_url()?>resource/js/validator/bootstrapValidator.css" rel="stylesheet">
<script src="<?=base_url()?>resource/js/validator/bootstrapValidator.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#defaultForm').bootstrapValidator();
    });
</script>
<?php } ?>

<?php if (isset($liveclock)) { ?>
<script type="text/javascript">
function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var year = nyear.toString().substr(2,2);

if(nyear<1000) nyear+=1900;
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" am";nhour=12;}
else if(nhour<12){ap=" am";}
else if(nhour==12){ap=" pm";}
else if(nhour>12){ap=" pm";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

document.getElementById('clockbox').innerHTML=""+(nmonth+1)+"/"+ndate+"/"+year+" : "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>
<?php } ?>

<?php
if($this->session->flashdata('message')){ 
$message = $this->session->flashdata('message');
$alert = $this->session->flashdata('response_status');
	?>
    <script type="text/javascript">
    	$(document).ready(function(){
        toastr.<?=$alert?>("<?=$message?>", "Response Status: <?=ucfirst($alert)?>");
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "progressBar": true,
          "positionClass": "toast-bottom-right",
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
      });
    </script>
<?php } ?>