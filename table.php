<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Add Api Token here

$apitoken = "";

$url = 'https://dns.hetzner.com/api/v1/zones';
$options = array('http' => array(
    'method'  => 'GET',
    'header' => 'Auth-API-Token: '.$apitoken
));
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);


$json = json_decode($response);

//echo $response;

$zones = $json->{'zones'};

echo "<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th>ttl</th>
    <th>registrar</th>
    <th>status</th>
    <th>created</th>
    <th>modified</th>
    <th>verified</th>
    <th>project</th>
    <th>owner</th>
    <th>permission</th>
    <th>paused</th>
    <th>is secondary dns</th>
    <th>records count</th>
  </tr>";

foreach ($zones as &$value) {
	
	
		
    echo "  <tr>
    <td>" . $value->{'id'} . "</td> //zone id
    <td>" . $value->{'name'} . "</td> //domain
    <td>" . $value->{'ttl'} . "</td> //ttl
    <td>" . $value->{'registrar'} . "</td> //domain registar
    <td>" . $value->{'status'} . "</td> //domain status
    <td>" . $value->{'created'} . "</td> //when domain is created
    <td>" . $value->{'modified'} . "</td> //when domain is modified
    <td>" . $value->{'verified'} . "</td> //is domain verified
    <td>" . $value->{'project'} . "</td> //project
    <td>" . $value->{'owner'} . "</td> //owner
    <td>" . $value->{'permission'} . "</td> //permission
    <td>" . $value->{'paused'} . "</td> //is paused
    <td>" . $value->{'is_secondary_dns'} . "</td> //is secondary DNS?
    <td>" . $value->{'records_count'} . "</td> // DNS Records Count
  </tr>";
	
}

echo "</table>";

foreach ($zones as &$value) {
echo "<p>" . $value->{'name'} . "</p><table> 
  <tr>
    <th>legacy ns</th>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>ns</th>
    <th>1</th>
    <th>2</th>
    <th>3</th>
  </tr>";

	
	
		
    echo "  <tr>
   <td></td>
    <td>" . $value->{'legacy_ns'}[0] . "</td> //legacy nameserver 1
    <td>" . $value->{'legacy_ns'}[1] . "</td> //legacy nameserver 2
    <td>" . $value->{'legacy_ns'}[2] . "</td> //legacy nameserver 3
    <td></td>
    <td>" . $value->{'ns'}[0] . "</td> //nameserver 1
    <td>" . $value->{'ns'}[1] . "</td> //nameserver 2
    <td>" . $value->{'ns'}[2] . "</td> //nameserver 3
  </tr>";

echo "</table>";
}


?>

