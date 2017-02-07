<script type="text/javascript">
	function refresh(){
		document.getElementById("chatarea").innerHTML="";

		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState==3 && xmlhttp.status==200){
				if(document.getElementById("checkbox").checked){
					document.getElementById("chatarea").innerHTML=xmlhttp.responseText;
					//console.log(xmlhttp.responseText);

				}
			}
			if(xmlhttp.readyState==4){
				xmlhttp.open("GET", "messages.php", true);
				xmlhttp.send();
			}
		}
		xmlhttp.open("GET", "messages.php", true);
		xmlhttp.send();

	}

	function send(){
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		var nickname = encodeURIComponent(document.getElementById("nickname").value);
		var message = encodeURIComponent(document.getElementById("message").value);
		console.log("send.php?nickname="+nickname+"&message="+message);
		xmlhttp.open("GET", "send.php?nickname="+nickname+"&message="+message, true);
		xmlhttp.send();
		document.getElementById("message").value="";
	}


</script>

<div id="chat">
	<input type="checkbox" name="check" id="checkbox" onchange="refresh()"/><p>Uruchom czat</p>
	<textarea rows ="10" cols="15" id="chatarea" disabled></textarea>
	<p>Twoja nazwa</p>
	<input type="text" name="nickname" id="nickname"/>
	<p>Wiadomość</p>
	<input type="text" name="message" id='message'/>
	<button type="button" value="Wyślj" onclick="if(document.getElementById('checkbox').checked && document.getElementById('nickname').value && document.getElementById('message').value){send();}else{alert('coś jest nie tak'); console.log(document.getElementById('checkbox').checked); console.log(document.getElementById('nickname').value); console.log(document.getElementById('message').value);}">Wyślj</button>
</div>
