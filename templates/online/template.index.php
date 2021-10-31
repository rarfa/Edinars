<?if(isset($data['ScriptLoaded'])){?>
<div class="content">
  <a href="index.php">REFRESH</a>
 <BR> <BR> 
   <!-- END TOTAL DES COMPTES -->
  <!-- css bar graph -->
        <div class="css_bar_graph" style="width: 820px;">
            
            <!-- y_axis labels -->
            <ul class="y_axis">
                <li><?php echo 10*$data['StatGraphicTransaction']?></li>
                <li><?php echo 9*$data['StatGraphicTransaction']?></li>
                <li><?php echo 8*$data['StatGraphicTransaction']?></li>
                <li><?php echo 7*$data['StatGraphicTransaction']?></li>
                <li><?php echo 6*$data['StatGraphicTransaction']?></li>
                <li><?php echo 5*$data['StatGraphicTransaction']?></li>
                <li><?php echo 4*$data['StatGraphicTransaction']?></li>
                <li><?php echo 3*$data['StatGraphicTransaction']?></li>
                <li><?php echo 2*$data['StatGraphicTransaction']?></li>
                <li><?php echo 1*$data['StatGraphicTransaction']?></li>
                <li>0</li>
            
            </ul>
            
            <!-- x_axis labels -->
            <ul class="x_axis">
                    <li>LES COMPTES (<?php echo $data['AllMembers'] ?>)</li>
                    <li>TRANSACTION (<a href="transactions.php?action=select"><?php echo "{$data['AllTransactions']}"?></a>)</li>
                    <li>DEPOTS (<a href="transactions.php?type=1&action=select"><?php echo "{$data['AllDeposits']}"?></a>)</li>
                    <li>RETIRAIT (<a href="transactions.php?type=2&action=select"><?php echo "{$data['AllWithdrawals']}"?></a>)</li>
                    <li>COMMISSIONS (<a href="transactions.php?type=5&action=select"><?php echo "{$data['AllCommissions']}"?></a>)</li>
                    <li>REMBOURS&Egrave;MENT (<a href="transactions.htm?type=6&action=select"><?php echo "{$data['AllRefunds']}"?></a>)</li>
            </ul>
            
            <!-- graph -->
            <div class="graph">
                <!-- grid -->
                <ul class="grid">
                    <li><!-- 10 --></li>
                    <li><!-- 9 --></li>
                    <li><!-- 8 --></li>
                    <li><!-- 7 --></li>
                    <li><!-- 6 --></li>
                    <li><!-- 5 --></li>
                    <li><!-- 4 --></li>
                    <li><!-- 3 --></li>
                    <li><!-- 2 --></li>
                    <li><!-- 1 --></li>
                    <li class="bottom"><!-- 0 --></li>
                </ul>
                
                <!-- bars -->
                <!-- 250px = 100% -->
                <ul>
                    <!-- START TOTAL DES COMPTES -->
                    <li class="bar nr_1 green" style="height: <?php echo ( ($data['ActiveMembers']* 250) / 100)  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=active"><?php echo "{$data['ActiveMembers']}"?></a></span></li>
                    <li class="bar nr_2 orange" style="height: <?php echo ( ($data['SuspendedMembers'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=suspended"><?php echo "{$data['SuspendedMembers']}"?></a></span></li>
                    <li class="bar nr_3 red" style="height: <?php echo ( ($data['ClosedMembers'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="members.php?action=select&type=closed"><?php echo "{$data['ClosedMembers']}"?></a></span></li>
        
                    <!-- START TOUT LES TRASNACTION -->
                    <li class="bar nr_4 green" style="height: <?php echo ( ($data['CompletedTransactions']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=1&action=select"><?php echo "{$data['CompletedTransactions']}"?></a></span></li>
                    <li class="bar nr_5 orange" style="height: <?php echo ( ($data['PendingTransactions'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=0&action=select"><?php echo "{$data['PendingTransactions']}"?></a></span></li>
                    <li class="bar nr_6 red" style="height: <?php echo ( ($data['CancelledTransactions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=-1&status=2&action=select"><?php echo "{$data['CancelledTransactions']}"?></a></span></li>
                    
                    <!-- START TOUT LES DEPOT -->
                    <li class="bar nr_7 green" style="height: <?php echo ( ($data['CompletedDeposits']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=1&action=select"><?php echo "{$data['CompletedDeposits']}"?></a></span></li>
                    <li class="bar nr_8 orange" style="height: <?php echo ( ($data['PendingDeposits'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=0&action=select"><?php echo "{$data['PendingDeposits']}"?></a></span></li>
                    <li class="bar nr_9 red" style="height: <?php echo ( ($data['CancelledTransactions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=1&status=2&action=select"><?php echo "{$data['CancelledDeposits']}"?></a></span></li>
        
                    <!-- START TOUT LES RETIRAIT -->        
                    <li class="bar nr_10 green" style="height: <?php echo ( ($data['CompletedWithdrawals']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=1&action=select"><?php echo "{$data['CompletedWithdrawals']}"?></a></span></li>
                    <li class="bar nr_11 orange" style="height: <?php echo ( ($data['PendingWithdrawals'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=0&action=select"><?php echo "{$data['PendingWithdrawals']}"?></a></span></li>
                    <li class="bar nr_12 red" style="height: <?php echo ( ($data['CancelledWithdrawals'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=2&status=2&action=select"><?php echo "{$data['CancelledWithdrawals']}"?></a></span></li>
                    
                    <!-- START TOUT LES COMMISSIONS -->
                    <li class="bar nr_13 green" style="height: <?php echo ( ($data['CompletedCommissions']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=1&action=select"><?php echo "{$data['CompletedCommissions']}"?></a></span></li>
                    <li class="bar nr_14 orange" style="height: <?php echo ( ($data['PendingCommissions'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=0&action=select"><?php echo "{$data['PendingCommissions']}"?></a></span></li>
                    <li class="bar nr_15 red" style="height: <?php echo ( ($data['CancelledCommissions'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.php?type=5&status=2&action=select"><?php echo "{$data['CancelledCommissions']}"?></a></span></li>
        
                    <!-- START TOUT LES REMBOURSEMENT -->    
                    <li class="bar nr_16 green" style="height: <?php echo ( ($data['CompletedRefunds']* 250) / 100 )  ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=1&action=select"><?php echo "{$data['CompletedRefunds']}"?></a></span></li>
                    <li class="bar nr_17 orange" style="height: <?php echo ( ($data['PendingRefunds'] * 250) /  100 )   ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=0&action=select"><?php echo "{$data['PendingRefunds']}"?></a></span></li>
                    <li class="bar nr_18 red" style="height: <?php echo ( ($data['CancelledRefunds'] * 250) / 100 ) ?>px;"><div class="top"></div><div class="bottom"></div><span><a href="transactions.htm?type=6&status=2&action=select"><?php echo "{$data['CancelledRefunds']}"?></a></span></li>
            
            
                </ul>    
            </div>
            
            <!-- graph label -->
            <div class="label"><span>Graph: </span>Sommaire Edinars ( Vert: Active/Termine, ORANGE: Suspendu/En Attente, Rouge: Ferm&egrave;/Annul&egrave;)
                                                    </div>
        
        </div>
    <!-- END TOTAL DES COMPTES -->
    
<center>    
    
</div>
<?}else{?>SECURITY ALERT: Access Denied<?}?>