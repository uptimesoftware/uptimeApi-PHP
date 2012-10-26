uptimeApi-PHP
================

API helper class for up.time 7.1+ API. This makes using the up.time API simple and powerful.


Requirements
----------------
* extension=php_curl.dll

If testing on the up.time Monitoring Station (which already includes Apache+PHP with the necessary modules), simply edit the up.time php.ini file (uptime_dir/apache/php/php.ini) and uncomment the following lines:
* extension=php_curl.dll

Documentation
----------------
[http://docs.uptimesoftware.com/]

How to Use in PHP
-----------------
Have a look at the included example file.

First we import the uptimeApi class:

	require_once("uptimeApi.php");

Next we initialize the uptimeApi object:

	// Setup uptime API variables
	$uptime_api_username = "admin";
	$uptime_api_password = "admin";
	$uptime_api_hostname = "localhost";		// up.time Controller hostname (usually localhost, but not always)
	$uptime_api_port = 9997;
	$uptime_api_version = "v1";
	$uptime_api_ssl = true;

	// Create API object
	$uptime_api = new uptimeApi($uptime_api_username, $uptime_api_password, $uptime_api_hostname, $uptime_api_port, $uptime_api_version, $uptime_api_ssl);

Now we can call any of the uptimeApi functions and use/manipulate the returned array objects:

	// test auth
	$apiInfo = $uptime_api->getApiInfo();
	if ( $uptime_api->testAuth() ) {
		print "Successfully logged in";
	
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
		$groupsFiltered = $uptime_api->getGroups("name=My Infrastructure", $errorMsg);
		$elementsFiltered = $uptime_api->getElements("isMonitored=true", $errorMsg);
		$monitorsFiltered = $uptime_api->getMonitors("isMonitored=true&name=PING-.*", $errorMsg);
	}

Happy Coding!
