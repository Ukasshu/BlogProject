function listStyles(){
	var stylesheets = document.getElementsByTagName("link");
	//console.log(stylesheets);
	var select = document.createElement("select");
	//console.log(select);
	select.onchange = function() {setStyle();};
	select.name = "styl";
	//console.log(select);
	for(var i = 0; i<stylesheets.length; i++){
		var style = stylesheets[i];
		//console.log(style);
		if(style.getAttribute("title")){
			var option = document.createElement("option");
			//console.log(option);
			option.setValue = style.getAttribute("title");
			//console.log(option);
			option.appendChild(document.createTextNode(style.getAttribute("title")));
			//console.log(option);
			select.appendChild(option);
			//console.log(select);
			//console.log(option);
		}
	}
	document.getElementById("footer").appendChild(select);
}



function setStyle(){
	var select = document.getElementsByName('styl')[0];
	//console.log(select);
	var title = select.children[select.selectedIndex].childNodes[0];
	//console.log(title);
	var links = document.getElementsByTagName('link');
	//console.log(links);
	for(var i =0; i<links.length; i++){
		var style = links[i];
		//console.log(style);
		//console.log(style.getAttribute('title'));
		if(style.getAttribute('title')){
			style.disabled = true;
			//console.log(style.getAttribute('title') == title);
			//console.log(title.data);
			//console.log(style.getAttribute('title'));
			if(style.getAttribute('title') == title.data){
				//console.log("no jestem");
				style.disabled = false;
			}
		}
	}
	createCookie();
}

function createCookie(){
	var style = "style="+document.getElementsByName('styl')[0].selectedIndex+";";
	var date = new Date();
	date.setTime(date.getTime() + 60*24*60*60*1000);
	var expires = "expires="+date.toGMTString()+";";
	var path = "path=/";
	document.cookie = style + expires +path;
}

function readCookie(){
	var cookieArray = document.cookie.split(";");
	for(var i =0; i< cookieArray.length; i++){
		if(cookieArray[i].indexOf("style=")==0){
			document.getElementsByName('styl')[0].selectedIndex = parseInt(cookieArray[i].substring(6));
			setStyle();
			break;
		}
	}
}

window.onload = function(){ readCookie(); };
window.onunload = function(){ createCookie(); };

listStyles();
readCookie();