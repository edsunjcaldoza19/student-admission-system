<?php

    include 'be/backup/backupModal.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

    $mysqlUserName = "root";
    $mysqlPassword = "";
    $mysqlHostName = "localhost";
    $DbName = "admission";
    $backup_name = "sais-db-backup.sql";

    if(isset($_POST['backup'])){

        //log this action

        $staff_id = $_POST['staff_id'];
        $staff_username = $_POST['staff_username'];
        $staff_role = 0;
        $log_description = 'Generated database backup file';
        $timestamp = date('m/d/Y, g:i:s A');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
        $conn->exec($sql2);

        Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName, $tables=false, $backup_name=false );

    }

    function Export_Database($host,$user,$pass,$name, $tables=false, $backup_name=false )
    {
        $mysqli = new mysqli($host,$user,$pass,$name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row())
        {
            $target_tables[] = $row[0];
        }
        if($tables !== false)
        {
            $target_tables = array_intersect( $target_tables, $tables);
        }
        foreach($target_tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);
            $fields_amount  =   $result->field_count;
            $rows_num=$mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0)
            {
                while($row = $result->fetch_row())
                { 
                    if ($st_counter%100 == 0 || $st_counter == 0 )
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)
                    {
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ;
                        }
                        else
                        {
                            $content .= '""';
                        }
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }
                    }
                    $content .=")";
                    
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
                    {
                        $content .= ";";
                    }
                    else
                    {
                        $content .= ",";
                    }
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }

        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        $date = date("Y-m-d");
        $backup_name = $backup_name ? $backup_name : $name.".$date.sql";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");
        echo $content; 
                header("location: ../../home.php");

        exit;
    }
?>