 $(document).ready(function(){

$("button#buy").click(function(){
var qid = $("#qid").val();
var uid=$("#uid").val();
var bal=$("#bal").val();
var lev = $("#lev").val();
if(qid)
{
  var x=confirm("Are You sure that you want to purchase?");
  if(x==true)
  {
	 $.ajax({
   type: "POST",
   url: "buy.php",
data: {
	     uid:uid,
		 qid:qid,
		 bal:bal
},
   success: function(html){  
if(html==1)    {
//$("#add_err").html("right username or password");
  alert("successfully purchased");
window.location="home.php";
}
else if(html==2)   {
alert("insufficient balance");
}

else if(html==3)   {
alert("Too slow. Someone already purchased it");
window.location="store.php?level="+lev;
}
else {
alert("error");
alert(html);
window.location="store.php?level="+lev;
}
   }
  });
return false; 
  }
}
});

});

