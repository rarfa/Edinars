<script type="text/javascript">
  v_menu_id = "mon_compte"
</script>


    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Espace client</a></li>
        <li class="active">Mon compte</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <!-- START WIDGETS -->
        <div class="row">

            <div class="col-md-6">

                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon"  >
                    <div class="widget-item-left">
                        <span class="fa fa-money"></span>
                    </div>
                    <div class="widget-data">
                      <div class="widget-title" style="padding-top:20px">Solde</div>
                        <div class="widget-int num-count user_data_solde">0 DA</div>

                    </div>

                </div>
                <!-- END WIDGET MESSAGES -->

            </div>
            <div class="col-md-6">

                <!-- START WIDGET REGISTRED -->
                <div class="widget widget-default widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-suitcase"></span>
                    </div>
                    <div class="widget-data">
                      <div class="widget-title" style="padding-top:20px">Solde disponible</div>
                        <div class="widget-int num-count user_data_solde_disponible">0 DA</div>
                    </div>
                </div>
                <!-- END WIDGET REGISTRED -->
            </div>

        </div>
        <!-- END WIDGETS -->

        <div class="row">
          <div class="col-md-6">
            <!-- LIST GROUP WITH BADGES -->
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Informations générales</h3>
                    <ul class="panel-controls">
                        <li><a href="./#my_profile/"><span class="fa fa-edit"></span> </a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <ul class="list-group border-bottom">
                        <li class="list-group-item">N° de compte<span class="badge"><span class="user_data_mem_id">{mem_id}</span></span></li>
                        <li class="list-group-item">Nom et prénom<span class="badge"><span class="user_data_firstname">{firstname}</span> <span class="user_data_lastname">{lastname}</span></span></li>
                        <li class="list-group-item">Email<span class="badge user_data_email">{email}</span></li>
                        <li class="list-group-item">Type de compte<span class="badge user_data_type_account">{type_account}</span></li>
                        <li class="list-group-item">Derniére connexion<span class="badge user_data_derniere_connexion">{derniere_connexion}</span></li>
                        <li class="list-group-item">Status <span class="badge user_data_status ">{status}</span></li>
                    </ul>
                </div>

            </div>
            <!-- END LIST GROUP WITH BADGES -->
          </div>
          <div class="col-md-6 panel_entreprise">
            <!-- LIST GROUP WITH BADGES -->
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Votre entreprise</h3>
                    <ul class="panel-controls">
                        <li><a href="#"><span class="fa fa-edit"></span> </a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <ul class="list-group border-bottom">
                        <li class="list-group-item">Logo<span class="badge user_data_">Aucun logo</span></li>
                        <li class="list-group-item">Numero RC<span class="badge user_data_nrc">{nrc}</span></li>
                        <li class="list-group-item">Numero IF<span class="badge user_data_nnif">{nnif}</span></li>
                        <li class="list-group-item">Numero d'article <span class="badge user_data_nart">{nart}</span></li>
                        <li class="list-group-item">Numero FIS<span class="badge user_data_nnif">{nfis}</span></li>
                    </ul>
                </div>

            </div>
            <!-- END LIST GROUP WITH BADGES -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title">5 Rècentes Transactions</h3>
                <ul class="panel-controls">
                    <li><a href="./#history/"><span class="fa fa-plus"></span> </a></li>
                </ul>
              </div>
              <div class="panel-body">
                <p>Liste des 5 Rècentes transactions, pour voir plus de transactions cliquer sur <code>Plus</code> a coté de titre</p>
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
                  <tbody id="tbody_last_transactions">
                    <tr>
                      <td><span class="fa fa-arrow-left"></span></td>
                      <td>{Membre}</td>
                      <td>{Montant}</td>
                      <td>{Frais}</td>
                      <td>{Payè}</td>
                      <td>{Date}</td>
                      <td>{Type}</td>
                      <td>{Statut}</td>
                      <td>{Action}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title">Paiements en instance</h3>
                <ul class="panel-controls">
                    <li><a href="#"><span class="fa fa-plus"></span> </a></li>
                </ul>
              </div>
              <div class="panel-body">
                <p>Liste des paiements en instance, pour voir plus de cliquer sur <code>Plus</code> a coté de titre</p>
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
                  <tbody id="tbody_pending_payments">
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
        </div>

      </div>

      <script>

      </script>
