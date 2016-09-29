<?php

//$street=$_GET["street"];
$street="720 W 27th";
$xstreet = str_replace(' ', '+', $street);

//$city=$_GET["city"];
$city="Los Angeles";
$xcity = str_replace(' ', '+', $city);

//$state=$_GET["state"];
$state="CA";
$xstate = str_replace(' ', '+', $state);

//$unit=$_GET["degree"];
$unit="us";

$apikey_1="AIzaSyBSLS1UHe8q_35z_-fxsf6t79jXc2TqDbM";
$xmlurl="https://maps.googleapis.com/maps/api/geocode/xml?address=".$xstreet.",".$xcity.",".$xstate."&key=".$apikey_1;
$xml=simplexml_load_file($xmlurl);
$status=$xml->status;
if($status!="ZERO_RESULTS")
{	
//print_r($xml);
$lat=$xml->result->geometry->location->lat;
$lng=$xml->result->geometry->location->lng;
//print_r($lat);
//print_r($lng);
$apikey_2="9381b17ecab17f44f9c9653fbec49b24";
$jsonurl="https://api.forecast.io/forecast/".$apikey_2."/".$lat.",".$lng."?units=".$unit."&exclude=flags";
$json=json_decode(file_get_contents($jsonurl));
date_default_timezone_set($json->timezone);
}
else 
{
$msg="Invalid address";
echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}

function rightNow($json,$unit,$city,$state)
{
	date_default_timezone_set($json->timezone);
	$summary=$json->currently->summary;
	$temp=$json->currently->temperature;
	$temp_min=$json->daily->data[0]->temperatureMin;
	$temp_max=$json->daily->data[0]->temperatureMax;
	$rain=$json->currently->precipProbability;
	$rain_per=($rain*100)."%";
	$wind_speed=$json->currently->windSpeed;
	$dew_pt=$json->currently->dewPoint;
	$dew_dec=round($dew_pt,2);
	$humidity=$json->currently->humidity;
	
	if(isset($json->currently->visibility))
	{
	$visibility=$json->currently->visibility;
	if($unit="us")
		{$visibility_unit=(intval($visibility))." mi";}
	else
		{$visibility_unit=(intval($visibility))." km";}
	}
	else
	{
	$visibility_unit="NA";
	}
	$sunrise=$json->daily->data[0]->sunriseTime;
	$sunrise_time=date("h:i A",$sunrise);
	$sunset=$json->daily->data[0]->sunsetTime;
	$sunset_time=date("h:i A",$sunset);
	$pI=$json->currently->precipIntensity;
	$icon=$json->currently->icon;
if($icon=="clear-day")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear.png\" alt=\"clear-day\" title=\"clear-day\" width=\"150px\" height=\"150px\">";
$iconname="clear";}
if($icon=="clear-night")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png\" alt=\"clear-night\" title=\"clear-night\" width=\"150px\" height=\"150px\">";
$iconname="clear_night";}
if($icon=="rain")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/rain.png\" alt=\"rain\" title=\"rain\" width=\"150px\" height=\"150px\">";
$iconname="rain";}

if($icon=="snow")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/snow.png\" alt=\"snow\" title=\"snow\" width=\"150px\" height=\"150px\">";
$iconname="snow";}

if($icon=="sleet")	
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png\" alt=\"sleet\" title=\"sleet\" width=\"150px\" height=\"150px\">";
$iconname="sleet";}
if($icon=="wind")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/wind.png\" alt=\"wind\" title=\"wind\" width=\"150px\" height=\"150px\">";
$iconname="wind";}
if($icon=="fog")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/fog.png\" alt=\"fog\" title=\"fog\" width=\"150px\" height=\"150px\">";
$iconname="fog";}
if($icon=="cloudy")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png\" alt=\"cloudy\" title=\"cloudy\" width=\"150px\" height=\"150px\">";
$iconname="cloudy";}
if($icon=="storm")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw6/images/Storm.png\" alt=\"storm\" title=\"storm\" width=\"150px\" height=\"150px\">";
$iconname="Storm";}
if($icon=="partly-cloudy-day")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png\" alt=\"partly-cloudy-day\" title=\"partly-cloudy-day\" width=\"150px\" height=\"150px\">";
$iconname="cloud_day";}
if($icon=="partly-cloudy-night")
{$icon_img="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png\" alt=\"partly-cloudy-night\" title=\"partly-cloudy-night\" width=\"150px\" height=\"150px\">";
$iconname="cloud_night";}



