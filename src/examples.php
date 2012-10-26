<?php
// require the uptimeApi
require_once("uptimeApi.php");

// Setup uptime API variables
$uptime_api_username = "";
$uptime_api_password = "";
$uptime_api_hostname = "localhost";		// up.time Controller hostname (usually localhost, but not always)
$uptime_api_port = 9997;
$uptime_api_version = "v1";
$uptime_api_ssl = true;

// Create API object
$uptime_api = new uptimeApi($uptime_api_username, $uptime_api_password, $uptime_api_hostname, $uptime_api_port, $uptime_api_version, $uptime_api_ssl);

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
print_r($groups);
print_r($elements);
print_r($monitors);

print_r($groupStatus);
print_r($elementStatus);
print_r($monitorStatus);

print_r($groupsFiltered);
print_r($elementsFiltered);
print_r($monitorsFiltered);

print_r($errorMsg);

?>
