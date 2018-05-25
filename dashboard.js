function clearField()
{
	document.getElementById("url").value="";
	document.getElementById("maindiv").value="";
}


function urlCheck()
{
	alert("ds");

	var uCheck=document.getElementById("url").value;
		 var xmlhttp = new XMLHttpRequest();
	          xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("ds");
                        document.getElementById('maindiv').style.display = "block";
                        document.getElementById("maindiv").innerHTML = this.responseText;
                        
                        }
                };
                xmlhttp.open("GET", "view.php?uCheck="+uCheck, true);
                xmlhttp.send();
}