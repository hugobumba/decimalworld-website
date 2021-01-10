//Função que submete a alteração das funções
function submete(a){
	var b="form";
	var c=b.concat(a);
	document.getElementById(c).submit();
}

//Funcção de pesquisa
function myFunction() {
	var p, f, idcr, tr, td, i,j;
	p = document.getElementById("myInput");
	f = p.value.toUpperCase();
	console.log(f);
	idcr = document.getElementById("cr");
	tr = idcr.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td){
			j=td.innerHTML.toUpperCase().indexOf(f);
			if (td.innerHTML.toUpperCase().indexOf(f) == 0){
				tr[i].style.display = "";
			}else{
				tr[i].style.display = "none";
			}
		}
	}
}