// Eric Gullufsen
function add(id){
	var xmm1 = new XMLHttpRequest();
	xmm1.open("POST","add.php?",true);
	xmm1.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	var paramy = "id=" + id;
	xmm1.onreadystatechange = function(){
		if (xmm1.readyState == 4){
			var resp1 = JSON.parse(xmm1.responseText);
			if (resp1.added == 1){
				var row = document.createElement("tr");
				var td0 = document.createElement("td");
				var td1 = document.createElement("td");
				var playername = resp1.name;
				
				var text = document.createTextNode(playername);
				
				var inp = document.createElement("input");
				
				var upid = resp1.upid;
				row.setAttribute('id',upid);
				
				inp.setAttribute("type","button");
				var onclick = "drop(" + upid + ")";
				inp.setAttribute("onclick", onclick);
				
				td1.appendChild(inp);
				td0.appendChild(text);
				tr.appendChild(td0);
				tr.appendChile(td1);
				
				document.getElementById("players").appendChild(tr);
			
			}
		}
	};
	xmm1.send(paramy);
}

function filterplayers(){
	var w = new XMLHttpRequest();
	w.open("POST", "filterplayers.php",true);
	w.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	var select = document.getElementById("ddlplayers");
	var iddd = select.options[select.selectedIndex].value;
	var parami = "id=" + iddd;
	w.onreadystatechange = function(){
		if (w.readyState == 4){
			var respy = JSON.parse(w.responseText);
			
			var i = 0;
			while (respy[i]){
				var play = respy[i];
				var row = document.createElement("tr");
				var td0 = document.createElement("td");
				var td1 = document.createElement("td");
				var playername = play.name;
				
				var text = document.createTextNode(playername);
				
				var inp = document.createElement("input");
				
				var id = play.id;
				row.setAttribute('id',id);
				
				inp.setAttribute("type","button");
				var onclick = "add(" + id + ")";
				inp.setAttribute("onclick", onclick);
				
				td1.appendChild(inp);
				td0.appendChild(text);
				row.appendChild(td0);
				row.appendChild(td1);
				
				document.getElementById("filteredplayers").appendChild(row);
				
				i++;	
			}
			
			
		}
	};
	w.send(parami);
}

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
