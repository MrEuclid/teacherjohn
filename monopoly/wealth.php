<?php header("refresh: 5;");


include "../connectTempleDB.php";

// leader board
// based on cash + real estate value
$query = "SELECT a.game AS Game, a.team AS Team, cash, realty ,  (cash + realty) AS balance FROM
(SELECT team,game, SUM(amount) AS cash
         FROM transactions
        GROUP BY team,game) a
        
 INNER JOIN
 (
 SELECT team,game, SUM(purchasePrice) AS realty
         FROM propertyRegister
        GROUP BY team,game ) b
        
 ON (a.team = b.team AND a.game = b.game)

 AND substr(a.team,1,4) <> 'bank'
 
 ORDER BY a.game DESC, balance DESC " ;

 include "print_query_data_plain.php";
            
exit();


?>