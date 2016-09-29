<?php
$street="";
$city="";
$state="";
$states=array(""=>"Select state",
			"AL"=>"Alabama",
			"AK"=>"Alaska",
			"AZ"=>"Arizona",
			"AR"=>"Arkansas",
			"CA"=>"California",
			"CO"=>"Colorado",
			"CT"=>"Connecticut",
			"DE"=>"Delaware",
			"DC"=>"District of Columbia",
			"FL"=>"Florida",
			"GA"=>"Georgia",
			"HI"=>"Hawaii",
			"ID"=>"Idaho",
			"IL"=>"Illinois",
			"IN"=>"Indiana",
			"IA"=>"Iowa",
			"KS"=>"Kansas",
			"KY"=>"Kentucky",
			"LA"=>"Louisiana",
			"ME"=>"Maine",
			"MD"=>"Maryland",
			"MA"=>"Massachusetts",
			"MI"=>"Michigan",
			"MN"=>"Minnesota",
			"MS"=>"Mississippi",
			"MO"=>"Missouri",
			"MT"=>"Montana",
			"NE"=>"Nebraska",
			"NV"=>"Nevada",
			"NH"=>"New Hampshire",
			"NJ"=>"New Jersey",
			"NM"=>"New Mexico",
			"NY"=>"New York",
			"NC"=>"North Carolina",
			"ND"=>"North Dakota",
			"OH"=>"Ohio",
			"OK"=>"Oklahoma",
			"OR"=>"Oregon",
			"PA"=>"Pennsylvania",
			"RI"=>"Rhode Island",
			"SC"=>"South Carolina",
			"SD"=>"South Dakota",
			"TN"=>"Tennessee",
			"TX"=>"Texas",
			"UT"=>"Utah",
			"VT"=>"Vermont",
			"VA"=>"Virginia",
			"WA"=>"Wahington",
			"WV"=>"West Virginia",
			"WI"=>"Wisconsin",
			"WY"=>"Wyoming");
