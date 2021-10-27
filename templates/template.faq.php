
<!-- Start content  -->

<div class="content">
	<div id="sidebar_content">
		<article class="col-1">
			<div class="col_title">Questions fréquentes</div>
			<div class="col_text">
				<p class="pm">
				   <ul class="list1">
					<?	$qr1 = mysql_query("SELECT * FROM dp_faq_cat_list ORDER BY title") or die( mysql_error() );
						while ($r1 = mysql_fetch_object($qr1)){
						
						if (!$r1->title) continue;
							?>
								<li><a href="#<?=$r1->id?>"><?=$r1->title?></a></li>
							<?
								}
							?>
					</ul>
				</p>				
			</div>
		</article>
	</div>
	<div id="side_content">
		<article class="col-2">
			<div class="col_title">Questions fréquentes sur Edinars</div>
			<div class="col_text">
					<p class="pm" align="centre">
					<?	$qr1 = mysql_query("SELECT * FROM dp_faq_cat_list ORDER BY title ") or die( mysql_error() );
								  while ($r1 = mysql_fetch_object($qr1)){
									if (!$r1->id) continue;
									?>
										<h1 id="<?=$r1->id?>"><?=$r1->title?></h1>
										<ul class="section_menu">
									<?		
										$qr2 = mysql_query("SELECT * FROM dp_faq_list WHERE cat='".$r1->id."' ORDER BY question");
										while ($r2 = mysql_fetch_object($qr2)){
											if (!$r2->question) continue;
									?>				
											<li><a href="#<?=$r2->id?>_<?=$r1->id?>"><?=$r2->question?></a></li>
									<?	} ?>
										</ul>
										<dl class="faq">
									<?		
										$qr3 = mysql_query("SELECT * FROM dp_faq_list WHERE cat='".$r1->id."' ORDER BY question");
										while ($r3 = mysql_fetch_object($qr3)){
											if (!$r3->question) continue;
									?>				
											<dt id="<?=$r3->id?>_<?=$r1->id?>"><?=$r3->question?></dt>
											<dd><?=$r3->answer?></dd>
									<?	} ?>
										</dl>
									<?
									}  
								?>
					</p>
				 </div>					
		
		</article>
	</div>
	<div class="clr"></div>

</div>

<!-- End content  -->

<script>
			$(document).ready(function () {  

				var sidebar = $('#sidebar_content');
				var sidecontent = $('#side_content');
				var top = sidebar.offset().top - parseFloat(sidebar.css('marginTop'));
			
				$(window).scroll(function (event) {
					var ypos = $(this).scrollTop();
					if (ypos >= top) {
						sidebar.addClass('fixed');
						sidecontent.addClass('fixed');
					}
					else {
						sidebar.removeClass('fixed');
						sidecontent.removeClass('fixed');
					}
				});

				$.localScroll();
				
			});
			
</script>