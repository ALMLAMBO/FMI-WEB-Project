<?php
function saveConversion($type,$from,$to,$content_to_convert,$result, $user_id){
    $conn = Config::mysql_conection(); 
    $sql="INSERT INTO conversions(from_what,to_what,content_to_convert,result_from_conversion) VALUES(?,?,?,?)";
    $query=$conn->prepare($sql);
    $query->bind_param('ssss',$from,$to,$content_to_convert,$result);
    $exec= $query->execute();
    if($exec==true)
    {
        $convert_id = mysqli_insert_id($conn);
        $date = date('Y-m-d H:i:s');
        $sql2="INSERT INTO users_conversions(user_id,conversion_id,converted_at) VALUES(?,?,?)";
        $query2=$conn->prepare($sql2);
        $query2->bind_param('sss',$user_id,$convert_id,$date);
        $exec2= $query2->execute();
        if($exec2==true)
        {
            if($type==null){
                header("location:../index.php");
            }else{
                header("location:../index2.php");
            }
           exit;
        }
        else
        {
            if($type==null){
                header("location:../index.php?error=Something went wrong.");
            }else{
                header("location:../index2.php?error=Something went wrong.");
            }
           exit;
        }
    }
    else
    {
        if($type==null){
            header("location:../index.php?error=Something went wrong.");
        }else{
            header("location:../index2.php?error=Something went wrong.");
        }
        exit;
    }
}

?>