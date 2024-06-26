<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER['REQUEST_METHOD']=='GET'){

    if(($_GET['type']??'') == 'multiple_delete'){
        $ids = $_GET['ids'];
        // print_r($ids[0]); exit;
        try{
            for($i=0; $i<count($ids); $i++){
                $id = $ids[$i];
                $sql = "DELETE `pages`
                FROM `pages`
                LEFT JOIN `page_seo` ON `pages`.`page_id` = `page_seo`.`page_id`
                WHERE `pages`.`page_id`=$id";
                $query = mysqli_query($conn, $sql);
    
                if(!$query){
                    throw new Exception(mysqli_error($conn));
                }else{
                    echo json_encode(['status'=>200, 'message'=>'Pages deleted successfully']);
                }
            }
        }catch(Exception $e){
            echo json_encode(['status'=>200,'flag'=>'error', 'message'=>$e->getMessage()]);
        }

    }else{
        $id = $_GET['id'];
        try{
            $sql = "DELETE `pages`
            FROM `pages`
            LEFT JOIN `page_seo` ON `pages`.`page_id` = `page_seo`.`page_id`
            WHERE `pages`.`page_id` = $id";
            $query = mysqli_query($conn, $sql);

            if(!$query){
                throw new Exception(mysqli_error($conn));
            }else{
                echo json_encode(['status'=>200, 'message'=>'Page deleted successfully']);
            }
        }catch(Exception $e){
            echo json_encode(['status'=>200,'flag'=>'error', 'message'=>$e->getMessage()]);
        }
    }
}
?>