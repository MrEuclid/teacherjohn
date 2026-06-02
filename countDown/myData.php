<div class = "row">
<div class = "col-md-12 c">
<h2>My Data</h2>
<h3>By rounds
</div></div>

<div class = "row">
<div class = "col-md-12 c">
<?php
include "../connectTempleDB.php" ;
$teamID = $_POST['teamID'] ;
// query to display
// round, phones, price, sold, income , expenses, balance
/*
SELECT phonePurchases.teamID,phonePurchases.roundNumber,sum(numberBought) , sellingPrice,numbersold, numberSold*sellingPrice
FROM phonePurchases
JOIN phoneSales
ON phonePurchases.teamID = phoneSales.teamID

AND phonePurchases.item = 'phone'
GROUP BY phonePurchases.roundNumber
*/

$query = "SELECT phonePurchases.teamID AS ID,
phonePurchases.roundNumber AS Round,
sum(numberBought) AS Bought, 
sellingPrice AS Price,
numbersold AS Sold, 
numberSold*sellingPrice AS Gross
FROM phonePurchases
CROSS JOIN phoneSales
ON phonePurchases.teamID = phoneSales.teamID
AND phonePurchases.roundNumber = phoneSales.roundNumber
AND phonePurchases.teamID = '$teamID'
AND phonePurchases.item = 'phone'

GROUP BY phonePurchases.teamID" ;

echo "<br>" . $query . "<br>" ;

include "includes/print_query_data_plain.php" ;

/*
$result = mysqli_query($dbServer,$query) ;
while ($data = mysqli_fetch_assoc($result)) 
{
    print_r($data) ;
    echo "<br>" ;
}
*/

?>
</div></div>