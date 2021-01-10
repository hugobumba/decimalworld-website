// JavaScript Document
function nome(a,b){					
	if(b==2){
		var lp=a;
		document.getElementById("idn").value=lp;
		document.getElementById("tp").value=b;
		if(pd==document.getElementById("nm").value){
			document.getElementById("form4").submit();		
		}else
			console.log("Não enviou"); 
	}else{
		if(b==1){
			var lp=a;
			document.getElementById("idn").value=lp;
			document.getElementById("tp").value=b;
			if(pd==document.getElementById("ps").value){
				document.getElementById("form4").submit();
			}else
				console.log("Não enviou"); 
		}
	}
}