$unit="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weather Forecast</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
  <script src="http://openlayers.org/api/OpenLayers.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
  
  <style type="text/css">
		h2.FS {
			position: relative;
			text-align: center;
			top: 0px;
			left: 0px;
	}

		div.form {
			background-color:rgba(0,0,0,0.2);
			position: relative;
			margin: auto;
			padding: 10px;
			font-family: "Tahoma", Geneva, sans-serif;
			width: 90%;
	}
	
	#fcform label.error
	{
		color:red;
		display:block;
		font-size:15;
		text-align:left;
	}

		.row.no-gutters {
			margin-right: 0;
			margin-left: 0;
	}

		.row.no-gutters > [class^="col-"],
		.row.no-gutters > [class*=" col-"] {
			padding-right: 5px;
			padding-left: 5px;
	}
	
		div.all {
			align: center;
			width: 90%;
			margin: 0 auto;
			font-family: "Verdana", Geneva, sans-serif;
	}
	
		.centerData {
			text-align:center;
	}
	
		.tab2header {
			text-align:center;
			width:88%
			color:white;
			background-color:#0062B8;
			font-family: "Verdana", Geneva, sans-serif;
	}
		.nav-tabs>li>a {
  			background-color: #F8F8FF; 
  			border-color: #F8F8FF;
  			color:#2F70A8;
	}

		/* active tab color */
		.nav-tabs>li.active>a, 
		.nav-tabs>li.active>a:hover, 
		.nav-tabs>li.active>a:focus {
  			color: #fff;
  			background-color: #2F70A8;
  			border: 1px solid #F8F8FF;
	}

		/* hover tab color 
		.nav-tabs>li>a:hover {
  			border-color: #000000;
  			background-color: #111111;*/
}
	.error {
  			color: red;
  			font-family: "Verdana", Geneva, sans-serif;
		}
		
	div.tab3container
	{
		background-color:black;
		padding:20px;
		padding-left:50px;
		padding-right:50px;
		margin: 0 auto;
		text-align:center;
	}
	div.tab3tab0
	{
	background-color:#005ce6;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}
div.tab3tab1
	{
	background-color:#ff3333;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}


div.tab3tab2
	{
	background-color:#ff5b33;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}

div.tab3tab3
	{
	background-color:#77b300;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}

div.tab3tab4
	{
	background-color:#ac00e6;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}

div.tab3tab5
	{
	background-color:#ff9999;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}
div.tab3tab6
	{
	background-color:#ff3385;
	text-align:center;
	color:white;
	width:100px;
	font-size:12px;
	padding:5px;
	
	}



	</style>

</head>

<body style= "background-image: url(http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg); background-repeat: no-repeat; background-size: cover">

<script type="text/javascript">

	function clearForm() {
	
		document.getElementById("fcform").reset();
		var tbs=document.getElementById("tabs");
		if(tbs)
			tbs.parentNode.removeChild(tbs);
		var hdr=document.getElementById("header");
		if(hdr)
			hdr.parentNode.removeChild(hdr);
		var elements = fcform.elements;

		for(i=0; i<elements.length; i++) {

			field_type = elements[i].type.toLowerCase();

			switch(field_type) {

				case "text":
				case "hidden":

					elements[i].value = "";
					break;

				case "radio":
    
					if(elements[i].checked){
						elements[i].checked = false;
						document.forms["fcform"]["degree"].value="us"; 
			
					}     
					break;


				case "select-one":
					elements[i].selectedIndex = 0;
					break;

				default:
					break;
			}
		}
		
	}
	

$(document).ready(function(){
 $("#fcform").validate({
 rules:{street:{required:true},
		 city:{required:true},
		 state:{required:true}},
		 messages:{street:"Please enter a street",city:"Please enter a city",state:"Please enter the state"}});
$(tabs).hide();		 
$(fcform).submit(function(event){
 event.preventDefault();
 var street=$("#street").val();
 var city=$("#city").val();
 var state=$("#state option:selected").val();
 var degree=$("input[name=degree]:checked").val();
 $.ajax({ 
method: 'GET',
url: 'codeblue.php',
// this is the parameter list
data: { street: $("#street").val(), city: $("#city").val(), state:$("#state option:selected").val(),degree:$("input[name=degree]:checked").val()},
success: function(output) {
obj = jQuery.parseJSON(output);
//alert(obj);
$("#rightnow").html(displayTab1(obj,degree,street,city,state));
$("#next24hours").html(displayTab2(obj,degree,street,city,state));
$("#next7days").html(displayTab3(obj,degree,street,city,state));
$(tabs).show();	
},
error: function(){
alert("error");
}
});
});
});

function displayTab1(obj,degree,street,city,state)
{
	var tab1="<table class=\"table table-condensed\" style=\"width: 50%\">";
	tab1+="<tr bgcolor=\"#FF6E6E\"><td class=\"centerData\">"+obj['rightNow']['icon']+"</td><td class=\"centerData\" style=\"color: white\"><p><B>"+obj['rightNow']['summary']+"<br/><span style=\"font-size: 60px\">"+obj['rightNow']['temperature']+"<sup><span style=\"font-size: 20px\">"+obj['rightNow']['unit']+"</span></sup></span></B><br/><span style=\"color:blue\">L:"+obj['rightNow']['temperatureMin'] +"</span><span style=\"color:black\">|</span><span style=\"color:green\"> H:"+obj['rightNow']['temperatureMax'] +"</span></p></td>";
	tab1+="<tr bgcolor=\"#FFFFFF\"><td>Precipitation</td><td>"+obj['rightNow']['precipitation']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFE5E5\"><td>Chance of Rain</td><td>"+obj['rightNow']['chanceOfRain']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFFFFF\"><td>Wind Speed</td><td>"+obj['rightNow']['windSpeed']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFE5E5\"><td>Dew Point</td><td>"+obj['rightNow']['dewPoint']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFFFFF\"><td>Humidity</td><td>"+obj['rightNow']['humidity']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFE5E5\"><td>Visibility</td><td>"+obj['rightNow']['visibility']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFFFFF\"><td>Sunrise</td><td>"+obj['rightNow']['sunrise']+"</td></tr>";
	tab1+="<tr bgcolor=\"#FFE5E5\"><td>Sunset</td><td>"+obj['rightNow']['sunset']+"</td></tr>";
	tab1+="</table>";
	
	return tab1;
	
}


function displayTab2(obj,degree,street,city,state)
{
	//var i;
	var next24hours=obj['next24hours'];
	var tab2="";
	tab2+="<div class=\"row\">";
	tab2+="<div class=\"col-sm-12\">";
	tab2+="<table width=\"100%\" class=\"table-condensed\" style=\"background-color:white;\">";
	tab2+="<tr style=\"color:white; background-color:#2F70A8;\">";
	tab2+="<th class=\"col-sm-2\" style=\"text-align:center; padding:10px;\">Time</th>";
	tab2+="<th class=\"col-sm-2\" style=\"text-align:center; padding:10px;\">Summary</th>";
	tab2+="<th class=\"col-sm-2\" style=\"text-align:center;padding:10px;\">Cloud Cover</th>";
	tab2+="<th class=\"col-sm-2\" style=\"text-align:center;padding:10px;\">Temp("+obj['rightNow']['unit']+")</th>";
	tab2+="<th class=\"col-sm-2\" style=\"text-align:center;padding:10px;\">View Details</th>";
	tab2+="</tr>";
	for(i=0;i<next24hours.length;i++){
		
		tab2+="<tr style=\"color:black; background-color:#fff; margin:0 auto;\">";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center;\">"+next24hours[i]['time24h']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center;\">"+next24hours[i]['summary24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center;\">"+next24hours[i]['cloudCover24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center;\">"+next24hours[i]['temp24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center;\"><a data-toggle=\"collapse\" href=\"#collapseExample"+i+"\" aria-expanded=\"false\" aria-controls=\"collapseExample\"><span class=\"glyphicon glyphicon-plus\" style=\"color:#0062B8;\"></span></a>";
		tab2+="</tr>";

		tab2+="<tr><td>";
		tab2+="<table width=\"100%\" class=\"table collapse\" id=\"collapseExample"+i+"\" style=\"background-color:#f2f2f2;\">";
		
		tab2+="<tr class=\"panel panel-default\">";
		tab2+="<th class=\"col-sm-2\" style=\"text-align:center\">Wind</th>";
		tab2+="<th class=\"col-sm-2\" style=\"text-align:center\">Humidity</th>";
		tab2+="<th class=\"col-sm-2\" style=\"text-align:center\">Visibility</th>";
		tab2+="<th class=\"col-sm-2\" style=\"text-align:center\">Pressure</th>";
		tab2+="</tr>";
		
		tab2+="<tr>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center\">"+next24hours[i]['windSpeed24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center\">"+next24hours[i]['humidity24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center\">"+next24hours[i]['visibility24']+"</td>";
		tab2+="<td class=\"col-sm-2\" style=\"text-align:center\">"+next24hours[i]['pressure24']+"</td>";
		tab2+="</tr>";
		
		tab2+="</table>";
		tab2+="</td></tr>";
	
	}
	tab2+="</table></div></div>";
	return tab2;
}

function displayTab3(obj,degree,street,city,state)
{	
	var i;
	var next7days=obj['next7days'];
	var tab3="<div class=\"row tab3container col-sm-12\">";
	for(i=0;i<next7days.length;i++)
	{
	tab3+="<div class=\"well tab3tab"+i+" col-sm-2\">";
	tab3+="<p><B>"+next7days[i]['day']+"</br>"+next7days[i]['monthsdate']+"</B><br/>"+next7days[i]['icon']+"<br/>Min<br/>Temp<br/><span style=\"font-size:20px;\"><B>"+next7days[i]['tempMin']+"</B></span><br/>Max<br/> Temp<br/><span style=\"font-size:20px;\"><B>"+next7days[i]['tempMax']+"</B></span></p>";
	tab3+="</div>";
	}
	tab3+="</div>";
	return tab3;
} 
</script>

<div class="container-fluid">.

  <h2 class="FS">Forecast Search</h2>
  
  <div class="form">
  <form role="form" name="fcform" id="fcform" method="GET">
  <input type="hidden" name="send" value="search" />
  <div class="row no-gutters">
  
    <div class="col-md-4">
	<div class="form-group">
      <label for="Street"><span style="color:white">Street Address:</span><span style="color:red">*</span></label>
      <input type="text" class="form-control" id="street" placeholder="Enter street address" name="street" align="left" value="<?php echo isset($_GET['send']) ? $_GET['street'] : ''; ?>" required />
    </div>
	</div>
	
    <div class="col-md-2">
	<div class="form-group">
      <label for="City"><span style="color:white">City:</span><span style="color:red">*</span></label>
      <input type="text" class="form-control" id="city" placeholder="Enter the city name" name="city" value="<?php echo isset($_GET['send']) ? $_GET['city'] : ''; ?>" required />
    </div>
	</div>
	
    <div class="col-md-2">
	<div class="form-group">
	<label for="State"><span style="color:white">State:</span><span style="color:red">*</span></label>
      <select class="form-control" id="state" name="state">
        <?php
		foreach($states as $id=>$chosen){
			if(isset($_GET['state']) && ($_GET['state']==$id)){
			$sel='selected="selected"'; }
				else {
					$sel='';
				}
				echo "<option $sel value='$id'>$chosen</option>";
			}
		?>
      </select>
	</div>
	</div>
	
	<div class="col-md-2">
	<div class="form-group">
	<br/>
	<span style="color:white"><B>Degree:</B></span><span style="color:red">*</span><br/>
	<label class="radio-inline">
      <input type="radio" id="default" name="degree" value="us" <?php echo (((isset($_POST["degree"])) && ($_POST["degree"]=="us")))? 'checked':'unchecked'; ?> align="left" checked /><span style="color:white">Fahrenheit</span>
    </label>
    <label class="radio-inline">
      <input type="radio" name="degree" align="left" value="si" <?php echo (((isset($_POST["degree"])) && ($_POST["degree"]=="si")))? 'checked':'unchecked' ; ?> /><span style="color:white">Celsius</span>
    </label>
	</div>
	</div>
	
    <div class="col-md-2" style="text-align: right">
	<div class="form-group">
	<label for="Buttons"></label><br/>
	
	<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search" align="left"><span class="glyphicon glyphicon-search"></span> Search</button>
	<button type="button" class="btn btn-default btn-sm" name="clear" value="Clear" align="left" onClick="clearForm()" ><span class="glyphicon glyphicon-refresh"></span> Clear</button>
		</div>
	</div>

	<div class="row no-gutters">

	<div class="col-md-12">
	<div class="form-group">
	<p style="text-align: right">
	<span style="color:white"><B>Powered by:</B></span>
	<a href="http://forecast.io/"><img src= "http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png" alt="FORECAST.IO" title="FORECAST.IO" align="middle" width="10%" height="10%"/></a>
	</p>
	</div>
	</div>
	</div>

	</div>	
	</div>

	</form> 
 
 <span style="color:white"><hr width="90%"></span>
 
<div class="all" id="tabs">

   <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#rightnow" aria-controls="rightnow" role="tab" data-toggle="tab">Right Now</a></li>
    <li role="presentation"><a href="#next24hours" aria-controls="next24hours" role="tab" data-toggle="tab">Next 24 Hours</a></li>
    <li role="presentation"><a href="#next7days" aria-controls="next7days" role="tab" data-toggle="tab">Next 7 Days</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="rightnow"></div>
    <div role="tabpanel" class="tab-pane" id="next24hours"></div>
    <div role="tabpanel" class="tab-pane" id="next7days"></div>
  </div>

</div>
 </div>
 </noscript>
</body>
</html>