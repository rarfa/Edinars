<script type="text/javascript">
  v_menu_id = "notifications"
</script>


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Espace client</a></li>
    <li class="active">Notifications</li>
</ul>
<!-- END BREADCRUMB -->
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading ui-draggable-handle">
        <h3 class="panel-title">Notifications</h3>
        <ul class="panel-controls">
            <li><a href="#"><span class="fa fa-plus"></span> </a></li>
        </ul>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>De</th>
              <th>Type</th>
              <th>Message</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_notifications">
            <tr>
              <td>{De}</td>
              <td>{Type}</td>
              <td>{Message}</td>
              <td>{Date}</td>
              <td>{Action}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> <!-- ROW -->

<script>
  //init table


  get_notifications_list();

  function get_notifications_list(){
    $('#tbody_notifications').html("");

  	console.log("get_notifications_list() ");
    var str="";
    str += append_access_token();

  	$.ajax({
  	  url: api_url + "get_notifications_list.php",
  	  cache: false,
  	  data: str,
  		type:"post",
  		dataType: 'json',
  		error: function (xhr, ajaxOptions, thrownError) {
  			console.error("xhr.status = "+xhr.status);
  			console.error("thrownError = "+thrownError);
  		},
  	  success: function(reponse){
  			process_get_notifications_list(reponse);
  	  }
  	});
  }

  function process_get_notifications_list(reponse){
  	console.log("process_get_notifications_list() "+reponse.success);
  	// fill_notifications_table("#tbody_notifications", reponse, false);
    var raw_html="";
  	for (var key in reponse.notifications){
      var tr_bg = ' ';
      if(reponse.notifications[key].view=="no") tr_bg = 'style="background:rgba(115, 190, 40, 0.50) !important;"';
  		raw_html = '';
  		raw_html += '<tr>';
  		raw_html += '<td '+tr_bg+'>'+reponse.notifications[key].sender+'</td>';
  		raw_html += '<td '+tr_bg+'>'+reponse.notifications[key].type+'</td>';
  		raw_html += '<td '+tr_bg+'>'+reponse.notifications[key].message+'</td>';
  		raw_html += '<td '+tr_bg+'>'+reponse.notifications[key].created_at+'</td>';
  		raw_html += '<td '+tr_bg+'>';
      if(reponse.notifications[key].type=="transaction"){
        raw_html += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_transaction(\''+reponse.notifications[key].transaction_id+'\');setTimeout(function(){get_notifications_list(), get_user_notifications()}, 1000)"><span class="fa fa-info-circle"></span></button> ';
      }else if(reponse.notifications[key].type=="message"){
        raw_html += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_notification(\''+reponse.notifications[key].id+'\');setTimeout(function(){get_notifications_list(), get_user_notifications()}, 1000)"><span class="fa fa-info-circle"></span></button> ';
      }
      raw_html += '</td>';
  		raw_html += '</tr>';
  		$('#tbody_notifications').append(raw_html);
  	}
  }
</script>
