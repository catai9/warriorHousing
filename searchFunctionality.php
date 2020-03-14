<?php

if (isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `Rental_Listing` WHERE Street_Name LIKE = '%".$valueToSearch."%'";
    $search_result =filterTable($query);
}
else{
    $query="Select * FROM `Rental_Listing`";
    $search_result =filterTable($query);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost","root","root","warrior_housing");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Functionality</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="searchFunctionality.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>Rental Listing ID</th>
                    <th>House Number</th>
                    <th>Street Name</th>
                    <th>City</th>
                    <th>Rent</th>
                    <th>Vacancies</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['Rental_Listing_ID'];?></td>
                    <td><?php echo $row['House_Number'];?></td>
                    <td><?php echo $row['Street_Name'];?></td>
                    <td><?php echo $row['City'];?></td>
                    <td><?php echo $row['Rent_Per_Person'];?></td>
                    <td><?php echo $row['Vacancies'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>