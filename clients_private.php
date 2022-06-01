<?php

session_start();
include_once __DIR__ . '/header.php';
//require __DIR__. '/my-functions.php';
//include __DIR__. ('/sql-queries.php');
include_once __DIR__ . '/connect.php';
include_once __DIR__ . '/Classes/Client.php';
include_once __DIR__ . '/Classes/ClientsList.php';

global $mysqlConnection;

# ****** initialisation de l'array catalog *******

$clientlist = getAllClients($mysqlConnection);
$ClientsList = new ClientsList($clientlist);

# ***** DISPLAY ******

echo '<div class="container-full row ptblr-5 d-flex justify-content-around">';
//var_dump($ClientsList);
?>
<table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>City</th>
        </tr>
        <?php foreach ($ClientsList as $clients) {
//            var_dump($clients);
            foreach ($clients as $client){
//    var_dump($Client);

    ?>
                    <tr>
                        <th><?php echo $client->getId() ?></th>
                        <td><?php echo $client->getFirstName() ?></td>
                        <td><?php echo $client->getLastName() ?></td>
                        <td><?php echo $client->getAddress() ?></td>
                        <td><?php echo $client->getZipCode() ?></td>
                        <td><?php echo $client->getCity() ?></td>
                    </tr>
                <?php }
        }

        ?> </table>

</div>
<?php
include 'footer.php';