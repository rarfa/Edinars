<!-- Start content  -->
<div class="container">
<br />
<?if(isset($data['ScriptLoaded'])){?>
<center>
	<?if($post['action']=='select'){?>
		<?if(!$post['SearchResult']){?>
			 
			
		
		
		<?}?>

    
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
    		<div class="header_tabs">
				<!-- add tabs in this div -->
				
				<?if($post['status']<0&&$post['type']<0){?>
					<a href="#tab01" class="default_tab current">
						<span class="tab">LES TRANSACTIONS
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
							if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						</span><span class="tab_right"></span>
					</a>
				<? } else { ?>
					<a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$post['StartPage']?>" class="no_submenu"><span class="tab">LES TRANSACTIONS</span><span class="tab_right"></span></a> <!-- add class="no_submenu" while a tab with no content -->
				<?}?>
				
					<?if($post['status']==0){?>
						<a href="#tab01" class="default_tab current">
						<span class="tab">
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
						if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						</span><span class="tab_right"></span>
					</a>
				   <?}else{?>
					    <a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$post['type']?>/0" class="no_submenu"><span class="tab">EN ATTENTE</span><span class="tab_right"></span></a> <!-- add class="no_submenu" while a tab with no content -->
					<?}?> 
					<?if($post['status']==1){?>
						<a href="#tab01" class="default_tab current">
						<span class="tab">
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
						if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						</span><span class="tab_right"></span>
					</a>
					<?}else{?>
					    <a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$post['type']?>/1" class="no_submenu"><span class="tab">TERMINE</span><span class="tab_right"></span></a> <!-- add class="no_submenu" while a tab with no content -->
				    <?}?> 
					<?if($post['status']==2){?>
						<a href="#tab01" class="default_tab current">
						<span class="tab">
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
						if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						</span><span class="tab_right"></span>
						
					</a>
					<?}else{?>
					    <a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$post['type']?>/2" class="no_submenu"><span class="tab">ANNULER</span><span class="tab_right"></span></a> <!-- add class="no_submenu" while a tab with no content -->
					<?}?> 
					<?if($post['status']==3){?>
						<a href="#tab01" class="default_tab current">
						<span class="tab">
						<?
						echo (strtoupper($data['TransactionType'][$post['type']]).' ');						
						if($post['status'] != -1){ echo strtoupper($data['TransactionStatus'][$post['status']]) ;}  ?>
						</span><span class="tab_right"></span>
						
					</a>
					<?}else{?>
						<a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$post['type']?>/3" class="no_submenu"><span class="tab">REMBOURSE</span><span class="tab_right"></span></a> <!-- add class="no_submenu" while a tab with no content -->
					<?}?>
					
					<!-- <a href="#tab02"><span class="tab">RECHERCHER</span><span class="tab_right"></span></a>-->
			
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
				<select name="type" id="type" onchange="javascript: document.myform.submit()">
					 <?=showselect($data['TransactionTypeUser'], $post['type'])?>
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
								<th class="data_col">DIR</th>
								<th class="data_col">MEMBER</th>
								<th class="data_col">MONTANT</th>
								<th class="data_col">FRAIS</th>
								<th class="data_col">PAY&Egrave;</th>
								<th class="data_col">DATE</th>
								<th class="data_col">TYPE</th>
								<th class="data_col">STATUT</th>
								<th class="data_col">ACTION</th>
							</tr>
						</thead>
						<tbody>
								<?php if($post['Transactions']){
									$idx=1;
									foreach($post['Transactions'] as $value){ ?>
									<tr>
										<td><img src="<?=$data['Host']?>/<?=$data['direction'][$value['direction']] ;?>"></td>
										<td><?if($value['userid']>0){?><a href="<?=$data['Members']?>/member-Edinars/<?=$value['userid']?>/view"><?=prntext($value['username'])?></a><?}else{?><?=prntext($value['username'])?><?}?></td>
										<td nowrap ><?=$value['amount']?></td>
										<td><?=$value['fees']?></td>
										<td nowrap><?=$value['nets']?></td>
										<td><?=$value['tdate']?></td>
										<td><?=$value['type']?></td>
										<td><?=$value['status']?></td>
										<td nowrap>
										<?if($value['canview']){?>
											<a href="<?=$data['Members']?>/mon-historique-Edinars-transaction/<?=$value['id']?>/details">D&Egrave;TAIL</a><?}?>
												<?if($value['canrefund']){?>
													<br><a href="<?=$data['Members']?>/mon-historique-Edinars-transaction/<?=$value['id']?>/refund" onclick="return cfmform()">REMBOURSE</a>
												<?}?>
										</td>
									</tr>
						     <?php 
							     }
							   }else{?>
								<tr>
									<td colspan=9  align=center>AUCUNE TRANSACTION TROUV&Egrave;</td>
								</tr>
								<?}?>
								
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
									<a href="<?=$data['Members']?>/mon-historique-Edinars/<?=$data['Pages'][$i]?>/<?=$post['type']?>/<?=$post['status']?>/transaction" title="Page <?=$i+1?>"><?=$i+1?></a>
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


	<?}elseif($post['action']=='details'){?>
	
<!-- ############# admin_box start ############# -->
		<div class="admin_box">
			<!-- ############# admin_box_header start ############# -->
			<div class="admin_box_header">
				<div class="box_header_left">
					<div class="header_tabs"><!-- add tabs in this div -->
						
						<a href="#tab01" class="default_tab current" ><span class="tab">D&egrave;tails de la transaction</span><span class="tab_right"></span></a>
						<?if($post['Transaction']['ecomments']){?>
							<a href="#tab02"><span class="tab">Information compl&egrave;mentres</span><span class="tab_right"></span></a>
						<?}?>
					
					</div>
				</div>                
			</div>
			<!-- ############# admin_box_header end ############# -->
			<!-- ############# content_box start ############# -->
			<div class="content_box">
				<div id="tab01" class="content default_tab">
					<center>
					<br class="clear" />
					<center>	
						<table class="common_table_detail">
							<thead>
								<tr>
								
								</tr>
							</thead>
							<tbody>
									<tr>
										<td>Date</td>
										<td><?=$post['Transaction']['tdate']?></td>
									</tr>
									<tr>	
										<td>Identifiant</td>
										<td>	
											<?if($post['Transaction']['userid']>0){?>
												<a href="userinfo.htm?id=<?=$post['Transaction']['userid']?><?if(isset($post['StartPage'])){?>&page=<?=$post['StartPage']?><?}?>&action=view"><?=$post['Transaction']['username']?></a>
											<?}else{?>
												<?=prntext($post['Transaction']['username'])?>
											<?}?>
										</td>
									</tr>
									<tr>
										<td>Montant</td>
										<td><?=$post['Transaction']['amount']?></td>
									</tr>
									<tr>
										<td>Frais</td>
										<td><?=prnfees($post['Transaction']['fees'])?></td>
									</tr>
									<tr>
										<td>Pay&egrave;</td>
										<td><?=$post['Transaction']['nets']?></td>
									</tr>
									<tr>
										<td>Type</td>
										<td><?=$post['Transaction']['type']?></td>
									</tr>
									<tr>
										<td>Statut</td>
										<td><?=$post['Transaction']['status']?></td>
									</tr>
									<tr>
										<td>Description</td>
										<td><?=str_replace( $data['line'], $data['replace'], prntext($post['Transaction']['comments']) );?></td>
									</tr>
									<?if($post['Transaction']['canrefund']){?>
									<tr>
										<td colspan="2" class="middle">
										<form method="post">
											<input type="hidden" name="id" id="id" value="<?=$post['Transaction']['id']?>">
											<input type="hidden" name="actiob" id="action" value="refund">
											<input type="submit" id="submit" name="send" value="REMBOURSEMENT" onclick="return cfmform()"/>
										</form>
										</td>
									</tr>	
									<?}?>
						  </tbody>
						</table>	
					</center>	
					<br class="clear" />
				</div>
				<?if($post['Transaction']['ecomments']){?>
					<div id="tab02" class="content">
						<br class="clear" />
							<center>	
								<?=str_replace($data['line'] ,$data['replace'] , prntext($post['Transaction']['ecomments']));?>
							</center>	
					 <br class="clear" />
					</div>
				<?}?>	
				<br class="clear" />
			</div>
				
		</div>
		<!-- ############# content_box end ############# -->
				
			<!-- ############# admin_box_bottom start ############# -->
			<div class="admin_box_bottom">
				<div class="box_bottom_left">
					
				</div>
			</div>
			<!-- ############# admin_box_bottom end ############# -->
			
		</div>
		<!-- ############# admin_box end ############# -->
		</div>
   </div>					   

	<?}else if($post['action']=='search'){?>
			<form method=post>
				<input type=hidden name=action value="<?=$post['action']?>">
				<input type=hidden name=page value="<?=$post['StartPage']?>">
				<table class=frame width=100% border=0 cellspacing=1 cellpadding=2>
					<tr>
						<td class=capc colspan=2>SEARCH OPTIONS</td>
					</tr>
					<tr>
						<td class=field nowrap>
							<label for=field1>Search by the username 
							<input type=radio class=checkbox id=field1 name=field value=username checked onclick="username.disabled=false;day.disabled=true;month.disabled=true;year.disabled=true"></label>
						</td>
						<td class=input>
							<input type=text name=username size=40 maxlength=255></td>
					</tr>
					<tr>
						<td class=field nowrap>
							<label for=field2>Search by the date 
							<input type=radio class=checkbox id=field2 name=field value=tdate onclick="username.disabled=true;day.disabled=false;month.disabled=false;year.disabled=false"></label>
						</td>
						<td class=input>
							<select name=day disabled><?=showselect($data['StatDays'], $post['day'])?></select>&nbsp;
							<select name=month disabled><?=showselect($data['StatMonth'], $post['month'])?></select>&nbsp;
							<select name=year disabled><?=showselect($data['StatYear'], $post['year'])?></select>
						</td>
					</tr>
					<tr>
						<td class=capc colspan=2>
							<input type=submit class=submit name=cancel value="BACK">&nbsp;
							<input type=submit class=submit name=search value="SEARCH NOW!">
						</td>
					</tr>
				</table>
			</form>
		<?}?>
</center>
<?}else{?>SECURITY ALERT: Access Denied<?}?>
</div>

<!-- End content  -->

