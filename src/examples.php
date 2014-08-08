<?php
// require the uptimeApi
require_once("uptimeApi.php");

header('Content-type: text/plain');

// Setup uptime API variables
$uptime_api_username = "";
$uptime_api_password = "";
$uptime_api_hostname = "localhost";		// up.time Controller hostname (usually localhost, but not always)
$uptime_api_port = 9997;
$uptime_api_version = "v1";
$uptime_api_ssl = true;

// Create API object
$uptime_api = new uptimeApi($uptime_api_username, $uptime_api_password, $uptime_api_hostname, $uptime_api_port, $uptime_api_version, $uptime_api_ssl);

// test auth
$apiInfo = $uptime_api->getApiInfo();
if ( $uptime_api->testAuth() ) {
	print "Successfully logged in\n";
}

// get array objects
$groups = $uptime_api->getGroups();
$elements = $uptime_api->getElements();
$monitors = $uptime_api->getMonitors();

// get status of an object
$groupId = 1;
$elementId = 1;
$monitorId = 1;
$groupStatus = $uptime_api->getGroupStatus($groupId);
$elementStatus = $uptime_api->getElementStatus($elementId);
$monitorStatus = $uptime_api->getMonitorStatus($monitorId);

// use filters and/or error message (both are optional)
// filters will look at variables one level deep in the array
// they can accept multiple filters and are also regex compatible
$errorMsg = "";
$groupsFiltered = $uptime_api->getGroups("name=My Infrastructure", $errorMsg);
$elementsFiltered = $uptime_api->getElements("isMonitored=true", $errorMsg);
$monitorsFiltered = $uptime_api->getMonitors("isMonitored=true&name=PING-.*", $errorMsg);



// print all array objects
print_r($apiInfo);

print "\nGroups:\n";
print_r($groups);
print "\nElements:\n";
print_r($elements);
print "\nMonitors:\n";
print_r($monitors);

print "\nGroup Status:\n";
print_r($groupStatus);
print "\nElement Status:\n";
print_r($elementStatus);
print "\nMonitor Status:\n";
print_r($monitorStatus);

print "\nGroups Filtered:\n";
print_r($groupsFiltered);
print "\nElements Filtered:\n";
print_r($elementsFiltered);
print "\nMonitors Filtered:\n";
print_r($monitorsFiltered);

print "\nError Message:\n";
print_r($errorMsg);