<!DOCTYPE html>
<html lang = "en">
<body>
<?php 

main();

function main() {
    $json = getTopTen();
    $obj = json_decode($json);
    echo "<table><tbody>";
    echo '<tr><td>Country</td>
            <td>Confirmed Cases</td></tr>';
    foreach($obj as $country){
        echo '<tr><td>'.$country->Country.'</td>
            <td>'.$country->TotalConfirmed.'</td></tr>';
}
    echo '</tbody></table>';
}
function getTopTen() {
    $json = file_get_contents("https://api.covid19api.com/summary");
    $obj = json_decode($json);
    usort($obj->Countries,function($first,$second){
        return $first->TotalConfirmed < $second->TotalConfirmed;
    });
    $i = 0;
    $outObj = [];
    foreach($obj->Countries as $country){
        if($i == 10){
            break;
        }
        $i++;
        $outObj[] = $country;
    }
    return json_encode($outObj);
}
?>
</body>
</html>
