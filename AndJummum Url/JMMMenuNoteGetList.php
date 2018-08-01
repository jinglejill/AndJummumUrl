<?php
    include_once("dbConnect.php");
    setConnectionValue($_POST["dbNameBranch"]);
    writeToLog("file: " . basename(__FILE__) . ", user: " . $_POST["modifiedUser"]);
    printAllPost();
    ini_set("memory_limit","-1");
    $dbNameBranch = $_POST["dbNameBranch"];
    
    
    
    if(isset($_POST["menuID"]))
    {
        $menuID = $_POST["menuID"];
    }
    
    
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    
    
    
    
    
    //check if use mainBranch menu or own menu
    $sql = "select * from AND_JUMMUM_OM.branch where dbName = '$dbNameBranch'";
    $selectedRow = getSelectedRow($sql);
    if($selectedRow[0]["BranchID"] != $selectedRow[0]["MainBranchID"])
    {
        $mainBranchID = $selectedRow[0]["MainBranchID"];
        $sql = "select * from AND_JUMMUM_OM.branch where branchID = '$mainBranchID'";
        $selectedRow = getSelectedRow($sql);
        $dbNameBranch = $selectedRow[0]["DbName"];
    }
    
    
//    $sql = "select 1, menuNote.* from menuNote where 1 union select 2, menuNote.* from menuNote where 1 union select 3, menuNote.* from menuNote where 1 union select 4, menuNote.* from menuNote where 1 union select 5, menuNote.* from menuNote where 1;";
    $sql = "select * from $dbNameBranch.menuNote where menuID = '$menuID';";
    
    
    
    
    /* execute multi query */
    $jsonEncode = executeMultiQuery($sql);
    echo $jsonEncode;


    
    // Close connections
    mysqli_close($con);
    
?>
