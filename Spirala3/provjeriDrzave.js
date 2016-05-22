function provjeriDrzave()
{
	var n;
	var ajax = new XMLHttpRequest();
	var povratna;
	var broj;
	var regex="\+([0-9]*)\-";
	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
		{

			n= JSON.parse(ajax.responseText);;
			povratna=n[0]['callingCodes'];
			if(document.getElementById("Broj").value.length!=0)
			{	
				var brojcic=document.getElementById("Broj").value;
				var re=new RegExp("\\+"+povratna,"g");
					if(re.test(brojcic)==false)
					{
						document.getElementById("Broj").style.backgroundColor="red";
						document.getElementById("Postavi").innerHTML = "Pogreska-pozivni broj i drzava nisu odgovarajuci!";
						document.getElementById("Postavi").style.color="red";
					

					}
				else{
						document.getElementById("Broj").style.backgroundColor="white";
						document.getElementById("Postavi").innerHTML ="";
						document.getElementById("Drzava").style.backgroundColor="white";
					}

			}
			else
			{
				document.getElementById("Drzava").style.backgroundColor="white";
				document.getElementById("Broj").style.backgroundColor="white";
				document.getElementById("Postavi").innerHTML ="";
			}
		}
		if (ajax.readyState == 4 && ajax.status == 404)
			{document.getElementById("Postavi").innerHTML = "Greska: pogresan unos!";}
	}
	if(document.getElementById("Drzava").value.length!=0)
	{
	ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes="+document.getElementById("Drzava").value, true);
	ajax.send();
}
	
}
//kada napusti skracenicu pozvati
function provjeriBroj()
{


	var n;
	var ajax = new XMLHttpRequest();
	var povratna;
	var broj;
		
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
		{

			n= JSON.parse(ajax.responseText);;
			povratna=n[0]['callingCodes'];
			if(document.getElementById("Broj").value.length!=0)
			{	
				var brojcic=document.getElementById("Broj").value;
				var re=new RegExp("\\+"+povratna,"g");
					if(re.test(brojcic)==false)
					{
						document.getElementById("Drzava").style.backgroundColor="red";
						document.getElementById("Postavi").innerHTML = "Pogreska-pozivni broj i drzava nisu odgovarajuci!";
						document.getElementById("Postavi").style.color="red";
					

					}
				else{
						document.getElementById("Drzava").style.backgroundColor="white";
						document.getElementById("Broj").style.backgroundColor="white";
						document.getElementById("Postavi").innerHTML ="";
					}

			}
			else
			{
				document.getElementById("Drzava").style.backgroundColor="white";
				document.getElementById("Broj").style.backgroundColor="white";
				document.getElementById("Postavi").innerHTML ="";
			}
		}
		if (ajax.readyState == 4 && ajax.status == 404)
			{document.getElementById("Postavi").innerHTML = "Greska: pogresan unos!";}
	}
	if(document.getElementById("Drzava").value.length!=0)
	{
	ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes="+document.getElementById("Drzava").value, true);
	ajax.send();
}





}