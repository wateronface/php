
$(function() {
		//全选、反选复选框
         $("#chk_btn").click(function(){
			var checked = $(this).attr('checked');
			if(checked){
				$("input[name='chk_list[]']").attr('checked', 'checked'); 
			}else{
				$("input[name='chk_list[]']").removeAttr('checked'); 
			}
		});
		
		
		//筛选
		$(".searchs").click(function(){
			$('#form_search')[0].submit();
		});

});
	function getCurrentDate(){
		var date=new Date;
		 var year=date.getFullYear(); 
		 var month=date.getMonth()+1;
		 month =(month<10 ? "0"+month:month); 
		 var day = date.getDate();
		 day =(day<10 ? "0"+day:day); 
	     return year+'-'+month+'-'+day;
	} 