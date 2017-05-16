<?php include('getEvent.php');?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src='js/moment.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src='js/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js'></script>

<link href="css/jquery.datetimepicker.min.css" rel="stylesheet"> 
<script src="js/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
		 $('#estart').datetimepicker();
		  $('#eend').datetimepicker();
		  
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			 eventClick:  function(event, jsEvent, view) {
            $('#modalTitle').html("Title: " + event.title);
			   var e_start   = moment(event.start).format('YYYY-MM-DD , h:mm:ss a');
				var e_end   = moment(event.end).format('YYYY-MM-DD , h:mm:ss a');
			 $('#sched').html("<b>Start:</b><br> "+ e_start +' <br> <b>End: </b> <br>' + e_end);
			 
            $('#desc').html(event.description);
            $('#calendarModal').modal();
        },
		
			defaultDate: '<?php echo date("Y-m-d");?>',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($events,true); ?>
		});
		 $("form.myform").validate({

      rules: {

        'title': {

          required: true,

        },

        'e_start': {

          required: true,

        },

        'e_end': {

          required: true,

        },
		 'desc': {

          required: true,

        }

      }

    });



    $(document).on("click", "#btn-submit", function(){

      if ($("form.myform").valid()) {
              $("#btn-submit").html('<i class="fa fa-spinner fa-spin fa-fw"></i> Sending...');

              $.ajax({
                type : 'POST',
                data: $("#myform").serialize(),
                url : 'addEvent.php',
                success : function(data){
                   // $("#loader").hide();
                    $("#btn-submit").html('Send');
                    $("#title").val('');
                    $("#e_start").val('');
                    $("#e_end").val('');
                    $("#desc").val('');
					window.location.reload();
					
               
                }
          });
     


        console.log($("#myform").serialize());

      }

    });
		
		
		
	});
</script>

</head>
<body>
<div class="container">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Add Event</div>
			</div>
			<div class="panel-body">
				<form  name="myform" id="myform" class="myform">
					<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" class="form-control" required>
					</div>
					
					<div class="form-group" >
					<label>Start Date</label>
					<input type="text"  id="estart" name="e_start" class="form-control" required>
					
					</div>
					
					<div class="form-group">
					<label>End Date</label>
					<input type="text" id="eend" name="e_end" class="form-control" required>
					</div>
					
					<div class="form-group">
					<label>Description</label>
					<textarea name="desc" class="form-control" required></textarea>
					</div>
					
					<div class="form-group">
					<button type="button" id="btn-submit" name="submit" class="btn-block btn-success btn">Save</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-8" id="reloadpage">
	<div id='calendar'></div>
	</div>
</div><div class="container">
	<div class="col-lg-12 text-center"><p>jaimeframosjr2017</p></div>
<div>

	

	
<div id="calendarModal" class="modal fade">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            <h4 id="modalTitle" class="modal-title"></h4>
        </div>
        <div id="modalBody" class="modal-body">
			
			<h5><p id="sched"></p></h5>
			<h5><b>Description:</b> <p id="desc"></p></h5>
		</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 1000px;
		margin: 0 auto;
	}

</style>
</body>
</html>
