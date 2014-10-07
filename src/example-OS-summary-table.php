<?php
require 'uptimeApi.php';




// Start CSS page setup
print "<html><br><br>";
print "<head><style type \"text/css\">";
print "{font-family: Arial, Helvetica, sans-serif; width:90%; border-collapse:collapse; }";
print "table { margin: 1em; border-collapse: collapse; }";
print "td, th {font-size:.75em; font-weight:normal; width:200px; padding: 3px 7px 2px 7px; border: 1px solid #98bf21; }";
print "th {font-size:.75em; text-align:center; padding-top:5px; padding-bottom: 4px; background-color:#A7C942; color:#ffffff;}";
print "thead {background: #fc9; }";
print "h1 {font-family:Arial,Helvetica,sans-serif}"; 
print "</style></head>";


//setup the API connection
$uptime_api_username = "admin";
$uptime_api_password = "uptime";
$uptime_api_hostname = "localhost";     // up.time Controller hostname (usually localhost, but not always)
$uptime_api_port = 9997;
$uptime_api_version = "v1";
$uptime_api_ssl = true;


$uptime_api = new uptimeApi($uptime_api_username, $uptime_api_password, $uptime_api_hostname, $uptime_api_port, $uptime_api_version, $uptime_api_ssl);


//get the element details off the API
//just get actively monitored Server type elements
$elements = $uptime_api->getElements("type=Server&isMonitored=1");


//setup an array to store totals
$OStotals = array();

// Loop through the API results
foreach ($elements as $e)
{
    //filter out unknown elements
    if ($e['typeSubtype'] != "Unknown")
    {
        //lets refer to the typeOs as OS_Version to match our final table columns
        $os_version = $e['typeOs'];

        //check to see if we've seen this OS Version before
        if (array_key_exists($os_version , $OStotals)  )
        {
            //if we have just increase the count
            $OStotals[$os_version]['count'] += 1;
        }
        else
        {
            //if not, setup a new array to store typeSubtype & count
            $OStotals[$os_version] = array( 'type' => $e['typeSubtype'], 'count' => 1);
        }
    }
}

//sort the totals based on the os_version keys in the OStotals array
ksort($OStotals);


// Print header and begin the table for display
print "<body><p><center><h1><font color=\"olivedrab\" size=\"5\">OS Summary</font><br>";
print "<table><thead<tr><th>OS Type</th><th>OS Version</th><th>Count</th><tr></thead>";

//loop through the OStotals 
foreach ($OStotals as $os_version => $value) {
    print "<tr><td>" . $value['type'] . "</td><td>" . $os_version . "</td><td>" . $value['count'] . "</td></tr>";
}



// Close the table and end the webpage
print"</table>";
print "</html>";
?>
