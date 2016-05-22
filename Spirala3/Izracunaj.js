var x=document.getElementsByClassName("datumobjave");
var ispisi=document.getElementsByClassName("datumi");
var z=document.getElementsByClassName("novostiDiv");
function racunaj(){
	var y=new Date();
	var razlika;
for (var i=0; i < x.length; i++) {
var datum=new Date(x[i].innerHTML);
razlika=Math.abs(y.getTime()-datum.getTime());
var sekunde;
sekunde=razlika/1000;
var n;
var brn;

	if(sekunde<60)
	{
		ispisi[i].innerHTML="Novost objavljena prije par sekundi";
		ispisi[i].style.display="block";
	}
	else if(sekunde>=60 && sekunde<3600)
	{
		n=sekunde/60;
		brn=Math.round(n);
		if((n<=2)||(n>21 && n<=22)||(n>31 && n<=32)||(n>41 && n<=42)||(n>51 && n<=52))
		{ispisi[i].innerHTML="Novost objavljena prije "+brn+" minutu";
		ispisi[i].style.display="block";}
		else if((n>2&&n<=5)||(n>22&&n<=25)||(n>32&&n<=35)||(n>42&&n<=45)||(n>52&&n<=55))
		{ispisi[i].innerHTML="Novost objavljena prije "+brn+" minute";
		ispisi[i].style.display="block";}
		else if((n>5&&n<=21)||(n>25&&n<=31)||(n>35&&n<=41)||(n>45&&n<=51)||(n>55&&n<=60))
		{ispisi[i].innerHTML="Novost objavljena prije "+brn+" minuta";
		ispisi[i].style.display="block";}
		
	}
	else if(sekunde>=3600 && sekunde<86400)
	{
		n=sekunde/3600;
		brn=Math.round(n);
		if((n<=2)||(n>21&&n<=22))
		{
			ispisi[i].innerHTML="Novost objavljena prije "+brn+" sat";
		    ispisi[i].style.display="block";
		}
		else if((n>2 && n<=4)||(n>22 && n<=24))
		{
			ispisi[i].innerHTML="Novost objavljena prije "+brn+" sata";
		    ispisi[i].style.display="block";
		}
		else if(n>5 && n<=24)
		{
			ispisi[i].innerHTML="Novost objavljena prije "+brn+" sati";
		    ispisi[i].style.display="block";
		}
		
    }
	else if(sekunde>=86400 && sekunde<604800)
	{
		n=sekunde/86400;
		brn=Math.round(n);
		if(brn==1)
		{ispisi[i].innerHTML="Novost objavljena prije 1 dan";
		ispisi[i].style.display="block";}
		else{
			 
			ispisi[i].innerHTML="Novost objavljena prije "+brn+" dana";
			ispisi[i].style.display="block";
		}
	
	}
	else if(sekunde>=604800 && sekunde<2592000)
	{
		n=sekunde/604800;
		brn=Math.round(n);
		if(brn==1)
		{
			ispisi[i].innerHTML="Novost objavljena prije 1 sedmicu";
			ispisi[i].style.display="block";
		}
		else
		{	
			ispisi[i].innerHTML="Novost objavljena "+brn+" sedmice.";
			ispisi[i].style.display="block";
		}
		
	}
	else
	{
		ispisi[i].innerHTML=datum;
		ispisi[i].style.display="block";
		
	}
}
}


function prikazi(vrijeme){

var dat=new Date();

if(vrijeme==1)
{
	for(var i=0; i<x.length;i++)
	{
		m=new Date(x[i].innerHTML);
		
		if(Math.abs(m.getMonth()-dat.getMonth())==0 && Math.abs(m.getFullYear()-dat.getFullYear())==0 && Math.abs(m.getDate()-dat.getDate())==0)
		{
			z[i].style.display="block";
		}
		else{
			z[i].style.display="none";
		}
	}
}
else if(vrijeme==2)
{
	for(var i=0; i<x.length;i++)
	{
		m=new Date(x[i].innerHTML);
		
		if(Math.abs(m.getMonth()-dat.getMonth())<=1 && Math.abs(m.getFullYear()-dat.getFullYear())==0 && (Math.abs(dat.getDate()-m.getDate())<7 || (dat.getDate()-m.getDate()>=-30 && dat.getDate()-m.getDate()<=-25)) && uIstojHefti(dat.getDay(),m.getDay())==true)
		{
			z[i].style.display="block";
		}
		else{
			z[i].style.display="none";
		}
	}
	

}
else if(vrijeme==3)
{ 	
	var m;
	for(var i=0; i<x.length;i++)
	{
		m=new Date(x[i].innerHTML);
		
		if(Math.abs(m.getMonth()-dat.getMonth())==0 && Math.abs(m.getFullYear()-dat.getFullYear())==0)
		{
			z[i].style.display="block";
		}
		else{
			z[i].style.display="none";
		}
	}
}
else
{
	for(var j=0;j<x.length;j++)
	{
			z[j].style.display="block";
		
	}
}
}

function uIstojHefti(dan1,dan2)
{
	if(dan1==0)
	{
		if(dan1-dan2>=-6 && dan1-dan2<=0)
		{
			return true;}
	else{alert(dan1);
		return false;}
	}
	if(dan1-dan2>=0 && dan1-dan2<=6)
		{
			return true;}
	else{
		return false;}

}