if($unit=="us")
{
$temp_int_unit=(intval($temp));
$dew_pt_dec=$dew_dec."&degF";
$wind_speed_unit=(intval($wind_speed))." mph";
$temp_unit="&degF";
if($pI>=0 && $pI<0.002)
	$pIvalue="None";
if($pI>=0.002 && $pI<0.017)
	$pIvalue="Very Light";
if($pI>=0.017 && $pI<0.1)
	$pIvalue="Light";
if($pI>=0.1 && $pI<0.4)
	$pIvalue="Moderate";
if($pI>=0.4)
	$pIvalue="Heavy";
}
else
{
$temp_int_unit=(intval($temp));
$dew_pt_dec=$dew_dec."&degC";
$wind_speed_unit=(intval($wind_speed))." m/s";
$temp_unit="&degC";

if($pI>=0 && $pI<0.0508)
	$pIvalue="None";
if($pI>=0.0508 && $pI<0.4318)
	$pIvalue="Very Light";
if($pI>=0.4318 && $pI<2.54)
	$pIvalue="Light";
if($pI>=2.54 && $pI<10.16)
	$pIvalue="Moderate";
if($pI>=10.16)
	$pIvalue="Heavy";	
}

$right_now = array();
	 $right_now['summary']=$summary." in ".$city.", ".$state;
	 $right_now['icon']=$icon_img;
	 $right_now['temperature']=$temp_int_unit;
	 $right_now['unit']=$temp_unit;
	 $right_now['temperatureMin']=(intval($temp_min))."&deg";
	 $right_now['temperatureMax']=(intval($temp_max))."&deg";
	 $right_now['precipitation']=$pIvalue;
	 $right_now['chanceOfRain']=$rain_per=($rain*100)."%";
	 $right_now['windSpeed']=$wind_speed_unit;
	 $right_now['dewPoint']=$dew_pt_dec;
	 $right_now['humidity']=($humidity*100)."%";
	 $right_now['visibility']=$visibility_unit;
	 $right_now['sunrise']=$sunrise_time;
	 $right_now ['sunset']=$sunset_time;
	 $right_now['iconname']=$iconname;
echo $right_now['iconname'];
return $right_now;

}

