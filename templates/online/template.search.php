<?if(isset($data['ScriptLoaded'])){?>
	<center>
		<?if($post['action']=='search'){?>
			<? if (!isset($post['keyword']) || empty($post['keyword'])) {?>
				   
<!-- ############# admin_box start ############# -->
<div class="admin_box">
    
    
    <!-- ############# admin_box_header start ############# -->
    <div class="admin_box_header">
    	<div class="box_header_left">
			<div class="header_tabs"><!-- add tabs in this div -->
				<a href="#tab01" class="default_tab current"><span class="tab">RECHERCHE</span><span class="tab_right"></span></a>
			</div>
		</div>                
    </div>
	<!-- ############# admin_box_header end ############# -->
   <!-- ############# content_box start ############# -->
    <div class="content_box">
       



	   <div id="tab01" class="content default_tab">
            <!-- no. of view-->
			<form method=post><br/>
			<input type=hidden name=action value="search">
            
			<table class="common_table_detail">
					<thead>
						<tr>
							<th class="data_col" colspan="2">RECHERCHE</a></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="left" nowrap >choisir votre champs </td>
							<td>
								<select name="sfield">
									<option value="un">IDENTIFIANT</option>
									<option value="fn">NOM</option>
									<option value="ln">PR&Egrave;NOM</option>
									<option value="em">E-MAIL</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="left" nowrap >MOT CLE</td>
							<td nowrap >
								<!-- searchbox start-->
									<div class="searchbox">
										<input type="text" class="textfield" name ="keyword" size="24" value="" />
										<input type="submit" class="button" name="srchbtn" value="" />
									</div>
									<!-- searchbox end --> 
							</td>
						</tr>
						
					</tbody>
			</table>
			</form>	
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

			
			<?}?>
		<?}?>
	</center>
<?}else{?>SECURITY ALERT: Access Denied<?}?>