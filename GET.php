/*
 * Copyright 2022 Advanced Smart Technologies LLC.
 * http://a-smartech.com
 */

//Verfy Token Provided to ASTpos (Example only as hardcoded you can get tiken from DB and compare it with client provided token hash)
$clientToken= $_GET['token'];
$ServerToken= "eb636e98be40f97ffc20aa3835fcbb5f";
if ($clientToken!=$ServerToken){
  echo "Access Denied";
  die();
}



//database connection
$DBhost = "127.0.0.1";
$DBusername = "Ahmed123";
$DBpassword = "A7m3D12123";
$DBname = "DoobiOman";
$Connect = mysqli_connect($DBhost, $DBusername, $DBpassword,$DBname);
if (!isset($Connect)) {
    echo "Can not connect to DB";
    die();
}

//Set Database Character set as UTF-8 
mysqli_set_charset($Connect, 'utf8');
mysqli_query($Connect, "SET NAMES 'utf8'");
mysqli_query($Connect, 'SET CHARACTER SET utf8');

//Set page content type as JSON output
header("Content-Type: application/json;charset=utf-8");

//Read Database from Table "DoobiOrder"
$data = array();
$i=0;
$Show = mysqli_query($GLOBALS['Connect'], "SELECT * FROM `inventory_products`  WHERE product_code='" . $sku . "' and clientid=" . $_SESSION['clientid']);
    if (@mysqli_num_rows($Show) > 0) {
        while (@$Row = mysqli_fetch_array($Show, MYSQLI_ASSOC)) {
            $data[$i]['OrderID'] = $Row['OrderID'];
            $data[$i]['OredrDate'] = $Row['OredrDate'];
            $data[$i]['userId'] = $Row['userId'];
            $data[$i]['CartItem'] = $Row['CartItem'];
            $data[$i]['CartQuantity'] = $Row['CartQuantity'];
            $data[$i]['cartprice'] = $Row['cartprice'];
            $data[$i]['DatePickup'] = $Row['DatePickup'];
            $data[$i]['DateReturn'] = $Row['DateReturn'];
        }
    } else {
        $data['title'] = "Error ";
        $data['text'] = "No records found";
    }
echo json_encode($data);



