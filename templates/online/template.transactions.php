<script type="text/javascript"> 
    $(document).ready(function(){ 
        $(document).pngFix(); 
    }); 
</script> 


<?if(isset($data['ScriptLoaded'])){?>
	<center>
		<?if($post['MemberInfo']){?>
			<b>TRANSACTION POUR COMPTE:</b>
				<a href="members.php?id=<?=$post['MemberInfo']['id']?>&action=detail"><?=$post['MemberInfo']['username']?></a>
				<br><br>
		<?}?>
		<?if($post['ViewMode']=='select'){?>
		
<!-- ############# wrapper start ############# -->
<div class="wrapper">	
    
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
    		<div class="header_tabs">
				<!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current">
					<span class="tab">
					   LES TRANSACTIONS  
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
						if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						
					</span>
					<span class="tab_right"></span>
				</a>
				
				<!-- add class="no_submenu" while a tab with no content -->
			</div>
    	</div>                
    </div> 
	<!-- ############# admin_box_header end ############# -->
        
    <!-- ############# content_box start ############# -->
    <div class="content_box">
    
        <div id="tab01" class="content default_tab">
        	
            <!-- no. of view-->
			<div class="table_top_left_tool">
				<form name="myform" id="myform" method="POST">
				<input type="hidden" name ="status" value="<?=$post['status']?>">
				<input type="hidden" name ="action" value="select">
				<input type="hidden" name ="type" value="<?=$post['type']?>">
				<?if($post['bid']){?>
					<input type="hidden" name ="bid" value="<?=$post['bid']?>">
				<?}?>
				<select name="status" id="status" onchange="javascript: document.myform.submit()">
					 <?=showselect($data['TransactionStatus'], $post['status'])?>
				</select>
				</form>
				  <br class="clear" />
		    </div>
    		<!-- select box end --> 
           <br><br>
            <br class="clear" />
        	<table class="common_table">
				<thead>
					<tr>
						<th class="data_col">DATE</th>
						<?if($post['type']<0){?>
							<th class="short_col">TYPE</th>
						<?}?>
						<?if($post['status']<0){?>
							<th class="short_col">STATUT</th>
						<?}?>
							<th class="short_col">EXP&Egrave;DITEUR</th>
							<th class="short_col">R&Egrave;CEPTEUR</th>
							<th class="short_col">MONTANT</th>
							<th class="short_col">FRAIS</th>
							<th class="short_col">PAY&Egrave;</th>
							<th class="short_col">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?if($data['TransactionsList']){?>
						<?foreach($data['TransactionsList'] as $key=>$value){$bgcolor=$key%2?'#EEEEEE':'#E7E7E7'?>
						<tr <?if($value['sender']==$value['receiver']){?>bgcolor=#CCFFFF<?}else{?>bgcolor=<?=$bgcolor?> onmouseover="setPointer(this,<?=$key?>,'over','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?=$key?>,'out','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?=$key?>,'click','<?=$bgcolor?>','#CCFFCC','#FFCC99')"<?}?>>
							<td>
								<?=$value['tdate']?>
							</td>
							<?if($post['type']<0){?>
								<td ><?=$value['type']?></td>
							<?}?>
							<?if($post['status']<0){?>
								<td>
									<?=$value['status']?>
								</td>
							<?}?>
								<td>
									<?if($value['sender']<0){?>
										<?=$value['senduser']?>
									<?}else{?>
										<a href="members.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['sender']?>&action=detail"><?=$value['senduser']?></a>
									<?}?>
								</td>
								<td>
									<?if($value['receiver']<0){?>
										<?=$value['recvuser']?>
									<?}else{?>
										<a href="members.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['receiver']?>&action=detail"><?=$value['recvuser']?></a>
									<?}?>
								</td>
								<td nowrap><?=$value['amount']?></td>
								<td nowrap><?=$value['fees']?></td>
								<td nowrap><?=$value['nets']?></td>
								<td nowrap>
									<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&type=<?=$post['type']?>&status=<?=$post['status']?>&action=details">VOIR</a>
									<?if($value['ostatus']==0){?>|<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&action=confirm" onclick="return cfmform()">CONFIRMER</a><?}?>
									<?if($value['ostatus']==0||$value['ostatus']==1){?>|<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&action=cancel" onclick="return cfmform()">ANNULER</a><?}?>
								</td>
							</tr>
						<?}
					 }?>
				</tbody>
            </table>
            <div class="table_bottom_right_tool">
        		<?if($data['Pages']){?>
					<div class="page_area">
						<?$count=count($data['Pages']);
							 for($i=0; $i<$count; $i++){?>
								<?if($data['Pages'][$i]==$post['StartPage']){?>
									<span class="current"><?=$i+1?></span>
								<?}else{?>
									<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>page=<?=$data['Pages'][$i]?>&type=<?=$post['type']?>&status=<?=$post['status']?>&action=select" title="Page <?=$i+1?>"><?=$i+1?></a>
								<?}?>
							<?}?>
					</div>			
				<?}?>
            </div>
            <br class="clear" />
        </div>
        <br class="clear" />
    </div>
	<!-- ############# content_box end ############# -->
	<!-- ############# admin_box_bottom start ############# -->
    <div class="admin_box_bottom">
    	<div class="box_bottom_left"></div>
    </div>
    <!-- ############# admin_box_bottom end ############# -->
</div>
<!-- ############# admin_box end ############# -->
</div>
<!-- ############# wrapper end ############# -->

		
					
		<?}elseif($post['ViewMode']=='details'){?>
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
    		<div class="header_tabs">
				<!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current">
					<span class="tab">Détails de la transaction</span>
					<span class="tab_right"></span>
				</a>
				<!-- add class="no_submenu" while a tab with no content -->
			</div>
    	</div>                
    </div> 
	<!-- ############# admin_box_header end ############# -->
        
    <!-- ############# content_box start ############# -->
    <div class="content_box">
    
        <div id="tab01" class="content default_tab">
        	
           
    		<!-- select box end --> 
           <br>
            <br class="clear" />
        	<table class="common_table">
				<thead>
					<tr>
						<th class="data_col">DATE</th>
						<th class="short_col">TYPE</th>
						<th class="short_col">STATUT</th>
						<th class="short_col">IDENTIFIANT</th>
						<th class="short_col">MONTANT</th>
						<th class="short_col">FRAIS</th>
						<th class="short_col">PAY&Egrave;</th>
						<th class="short_col">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td nowrap><?=$post['TransactionDetails']['tdate']?></td>
						<td><?=$post['TransactionDetails']['type']?></td>
			 		    <td><?=$post['TransactionDetails']['status']?></td>
						<td>
						<?if($post['TransactionDetails']['userid']<0){?>
							<?=$post['TransactionDetails']['username']?>
						<?}else{?>
							<a href="members.php?id=<?=$post['TransactionDetails']['userid']?>&action=select"><?=$post['TransactionDetails']['username']?></a>
						<?}?>
						</td>
						<td><?=$post['TransactionDetails']['amount']?></td>
						<td><?=prnpays($post['TransactionDetails']['fees'])?></td>
						<td><?=$post['TransactionDetails']['nets']?></td>
						<td nowrap>
						<a href="transactions.php?
							<?if($post['bid']){?>
								bid=<?=$post['bid']?>&
							<?}?>
							<?if($post['StartPage']){?>
								page=<?=$post['StartPage']?>
							<?}?>
							&type=<?=$post['type']?>&status=<?=$post['status']?>&action=select">RETOUR</a>
						<?if($post['TransactionDetails']['ostatus']==0){?> 
						| <a href="transactions.php?
								<?if($post['bid']){?>
									bid=<?=$post['bid']?>&
								<?}?>
								id=<?=$post['TransactionDetails']['id']?>
								<?if($post['StartPage']){?>
									&page=<?=$post['StartPage']?>
								<?}?>&action=confirm" onclick="return cfmform()">CONFIRMER</a>
						<?}?>
						<?if($post['TransactionDetails']['ostatus']==0||$post['TransactionDetails']['ostatus']==1){?> 
						| <a href="transactions.php?
							<?if($post['bid']){?>
								bid=<?=$post['bid']?>&
							<?}?>
							id=<?=$post['TransactionDetails']['id']?>
							<?if($post['StartPage']){?>
								&page=<?=$post['StartPage']?>
							<?}?>&action=cancel" onclick="return cfmform()">ANNULER</a>
						<?}?>
					</td>
				</tr>
				<tr>
					<td >Comments:</td>
					<td colspan="8"><?=$post['TransactionDetails']['comments']?></td>
				</tr>
				<tr>
					<td>Details:</td>
					<td colspan="8"><pre class=comms><?=$post['TransactionDetails']['ecomments']?></pre></td>
				</tr>
				
					<?if($data['TransactionsList']){?>
						<?foreach($data['TransactionsList'] as $key=>$value){$bgcolor=$key%2?'#EEEEEE':'#E7E7E7'?>
						<tr <?if($value['sender']==$value['receiver']){?>bgcolor=#CCFFFF<?}else{?>bgcolor=<?=$bgcolor?> onmouseover="setPointer(this,<?=$key?>,'over','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?=$key?>,'out','<?=$bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?=$key?>,'click','<?=$bgcolor?>','#CCFFCC','#FFCC99')"<?}?>>
							<td>
								<?=$value['tdate']?>
							</td>
							<?if($post['type']<0){?>
								<td ><?=$value['type']?></td>
							<?}?>
							<?if($post['status']<0){?>
								<td>
									<?=$value['status']?>
								</td>
							<?}?>
								<td>
									<?if($value['sender']<0){?>
										<?=$value['senduser']?>
									<?}else{?>
										<a href="members.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['sender']?>&action=detail"><?=$value['senduser']?></a>
									<?}?>
								</td>
								<td>
									<?if($value['receiver']<0){?>
										<?=$value['recvuser']?>
									<?}else{?>
										<a href="members.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['receiver']?>&action=detail"><?=$value['recvuser']?></a>
									<?}?>
								</td>
								<td nowrap><?=$value['amount']?></td>
								<td nowrap><?=$value['fees']?></td>
								<td nowrap><?=$value['nets']?></td>
								<td nowrap>
									<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&type=<?=$post['type']?>&status=<?=$post['status']?>&action=details">VOIR</a>
									<?if($value['ostatus']==0){?>|<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&action=confirm" onclick="return cfmform()">CONFIRMER</a><?}?>
									<?if($value['ostatus']==0||$value['ostatus']==1){?>|<a href="transactions.php?<?if($post['bid']){?>bid=<?=$post['bid']?>&<?}?>id=<?=$value['id']?><?if($post['StartPage']){?>&page=<?=$post['StartPage']?><?}?>&action=cancel" onclick="return cfmform()">ANNULER</a><?}?>
								</td>
							</tr>
						<?}
					 }?>
				</tbody>
            </table>
            
            <br class="clear" />
        </div>
        <br class="clear" />
    </div>
	<!-- ############# content_box end ############# -->
	<!-- ############# admin_box_bottom start ############# -->
    <div class="admin_box_bottom">
    	<div class="box_bottom_left"></div>
    </div>
    <!-- ############# admin_box_bottom end ############# -->
</div>
<!-- ############# admin_box end ############# -->
</div>
<!-- ############# wrapper end ############# -->


		<?} elseif($post['ViewMode']=='summary'){?>
		  
<!-- ############# wrapper start ############# -->
<div class="wrapper">
	
    
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    
    
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
    		<div class="header_tabs"><!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current"><span class="tab"><?=$post['day']?> <?=$data['StatMonth'][$post['month']]?> <?=$post['year']?></span><span class="tab_right"></span></a>
				<a href="#tab02"><span class="tab"><?=$data['StatMonth'][$post['month']]?> <?=$post['year']?></span><span class="tab_right"></span></a>
				<a href="#tab03"><span class="tab"><?=$post['year']?></span><span class="tab_right"></span></a>
			</div>
        </div>                
    </div>
	<!-- ############# admin_box_header end ############# -->
        
    <!-- ############# content_box start ############# -->
    <div class="content_box">
    
        <div id="tab01" class="content default_tab">
        	
            <!-- no. of view-->
			<div class="table_top_left_tool">
				<form method=post>
					<input type=hidden name=action value="summary">
					<select name=day onchange="submit()"><?=showselect($data['StatDays'], $post['day'])?></select>
					<select name=month onchange="submit()"><?=showselect($data['StatMonth'], $post['month'])?></select>
					<select name=year onchange="submit()"><?=showselect($data['StatYear'], $post['year'])?></select>
				</form>
            </div>
    		<!-- select box end --> 
            <br><br><br>
          <?if($post['day']>0&&$post['month']>0){?>
				<!-- css bar graph -->
				<div class="css_bar_graph">
					
					<!-- y_axis labels -->
					<ul class="y_axis">
						<li>100 000</li>
						<li>90 000</li>
						<li>80 000</li>
						<li>70 000</li>
						<li>60 000</li>
						<li>50 000</li>
						<li>40 000</li>
						<li>30 000</li>
						<li>20 000</li>
						<li>10 000</li>
						<li>0</li>
					</ul>
					
					<!-- x_axis labels -->
					<ul class="x_axis">
						<?foreach($data['TransactionType'] as $value){?>
							<li><?=strtoupper($value)?></li>
						<?}?>
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
						<!-- 250px = 10000% -->
							 
						<ul>
							<?
							$I = 1 ;	
							foreach($post['Daily'] as $value){?>
							  
								<li class="bar nr_<?=$I?> green" style="height: <?php echo ( ($value['Summ']* 250) / 100000 ) ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Summ']}"?></span>
								</li>
								<li class="bar nr_<?=$I+1?> orange" style="height: <?php echo ( ($value['Fees'] * 250) /  100000)   ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Fees']}"?></span>
								</li>
							<?
								$I = $I+3;
							}?>
							</ul>	
					</div>
					<!-- graph label -->
					<div class="label">
						<span>Graph: </span>Toutes les transactions pour <?=$post['day']?> <?=$data['StatMonth'][$post['month']]?> <?=$post['year']?>
						<br><span>Vert: </span>Total
						<br><span>ORANGE:</span>Frais
					</div>
				</div>
		<?}?>
            
            <br class="clear" />
        </div>
        
        <div id="tab02" class="content">
            		<?if($post['month']>0){?>
					<!-- css bar graph -->
				<div class="css_bar_graph">
					
					<!-- y_axis labels -->
					<ul class="y_axis">
						<li>100 000</li>
						<li>90 000</li>
						<li>80 000</li>
						<li>70 000</li>
						<li>60 000</li>
						<li>50 000</li>
						<li>40 000</li>
						<li>30 000</li>
						<li>20 000</li>
						<li>10 000</li>
						<li>0</li>
					</ul>
					
					<!-- x_axis labels -->
					<ul class="x_axis">
						<?foreach($data['TransactionType'] as $value){?>
							<li><?=strtoupper($value)?></li>
						<?}?>
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
						<!-- 250px = 10000% -->
							 
						<ul>
							<?
							$I = 1 ;	
							foreach($post['Monthly'] as $value){?>
							  
								<li class="bar nr_<?=$I?> green" style="height: <?php echo ( ($value['Summ']* 250) / 100000)  ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Summ']}"?></span>
								</li>
								<li class="bar nr_<?=$I+1?> orange" style="height: <?php echo ( ($value['Fees'] * 250) / 100000)   ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Fees']}"?></span>
								</li>
							<?
								$I = $I+3;
							}?>
							</ul>	
					</div>
					<!-- graph label -->
					<div class="label">
						<span>Graph: </span>Toutes les transactions pour <?=$data['StatMonth'][$post['month']]?> <?=$post['year']?>
						<br><span>Vert: </span>Total
						<br><span>ORANGE:</span>Frais
					</div>
				</div>
				<?}?> 
				<br class="clear" />
             
        </div>
        
        <div id="tab03" class="content">
			
					<!-- css bar graph -->
				<div class="css_bar_graph">
					
					<!-- y_axis labels -->
					<ul class="y_axis">
						<li>1 000 000</li>
						<li>900 000</li>
						<li>800 000</li>
						<li>700 000</li>
						<li>600 000</li>
						<li>500 000</li>
						<li>400 000</li>
						<li>300 000</li>
						<li>200 000</li>
						<li>100 000</li>
						<li>0</li>
					</ul>
					
					<!-- x_axis labels -->
					<ul class="x_axis">
						<?foreach($data['TransactionType'] as $value){?>
							<li><?=strtoupper($value)?></li>
						<?}?>
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
						<!-- 250px = 10000% -->
							 
						<ul>
							<?
							$I = 1 ;	
							foreach($post['Yearly'] as $value){?>
							  
								<li class="bar nr_<?=$I?> green" style="height: <?php echo ( ($value['Summ']* 250) / 1000000)  ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Summ']}"?></span>
								</li>
								<li class="bar nr_<?=$I+1?> orange" style="height: <?php echo ( ($value['Fees'] * 250) /  1000000)   ?>px;">
									<div class="top"></div>
									<div class="bottom"></div>
									<span><?="{$value['Fees']}"?></span>
								</li>
							<?
								$I = $I+3;
							}?>
							</ul>	
					</div>
					<!-- graph label -->
					<div class="label">
						<span>Graph: </span>Toutes les transactions pour l'année <?=$post['year']?> 
						<br><span>Vert: </span>Total
						<br><span>ORANGE:</span>Frais
					</div>
				</div>
				
				<br class="clear" />
		
		
        </div>
        
        
        <br class="clear" />
    </div>
	<!-- ############# content_box end ############# -->
        
        
    <!-- ############# admin_box_bottom start ############# -->
    <div class="admin_box_bottom">
    	<div class="box_bottom_left"></div>
    </div>
    <!-- ############# admin_box_bottom end ############# -->
    
    
</div>
<!-- ############# admin_box end ############# -->
    
    
</div>
		

	
	<?}?>
	</center>
<?}else{?>SECURITY ALERT: Access Denied<?}?>