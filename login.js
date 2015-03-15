// Eric Gullufsen

function login(){
	var un = document.getElementById("username");
	un = encodeURIComponent(un);
	var pass = document.getElementById("password");
	pass = encodeURIComponent(pass);
	
	var params = "username=" + un;
	
	var xm = new XMLHttpRequest();
	
	xm.open("POST", "login.php?", true);
	
	xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	xm.onreadystatechange = function(){
		if(xm.readyState == 4){
			
			var resp = JSON.parse(xm.responseText);
			if (resp.success == 1){
				
				window.location="data.html";
			}
		}
	};
	xm.send(params);
}