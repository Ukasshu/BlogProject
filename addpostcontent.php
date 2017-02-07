<h2>Dodawanie nowego wpisu</h2>
<form action="post.php" method="post" enctype="multipart/form-data">
	Login:<br/>
	<input type="text" name="login" size="40" placeholder="Login"><br/>
	Hasło:<br/>
	<input type="password" name="password" size="40" placeholder="Hasło"><br/>
	Treść posta:<br/>
	<textarea name="body" rows="5" cols="40" placeholder="Treść"></textarea><br/>
	<input type="text" name="date" onblur="checkDate()">
	<input type="text" name="time" onblur="checkTime()"><br/>
	Załączniki:<br/>
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
	<input type="hidden" name="filesCounter" value="2097152">
	<div id="files">
		<input type="file" name="userfile1" onchange="addFileInput()"><br/>
	</div>
	<input type="submit"> <input type="reset">
</form>

<script type="text/javascript">
	function checkDate() {
		var input = document.getElementsByName("date")[0];
		var date = input.value.match("[0-9]{1,4}-[0-9]{2}-[0-9]{2}"); 
		var flag = date.length == 1 && input.value == date[0];
		
		if(flag){
			var numbers = input.value.split("-");
			if(numbers[0]<0 || numbers[1]<1 || numbers[1]>12){ //zły rok lub miesiac
				flag = false;
				console.log(1);
			}
			else if((numbers[1]== 1 || numbers[1]== 3 || numbers[1]==5 || numbers[1]==7 || numbers[1]==8 || numbers[1]==10 || numbers[1]==12) && (numbers[2]<1 || numbers[2]>31)){ //zly dzien w miesiacach z 31 dniami
				flag = false;
				console.log(2);
			}
			else if((numbers[1]== 4 || numbers[1]== 6 || numbers[1]==9 || numbers[1]==11 ) &&((numbers[2]<1 || numbers[2]>30))){ //zly dzien w miesiacach z 30 dniami
				flag = false;
				console.log(3);
			}
			else if(numbers[1] == 2 && (numbers[0]%4==0 && (numbers[0]%100 != 0 || numbers[0]%400 == 0))  && (numbers[2]<1 || numbers[2]>29)){
				flag = false;
				console.log(4);
			}
			else if( numbers[1]==2 && (numbers[0]%4==0 && numbers[0]%100==0) &&(numbers[2]<1 || numbers[2]>28)){
				flag = false;
				console.log(5);
			}			
		}
		
		if(!flag){
			var date = new Date();
			var dd = date.getDate();
			var mm = date.getMonth() + 1;
			var yyyy = date.getFullYear();
			if(dd < 10){
				dd ="0" + dd;
			}
			if(mm < 10){
				mm = "0" + mm;
			}
			input.value = yyyy+"-"+mm+"-"+dd;
			alert("Niepoprawny format daty");
		}
	}

	function checkTime(){
		var input = document.getElementsByName("time")[0];
		var time = input.value.match("[0-9]{2}:[0-9]{2}");
		var flag = time.length == 1 && input.value == time[0];
		if(flag){
			var numbers = input.value.split(":");
			if(numbers[0]<0 || numbers[0]>23){
				flag = false;
			}
			else if(numbers[1]<0 || numbers[1]>59){
				flag = false;
			}
		}
		if(!flag){
			var date = new Date();
			var hh = date.getHours();
			var mm = date.getMinutes();
			if(hh<10){
				hh = "0"+hh;
			}
			if(mm<10){
				mm = "0" + mm;
			}
			input.value = hh+":"+mm;
			alert("Niepoprawny format godziny");
		}
	}

	function setDateTime(){
		var dateInput = document.getElementsByName("date")[0];
		var date = new Date();
		var dd = date.getDate();
		var mm = date.getMonth() + 1;
		var yyyy = date.getFullYear();
		if(dd < 10){
			dd ="0" + dd;
		}
		if(mm < 10){
			mm = "0" + mm;
		}
		dateInput.value = yyyy+"-"+mm+"-"+dd;

		var timeInput = document.getElementsByName("time")[0];
		var HH = date.getHours();
		var MM = date.getMinutes();
		if(HH<10){
			HH = "0" + HH;
		}
		if(MM<10){
			MM = "0" + MM;
		}
		timeInput.value = HH+":"+MM;
	}

	setDateTime();

	function addFileInput() {
		var filesDiv = document.getElementById("files");
		var number = filesDiv.children.length;
		for(var i = 0; i<number; i+=2){
			if(filesDiv.children[i].value == ""){
				return;
			}
		}
		number = number +2;
		var input = document.createElement("input");
		input.type = "file";
		input.name = "userfile"+(number/2);
		input.onchange = function(){addFileInput();};
		filesDiv.appendChild(input);
		filesDiv.appendChild(document.createElement("br"));
	}
</script>
	
