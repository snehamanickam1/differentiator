<head>
	 <script type="text/javascript">
function clearField()
{
	document.getElementById("url").value="";
	document.getElementById("maindiv").value="";
}


function urlCheck()
{
	//alert("ds");

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
	 	
	 </script>
	
</head>
<table align="center"><tr><td colspan="2">
<div class="form-group shadow-textarea">
    <br/><br/>
    <textarea rows="10" id="url" cols="60" placeholder="Enter the Urls here..."></textarea>
</div>
</td></tr>
<tr><td style="padding-top: 15px;" align="right">

<button style="padding: 3px;" onclick="urlCheck();">Go</button>
</td>
<td style="padding-left: 5px;padding-top: 15px;">
<button style="padding: 3px;" onclick="clearField();">clear</button>
</td></tr></table>

<br/>
</br>

<table width="400" align="center"><tr><td><div id="maindiv">


	</div></td></tr></table>
                