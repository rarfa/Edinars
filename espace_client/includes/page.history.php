<script type="text/javascript">
  v_menu_id = "history"
</script>


<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Espace client</a></li>
    <li class="active">Historique</li>
</ul>
<!-- END BREADCRUMB -->
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading ui-draggable-handle">
        <h3 class="panel-title">Historique des transactions</h3>
        <ul class="panel-controls">
            <li><a href="#"><span class="fa fa-plus"></span> </a></li>
        </ul>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Dir</th>
              <th>Membre</th>
              <th>Montant</th>
              <th>Frais</th>
              <th>Payè</th>
              <th>Date</th>
              <th>Type</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbody_history">
            <tr>
              <td><span class="fa fa-arrow-left"></span></td>
              <td>{Membre}</td>
              <td>{Montant}</td>
              <td>{Frais}</td>
              <td>{Payè}</td>
              <td>{Date}</td>
              <td>{type}</td>
              <td>{Statut}</td>
              <td>{Action}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-12" id="btn_show_more_history" style="text-align:center">
    <button class="btn btn-primary" onclick="show_more_history();"><span class="fa fa-plus"></span> Afficher plus</button>
  </div>
</div> <!-- ROW -->

<script>
  //init table
  $('#tbody_history').html("");

  get_history();

  var page_history = 0;

  function show_more_history(){
  	page_history ++;
  	get_history();
  }

  function get_history(){
  	console.log("get_history() ");

  	var str = "page="+page_history;
    str += append_access_token();

  	$.ajax({
  	  url: api_url + "history.php",
  	  cache: false,
  	  data: str,
  		type:"post",
  		dataType: 'json',
  		error: function (xhr, ajaxOptions, thrownError) {
  			console.error("xhr.status = "+xhr.status);
  			console.error("thrownError = "+thrownError);
  		},
  	  success: function(html){
  			process_get_history(html);
  	  }
  	});
  }

  function process_get_history(reponse){
  	console.log("process_get_history() "+reponse.success);

  	if(reponse.end_of_list == "yes"){
  		$('#btn_show_more_history').hide();
  	}else{
  		fill_history_table("#tbody_history", reponse, false);
  	}
  }
</script>
