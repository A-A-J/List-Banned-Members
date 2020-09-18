$(document).ready(function(){     
    'use strict';
    load_data();
    function load_data(query)
    {
        $.ajax({
            url:"table_data_ban.php",
            method:"post",
			data:{search_ban:query},
			
			// beforeSend: function(){
			// 	$('.loding').show();
			// },

			// complete: function(){
			// 	$('.loding').hide();
			// },
			
            success:function(data){
                $('.top_ban').html(data);
            }
        });
    }
    
    $('#name_search').keyup(function(){
		var search = $(this).val();
        if(search != ''){
            load_data(search);
        }else{
            load_data();			
        }
    });
});