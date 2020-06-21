<?php

$re="";
function getTimezone(){
    
    $regions = array(
    'Africa' => DateTimeZone::AFRICA,
    'America' => DateTimeZone::AMERICA,
    'Antarctica' => DateTimeZone::ANTARCTICA,
    'Aisa' => DateTimeZone::ASIA,
    'Atlantic' => DateTimeZone::ATLANTIC,
    'Australia' => DateTimeZone::AUSTRALIA,
    'Europe' => DateTimeZone::EUROPE,
    'Indian' => DateTimeZone::INDIAN,
    'Pacific' => DateTimeZone::PACIFIC
);

$timezones = array();
foreach ($regions as $name => $mask)
{
    $zones = DateTimeZone::listIdentifiers($mask);
    foreach($zones as $timezone)
    {
		// Lets sample the time there right now
		$time = new DateTime(NULL, new DateTimeZone($timezone));

		// Us dumb Americans can't handle millitary time
		$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';

		// Remove region name and add a sample time
		$timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
	}
}
$str="";
			foreach($timezones as $region => $list)
{
	$str.= '<optgroup label="' . $region . '">' . "\n";
	foreach($list as $timezone => $name)
	{
		$str.= '<option value="' . $timezone . '">' . $name . '</option>' . "\n";
	}
	$str.= '<optgroup>' . "\n";
}
    
    return $str;
			
}

if(isset($_POST['submit'])){
    $date=$_POST['date'];
    $gtimezone=$_POST['timezone'];
    date_default_timezone_set($gtimezone);
    $newdate= strtotime($date);
    
    $re="<div class='alert alert-success'>Your new Time String is: <strong> $newdate </strong> and Timezone is: <strong>$gtimezone</strong></div>";
}



?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body>
    <div class="container">
        <?=$re?>
        <form method="post" class="form-horizontal" role="form">
            <fieldset>
                <legend>Test</legend>
                <div class="form-group">
                    <label for="dtp_input1" class="col-md-2 control-label">DateTime Picking</label>
                    <div class="input-group date form_datetime col-md-5" data-date-format="dd-mm-yyyy HH:ii p" data-link-field="dtp_input1">
                        <input class="form-control" name="date" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input1" value="" /><br />
                </div>
                <div class="form-group">
                    <label for="dtp_input2" class=" col-md-2 control-label">Time Zone:</label>
                    <div class="input-group col-md-5" data-link-field="dtp_input2">

                        <select class="form-control" name="timezone" id="timezone">
                            <?=getTimeZone()?>
                        </select>
                    </div>

                </div>
                <button class="btn btn-primary " name="submit" type="submit">Submit</button>
            </fieldset>
        </form>
    </div>

    <script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $('.form_date').datetimepicker({
            language: 'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $('.form_time').datetimepicker({
            language: 'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0
        });

    </script>

</body>

</html>
