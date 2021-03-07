<?php

$url = "https://www.udemy.com/api-2.0/courses/?search=java";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

//HTTP username.
$clientID = 'bmV79MfQfAggfz3H48P1VgNcbmBd5JGlJBRX5KSl';
//HTTP password.
$clientSecret = 'OLO4AAWzs4wiw4UwFDmINXagweDTAg33roruncGnVV10eY3wvyjXiYpsdTsXFEGcxlsOHdxuGkY7i0Zztqc9jUTnnrITSobH09MtyQp85zvIiq4C9MsO9AL4hAVrCHwg';
//Create the headers array.
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic '. base64_encode("$clientID:$clientSecret")
);
//Set the headers that we want our cURL client to use.
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $result=curl_exec($ch);
    //echo curl_getinfo($ch, CURLINFO_HEADER_OUT);
   //echo curl_getinfo($ch,CURLINFO_HTTP_CODE);

    curl_close($ch);

    $json = json_decode($result, true);
    $results = $json['results'];
    

    $json = file_get_contents('udemy.json');
    $universityArray = json_decode($json, true);
    $json_result = $universityArray['results'];

?>
    <table class="table">
    <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Title</th>
    <th scope="col">URL</th>
    <th scope="col">Price</th>
    <th scope="col">Author</th>
    </tr>
    </thead>
<?php
    $allresults = [];
$id = 0;
foreach ($json_result as $json_results) {
    $allresults[] = $json_results;
    foreach ($allresults[$id]['visible_instructors'] as $display_names) {
        ?>
        <tbody>
        <tr>
        <th scope="row"><?php echo $id ?></th>
        <td><?php echo $title = $allresults[$id]['title'] ?></td>
        <td><?php echo $url = $allresults[$id]['url'] ?> </td>
        <td><?php echo $allresults[$id]['price'] ?> </td>
        <td><?php echo $display_names['display_name'] ?></td>
        </tr>
        </tbody>
        <?php
    }
    $id++;
} ?>
</table>
<?php