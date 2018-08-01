<?php
    include_once("dbConnect.php");
    setConnectionValue($_POST["dbName"]);
    writeToLog("file: " . basename(__FILE__) . ", user: " . $_POST["modifiedUser"]);
    printAllPost();
    ini_set("memory_limit","-1");
    

    
    
    
    
    if(isset($_POST["memberID"]) && isset($_POST["modifiedDate"]))
    {
        $memberID = $_POST["memberID"];
        $modifiedDate = $_POST["modifiedDate"];
//        $receiptDate = $_POST["receiptDate"];
    }
    
    
    
    
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    
    $sql = "select * from receipt where memberID = '$memberID' and modifiedDate > '$modifiedDate';";
    $selectedRow = getSelectedRow($sql);
    for($i=0; $i<sizeof($selectedRow); $i++)
    {
        if($i == 0)
        {
            $receiptWithMinReceiptDate = $selectedRow[$i]["ReceiptDate"];
        }
        else
        {
            $receiptDate = $selectedRow[$i]["ReceiptDate"];
            if($receiptDate < $receiptWithMinReceiptDate)
            {
                $receiptWithMinReceiptDate = $receiptDate;
            }
        }
    }
    
    if($receiptWithMinReceiptDate)
    {
        $sql = "select * from receipt where receiptDate >= '$receiptWithMinReceiptDate';";
        $sql .= "select * from OrderTaking where receiptID in (select receiptID from receipt where receiptDate >= '$receiptWithMinReceiptDate');";
        $sql .= "select * from OrderNote where orderTakingID in (select orderTakingID from OrderTaking where receiptID in (select receiptID from receipt where receiptDate >= '$receiptWithMinReceiptDate'));";
        
        
        
        //menu
        $sql3 = "select * from OrderTaking where receiptID in (select receiptID from receipt where receiptDate >= '$receiptWithMinReceiptDate');";
        $selectedRow = getSelectedRow($sql3);
        if(sizeof($selectedRow)>0)
        {
            $menuID = $selectedRow[0]["MenuID"];
            $branchID = $selectedRow[0]["BranchID"];
            $sql2 = "select * from AND_JUMMUM_OM.branch where branchID = '$branchID'";
            $selectedRow2 = getSelectedRow($sql2);
            $eachDbName = $selectedRow2[0]["DbName"];
            $sql4 = "select '$branchID' BranchID, Menu.* from $eachDbName.Menu where menuID = '$menuID'";
            for($i=1; $i<sizeof($selectedRow); $i++)
            {
                $menuID = $selectedRow[$i]["MenuID"];
                $branchID = $selectedRow[$i]["BranchID"];
                $sql2 = "select * from AND_JUMMUM_OM.branch where branchID = '$branchID'";
                $selectedRow2 = getSelectedRow($sql2);
                $eachDbName = $selectedRow2[0]["DbName"];
                $sql4 .= " union select '$branchID' BranchID, Menu.* from $eachDbName.Menu where menuID = '$menuID'";
            }
        }
        
        $sql .= $sql4;
    }
    else
    {
        $sql = "select * from receipt where 0";
        $sql .= "select * from orderTaking where 0";
        $sql .= "select * from orderNote where 0";
        $sql .= "select * from menu where 0";
    }
    
    
    
    
    
    
    
    
    
    
    
    /* execute multi query */
    $jsonEncode = executeMultiQuery($sql);
    echo $jsonEncode;


    
    // Close connections
    mysqli_close($con);
    
?>
