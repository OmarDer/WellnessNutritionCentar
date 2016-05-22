var tacnoM=false;
var tacnoT=false;
function validateEmail() 
{
    var re = /\S+@\S+\.\S+/;
    var mail=document.getElementById('email').value;
    var ma=document.getElementById('email');
    if(re.test(mail)==true)
    {
    	ma.style.backgroundColor="white";
    }
    else
    {
    	ma.style.backgroundColor="darkred";
    }

    
}
function validateIme()
{

 var testSlova=/^[a-zA-Z]+(-[a-zA-Z]+)*$/;
 var name=document.getElementById('fname').value;
 var im=document.getElementById('fname');

    if(testSlova.test(name)==true)
    {
    	im.style.backgroundColor="white";
    }
    else{
    	im.style.backgroundColor="darkred";
    }
    
}

function validatePrezime()
{

var testSlova=/^[a-zA-Z]+(-[a-zA-Z]+)*$/;	
var surname=document.getElementById('lname');
if(testSlova.test(surname.value)==true)
    {
    	surname.style.backgroundColor="white";
    }
    else{
    	surname.style.backgroundColor="darkred";
    }

}

function validateBroj()
{
	var regex=/^387\d{8,9}$/;
	var broj=document.getElementById('usrtel');
	if(regex.test(broj.value)==true)
    {
    	broj.style.backgroundColor="white";
    	tacnoT=true;
    }
    else{
    	broj.style.backgroundColor="darkred";
    }

} 
function crossValidation(){
	var broj=document.getElementById('usrtel');
	var mail=document.getElementById('email');
	var dugme=document.getElementById('pritisni');	
	if(mail.value.length==0 && broj.value.length==0||(document.getElementById('email').style.backgroundColor=="darkred" && document.getElementById('usrtel').style.backgroundColor=="darkred"))
	{
		document.getElementById('poruka').style.display="block";
	}
	else{
		document.getElementById('poruka').style.display="none";
	}
}
function pomoc(){
	alert("Format broja je 387xxxxxxxx ili 387xxxxxxxxx")
}