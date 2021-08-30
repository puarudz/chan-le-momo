<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    foreach($CMSNT->get_list(" SELECT DISTINCT `partnerId` FROM `momo` ") as $row)
    {
        $total_money = $CMSNT->get_row(" SELECT SUM(`amount`) FROM `momo` WHERE `partnerId` = '".$row['partnerId']."' ")['SUM(`amount`)'];
        $partnerId = $row['partnerId'];
        if($CMSNT->get_row(" SELECT * FROM `bang_xep_hang` WHERE `sdt` = '".$row['partnerId']."' "))
        {
            $CMSNT->update('bang_xep_hang', [
                'amount' => $total_money
            ], " `sdt` = '".$row['partnerId']."' ");
        }
        else
        {
            $CMSNT->insert("bang_xep_hang", [
                'sdt'   => $partnerId,
                'amount'  => $total_money
            ]);
        }
    }