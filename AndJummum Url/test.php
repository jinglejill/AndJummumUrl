<?php
    
    $text = "modifiedUser=thidaporn.kijkamjai@gmail.com&userAccountID=1&lineID=&birthDate=1984-02-05 00:00:00  0000&deviceToken=5286f1867af1269a190ffba95b265cf5a806e35ef9cdd800f980423c581ea5db&password=882ef57e5df41a6c50be7ab7291305b332e46f18efd3be754ff543e4a1655f2d&fullName=thidaporn kijkamjai&nickName=&roleID=0&username=thidaporn.kijkamjai@gmail.com&phoneNo=0813072993&modifiedDate=2018-08-03 07:44:19  0000&email=thidaporn.kijkamjai@gmail.com&modifiedDeviceToken=5286f1867af1269a190ffba95b265cf5a806e35ef9cdd800f980423c581ea5db&actionScreen=create new account";
    
    foreach ($_GET as $param_name => $param_val)
    {
        $paramAndValue .= "$param_name = $param_val<br>";
        
    }
    
    echo $paramAndValue;
    
    
?>



username = thidaporn.kijkamjai@gmail.com
email = thidaporn.kijkamjai@gmail.com
password = 882ef57e5df41a6c50be7ab7291305b332e46f18efd3be754ff543e4a1655f2d
fullName = thidaporn kijkamjai
birthDate = 1984-02-05 00:00:00 0000
phoneNo = 0813072993
modifiedUser = thidaporn.kijkamjai@gmail.com
modifiedDate = 2018-08-03 07:44:19 0000
deviceToken = 5286f1867af1269a190ffba95b265cf5a806e35ef9cdd800f980423c581ea5db
modifiedDeviceToken = 5286f1867af1269a190ffba95b265cf5a806e35ef9cdd800f980423c581ea5db


3 อันนี้ค่าว่าง
userAccountId = ?
lineId = ?
roleId = ?


3 อันนี้ใช้ทุก post ค่ะ
modifiedDate = ?
modidiedDeviceToken = ?
actioncreen = ?


