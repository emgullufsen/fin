// Eric Gullufsen
function drop(id){
	
	var xmm = new XMLHttpRequest();
	var params = "id=" + id;
	var urll = "drop.php?";
	xmm.open("POST",urll, true);
	xmm.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmm.onreadystatechange = function(){
	if(xmm.readyState == 4){
		var resp = JSON.parse(xmm.responseText);
		if (resp.dropped == 1){
			
			document.getElementById(id.toString()).parentElement.removeChild(document.getElementById(id.toString()));
			
		}}
	};
	
	xmm.send(params);
	
}
function signup() {
	var un = document.getElementById("username").value;
	if (un == null){
		var t = document.createTextNode("username is empty");
		document.getElementById("usernamewarning").appendChild(t);
	}
	un = encodeURIComponent(un);
	var pass = document.getElementById("password").value;
	if (pass == null){
		var t = document.createTextNode("password is empty");
		document.getElementById("passwordwarning").appendChild(t);
	}
	pass = encodeURIComponent(pass);
		
	var params = "username=" + un + "&password=" + pass;
		
	var xm = new XMLHttpRequest();
		
	xm.open("POST", "signup.php?", true);
		
	xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
	xm.onreadystatechange = function(){
		if(xm.readyState == 4){
				
			var resp = JSON.parse(xm.responseText);
			if (resp.success == 1){
				var uid = resp.uid;
				var username = resp.username;
				window.location="data.php?uid=" + uid + "&username=" + username;
			}
			else{
				var t1 = document.createTextNode(resp.message);
				document.getElementById("warn").appendChild(t1);
			}
		}
	};
	xm.send(params);

}
function login(){
	var un = document.getElementById("username").value;
	if (un == null){
		var t = document.createTextNode("username is empty");
		document.getElementById("usernamewarning").appendChild(t);
	}
	un = encodeURIComponent(un);
	var pass = document.getElementById("password").value;
	if (pass == null){
		var t = document.createTextNode("password is empty");
		document.getElementById("passwordwarning").appendChild(t);
	}
	pass = encodeURIComponent(pass);
	
	var params = "username=" + un + "&password=" + pass;
	
	var xm = new XMLHttpRequest();
	
	xm.open("POST", "login.php?", true);
	
	xm.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	xm.onreadystatechange = function(){
		if(xm.readyState == 4){
			
			var resp = JSON.parse(xm.responseText);
			if (resp.success == 1){
				
				window.location = "data.php?username=" + resp.username + "&uid=" + resp.uid;
			}
			else{
				var t1 = document.createTextNode(resp.message);
				document.getElementById("warn").appendChild(t1);
			}
		}
	};
	xm.send(params);
}
