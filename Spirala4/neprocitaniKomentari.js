function provjeriKomentare(autor)
{
	var komentari;
	var ajax = new XMLHttpRequest();
	var recenica=""; 
	window.setInterval(s=function(){ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			recenica="";
			komentari= JSON.parse(ajax.responseText);
			document.getElementById("Neprocitani").innerHTML=" ";
			var j;
			for(var i=0; i<komentari.length;i++)
			{
				var brojac=1;
				for(j=i;j<komentari.length;j++)
				{
					if(j==komentari.length-1)break;
					if(komentari[j]['Naslov']==komentari[j+1]['Naslov'])
					{
						brojac++;
					}
					else
					{
						break;
					}
				}
				recenica=recenica+"   {"+komentari[i]['Naslov']+"}  nepročitanih komentara:  "+brojac+"  ";		
				i=j;
			}
			document.getElementById("Neprocitani").innerHTML=recenica;
		if (ajax.readyState == 4 && ajax.status == 404)
			{document.getElementById("Neprocitani").innerHTML = "Greska!";}
	}
	};
	ajax.open("GET", "notifications.php?autor="+autor, true);
	ajax.send();},30000);

}