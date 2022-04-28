$(document).ready(function(){
//-----------Search box ---------------------------------	 
	 $('#search_text').keyup(function(){
	 	
	 	var search = $(this).val();
	 	$.post('ajax.php', {search : search}, function(data){
	 		$('#result').html(data);
	 		var searchList = document.getElementById('result');
	 		window.onclick = function(event) {
	 			if(event.target != searchList ){
	 				searchList.style.display = "none";
	 			} else if(event.target == document.getElementById('search_text') ){
	 				searchList.style.display = 'block';
	 			}
	 		}

	 	});

	});
	});