$tab1=array();
$tab1=rightNow($json,$unit,$city,$state);
function next24hours($json,$path,$unit)
{
	
	$time_24h=$path->time;
	$summary_24=$path->icon;
if($summary_24=="clear-day")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear.png\" alt=\"clear-day\" title=\"clear-day\" width=\"50px\" height=\"50px\">";
if($summary_24=="clear-night")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png\" alt=\"clear-night\" title=\"clear-night\" width=\"50px\" height=\"50px\">";
if($summary_24=="rain")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/rain.png\" alt=\"rain\" title=\"rain\" width=\"50px\" height=\"50px\">";
if($summary_24=="snow")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/snow.png\" alt=\"snow\" title=\"snow\" width=\"50px\" height=\"50px\">";
if($summary_24=="sleet")	
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png\" alt=\"sleet\" title=\"sleet\" width=\"50px\" height=\"50px\">";
if($summary_24=="wind")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/wind.png\" alt=\"wind\" title=\"wind\" width=\"50px\" height=\"50px\">";
if($summary_24=="fog")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/fog.png\" alt=\"fog\" title=\"fog\" width=\"50px\" height=\"50px\">";
if($summary_24=="cloudy")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png\" alt=\"cloudy\" title=\"cloudy\" width=\"50px\" height=\"50px\">";
if($summary_24=="storm")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw6/images/Storm.png\" alt=\"storm\" title=\"storm\" width=\"50px\" height=\"50px\">";
if($summary_24=="partly-cloudy-day")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png\" alt=\"partly-cloudy-day\" title=\"partly-cloudy-day\" width=\"50px\" height=\"50px\">";
if($summary_24=="partly-cloudy-night")
	$summary_24_icon="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png\" alt=\"partly-cloudy-night\" title=\"partly-cloudy-night\" width=\"50px\" height=\"50px\">";
$cloudCover_24h=$path->cloudCover;
$temp_24h=$path->temperature;
$temp_24h_dec=(round($temp_24h,2));
$wind_24h=$path->windSpeed;
$humidity_24h=$path->humidity;

if(isset($path->visibility))
	{
	$visibility_24h=$json->currently->visibility;
	if($unit="us")
		{$visibility_unit_24h=(intval($visibility_24h))." mi";}
	else
		{$visibility_unit_24h=(intval($visibility_24h))." km";}
	}
	else
	{
	$visibility_unit_24h="NA";
	}

$pressure_24h=$path->pressure;
if($unit=="us")
{
$wind_speed_24h=(intval($wind_24h))." mph";
$pressure_unit_24h=(intval($pressure_24h))." mb";
}
else
{
$wind_speed_24h=(intval($wind_24h))." m/s";

$pressure_unit_24h=(intval($pressure_24h))." hPa";
}
	$next_24hours=array();
	$next_24hours['time24h']=date("h:i A",$time_24h);
	$next_24hours['summary24']=$summary_24_icon;
	$next_24hours['cloudCover24']=(intval($cloudCover_24h))."%";
	$next_24hours['temp24']=$temp_24h_dec;
	$next_24hours['windSpeed24']=$wind_speed_24h;
	$next_24hours['humidity24']=(intval($humidity_24h))."%";
	$next_24hours['visibility24']=$visibility_unit_24h;
	$next_24hours['pressure24']=$pressure_unit_24h;
	
	
	return $next_24hours;
}
$tab2=array();
for($i=1;$i<=24;$i++){
	array_push($tab2,next24hours($json,$json->hourly->data[$i],$unit));
}
function next7days($json,$path,$unit,$city)
{
	$day=$path->time;
	$month_date=$path->time;
	$icon_img_7=$path->icon;
	if($icon_img_7=="clear-day")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear.png\" alt=\"clear-day\" title=\"clear-day\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="clear-night")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png\" alt=\"clear-night\" title=\"clear-night\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="rain")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/rain.png\" alt=\"rain\" title=\"rain\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="snow")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/snow.png\" alt=\"snow\" title=\"snow\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="sleet")	
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png\" alt=\"sleet\" title=\"sleet\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="wind")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/wind.png\" alt=\"wind\" title=\"wind\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="fog")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/fog.png\" alt=\"fog\" title=\"fog\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="cloudy")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png\" alt=\"cloudy\" title=\"cloudy\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="storm")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw6/images/Storm.png\" alt=\"storm\" title=\"storm\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="partly-cloudy-day")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png\" alt=\"partly-cloudy-day\" title=\"partly-cloudy-day\" width=\"50px\" height=\"50px\">";
if($icon_img_7=="partly-cloudy-night")
	$icon7="<img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png\" alt=\"partly-cloudy-night\" title=\"partly-cloudy-night\" width=\"50px\" height=\"50px\">";
	$temp_min_7=$path->temperatureMin;
	$temp_max_7=$path->temperatureMax;
	$temp_min_7_unit=(intval($temp_min_7))."&deg";
	$temp_max_7_unit=(intval($temp_max_7))."&deg";
	$summary_7=$path->summary;
	$month_date_7=date("M j",$month_date);
	$sunrise_7=$path->sunriseTime;
	$sunrise_7_format=date("h:i A",$sunrise_7);
	$sunset_7=$path->sunsetTime;
	$sunset_7_format=date("h:i A",$sunset_7);
	$humidity_7=$path->humidity;
	$wind_7=$path->windSpeed;
	
if(isset($path->visibility))
	{
	$visibility_7=$json->currently->visibility;
	if($unit="us")
		{$visibility_unit_7=(intval($visibility_7))." mi";}
	else
		{$visibility_unit_7=(intval($visibility_7))." km";}
	}
	else
	{
	$visibility_unit_7="NA";
	}

	$pressure_7=$path->pressure;
	$day_7=date("l",$day);
if($unit=="us")
{
$wind_speed_7=(intval($wind_7))." mph";

$pressure_unit_7=(intval($pressure_7))." mb";
}
else
{
$wind_speed_7=(intval($wind_7))." m/s";

$pressure_unit_7=(intval($pressure_7))." hPa";
}



	$next_7days=array();
	$next_7days['day']=$day_7;
	$next_7days['monthsdate']=$month_date_7;
	$next_7days['icon']=$icon7;
	$next_7days['tempMin']=$temp_min_7_unit;
	$next_7days['tempMax']=$temp_max_7_unit;
	$next_7days['header']="Weather in ".$city." on ".$month_date_7;
	$next_7days['summaryonday']=$day_7.":".$summary_7;
	$next_7days['sunrise']=$sunrise_7_format;
	$next_7days['sunset']=$sunset_7_format;
	$next_7days['humidity']=(intval($humidity_7))."%";
	$next_7days['windSpeed']=$wind_speed_7;
	$next_7days['visibility']=$visibility_unit_7;
	$next_7days['pressure']=$pressure_unit_7;

	return $next_7days;
}
$tab3=array();
for($i=1;$i<=7;$i++){
	array_push($tab3,next7days($json,$json->daily->data[$i],$unit,$city));
}
$forecastResults=array();
$forecastResults['rightNow']=$tab1;
$forecastResults['next24hours']=$tab2;
$forecastResults['next7days']=$tab3;
$searchResults=json_encode($forecastResults);
echo $searchResults;
?>