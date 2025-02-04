<!-- START TOTAL DES COMPTES -->
    <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphic']?></li>
                <li><?php echo 8*$data['StatGraphic']?></li>
                <li><?php echo 6*$data['StatGraphic']?></li>
                <li><?php echo 4*$data['StatGraphic']?></li>
                <li><?php echo 2*$data['StatGraphic']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Actifs</li><li>Suspendus</li><li>Ferm&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['ActiveMembers']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=active"><?php echo "{$data['ActiveMembers']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['SuspendedMembers'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=suspended"><?php echo "{$data['SuspendedMembers']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['ClosedMembers'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=closed"><?php echo "{$data['ClosedMembers']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL DES COMPTES (<?php echo $data['AllMembers'] ?>)</span></div>
        
        </div>
         <!-- END TOTAL DES COMPTES -->
         <br><br><BR><BR><BR>
         <!-- START TOUT LES TRASNACTION -->
    <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedTransactions']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=1&action=select"><?php echo "{$data['CompletedTransactions']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingTransactions'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=0&action=select"><?php echo "{$data['PendingTransactions']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledTransactions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=2&action=select"><?php echo "{$data['CancelledTransactions']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES TRANSACTION (<a href="transactions.php?action=select"><?php echo "{$data['AllTransactions']}"?></a>)</span></div>
        
        </div>
        <!-- END TOUT LES TRANSACTION -->
        <br><BR><BR><BR>
        <!-- START TOUT LES DEPOT -->
        <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedDeposits']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=1&action=select"><?php echo "{$data['CompletedDeposits']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingDeposits'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=0&action=select"><?php echo "{$data['PendingDeposits']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledTransactions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=2&action=select"><?php echo "{$data['CancelledDeposits']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES DEPOTS (<a href="transactions.php?type=1&action=select"><?php echo "{$data['AllDeposits']}"?></a>)</span></div>
        
        </div>
         <!-- END  TOUT LES DEPOT  -->
             <br><BR><BR><BR>
        <!-- START TOUT LES RETIRAIT -->
        <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;" >
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedWithdrawals']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=1&action=select"><?php echo "{$data['CompletedWithdrawals']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingWithdrawals'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=0&action=select"><?php echo "{$data['PendingWithdrawals']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledWithdrawals'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=2&action=select"><?php echo "{$data['CancelledWithdrawals']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES RETIRAIT (<a href="transactions.php?type=2&action=select"><?php echo "{$data['AllWithdrawals']}"?></a>)</span></div>
        
        </div>
         <!-- END  TOUT LES RETIRAIT  -->
             <br><BR><BR><BR>
        <!-- START TOUT LES COMMISSIONS -->
        <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedCommissions']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=1&action=select"><?php echo "{$data['CompletedCommissions']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingCommissions'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=0&action=select"><?php echo "{$data['PendingCommissions']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledCommissions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=2&action=select"><?php echo "{$data['CancelledCommissions']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES COMMISSIONS (<a href="transactions.php?type=5&action=select"><?php echo "{$data['AllCommissions']}"?></a>)</span></div>
        
        </div>
         <!-- END  TOUT LES COMMISSIONS  -->
                  <br><BR><BR><BR>
        <!-- START TOUT LES REMBOURSEMENT -->
        <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedRefunds']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=1&action=select"><?php echo "{$data['CompletedRefunds']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingRefunds'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=0&action=select"><?php echo "{$data['PendingRefunds']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledRefunds'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=2&action=select"><?php echo "{$data['CancelledRefunds']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES REMBOURS&Egrave;MENT (<a href="transactions.htm?type=6&action=select"><?php echo "{$data['AllRefunds']}"?></a>)</span></div>
        
        </div>
         <!-- END  TOUT LES REMBOURSEMENT  -->
                           <br><BR><BR><BR>
        <!-- START TOUT LES SINGUP BONUSES -->
        <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 350px;">
            <!-- y_axis labels -->
            <ul class="y_axis"> 
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li><li>0</li>
            </ul>
            <!-- x_axis labels -->
            <ul class="x_axis">
                <li>Termin&egrave;</li><li>En Attente</li><li>Annul&egrave;</li>
            </ul>
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 100 --></li>
                    <li><!-- 80 --></li>
                    <li><!-- 60 --></li>
                    <li><!-- 40 --></li>
                    <li><!-- 20 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100 -->
                <!-- ?px = 50 -->
                <ul>
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['CompletedSignups']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=4&status=1&action=select"><?php echo "{$data['CompletedSignups']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['PendingSignups'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=4&status=0&action=select"><?php echo "{$data['PendingSignups']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['CancelledSignups'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=4&status=2&action=select"><?php echo "{$data['CancelledSignups']}"?></a></span></li>
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>TOTAL LES SINGUP BONUSES (<a href="transactions.php?type=4&action=select"><?php echo "{$data['AllSignups']}"?></a>)</span></div>
        
        </div>
         <!-- END  TOUT LES SINGUP BONUSES -->