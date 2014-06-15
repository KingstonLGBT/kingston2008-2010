function checkemail(){
    		var email=document.getElementById('email').value
                document.getElementById("emailconfirm").value = email
                if ((email==null)||(email=="")){
                    alert("Please enter your e-mail address")
                  // showerror('Please enter your e-mail address');
                   //alert("returned")
                    return false
                }
                var at="@"
		var dot="."
		var lat=email.indexOf(at);
		var lstr=email.length
		var ldot=email.indexOf(dot);
		if (email.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
                   //showerror("Invalid E-mail ID")
		   return false
		}

		if (email.indexOf(at)==-1 || email.indexOf(at)==0 || email.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (email.indexOf(dot)==-1 || email.indexOf(dot)==0 || email.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (email.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (email.substring(lat-1,lat)==dot || email.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (email.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (email.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
                 if(document.mailinglist.security_code.value=="")
                 {
                    alert("You've not entered the security code.");
                    return false;
                 }
 		 return true
	}

function showerror(msg){
    alert("function run")
    if(msg == null)
        return false
    document.getElementById("error").innerHTML = msg;
    document.getElementById("error").style.visibility = 'visible';
    document.getElementById("error").style.width = 'auto';
}