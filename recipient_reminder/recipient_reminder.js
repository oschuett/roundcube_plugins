/* Recipient Reminder plugin script */

if (window.rcmail) {
	rcmail.addEventListener('beforesend', function(evt) {
		var recipients  =  $("[name='_to']").val();
		recipients += ","+$("[name='_cc']").val();
		recipients += ","+$("[name='_bcc']").val();
		
		//alert(all_recipients);
		
		//warn if there are espcially 'dangerous' recipients
		var keyword = ["ag-", "all", "group","list"];
		for (var i = 0; i < keyword.length; i++) {    
			//console.log(keyword[i]);
			var re = new RegExp(keyword[i],'i');
			if(recipients.search(re) != -1){
				var txt = "Recipients include '"+keyword[i]+"'."
				if(!confirm(txt))
					return false;
			}
		}
		
		//warn if there are too many recipients
		N_max = 3;
		if(recipients.split("@").length-1 > N_max){
			var txt = "Message has more than "+N_max+" recipients."
			if(!confirm(txt))
				return false;
		}
		 
	});
}

//EOF
