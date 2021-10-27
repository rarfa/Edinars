$(document).ready(function(){
	

	// Tables controls:
	$("td.controls a").hide();
  	$("tr").hover(
      function () {
        $(this).find("td.controls a").show();
      }, 
      function () {
        $(this).find("td.controls a").hide();
      }
    );  




    // Content box tabs:
		
		$('.content_box div.content').hide(); 
		$('.header_tabs a.default_tab').addClass('current'); 
		$('.content_box div.default_tab').show(); 
		$('.header_tabs a').click( 
			function() { 
				$(this).parent().find("a").removeClass('current'); 
				$(this).addClass('current'); 
				var currentTab = $(this).attr('href'); 
				$(currentTab).siblings().hide(); 
				$(currentTab).show(); 
				return false;
			}
		);
		
		// When a tab with no content is clicked...
		$(".header_tabs a.no_submenu").click( 
			function () {
				window.location.href=(this.href);
				return false;
			}
		); 
		

    

    // Alternating table rows:
		
		$('tbody tr:odd').addClass("alt_row"); // Add class "alt-row" to even table rows
		

    // Check all checkboxes when the one in a table head is checked:
		
		$('.check_all').click(
			function(){
				$(this).parent().parent().parent().parent().find("input[type='checkbox'].action").attr('checked', $(this).is(':checked'));   
			}
		);
		
		
		
	// Search form style control:
		$('input.textfield').focus(function() {  
			$(this).parent().css("background-position", "0 -21px");  
			});  
		$('input.textfield').blur(function() {  
			$(this).parent().css("background-position", "0 0");  
			});  

});
  
  
  