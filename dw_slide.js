var k = 0;
roda();
function roda(){
	var i;
	var x = document.getElementsByClassName("item");
	for (i=0; i<x.length; i++) {
		x[i].style.display = "none";
	}
	k++;
	if (k > x.length) {k = 1}
	x[k-1].style.display = "block";
	setTimeout(roda, 3000);
}