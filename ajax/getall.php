
<?php
include("../connection.php");

if(isset($_POST['add']))
{
    $data = filteration($_POST);

    //check if mail is unique or not
    
    $u_exist = select("SELECT * FROM `employee` WHERE `mail`= ? LIMIT 1",[$data['email']],"s");

    if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['mail'] == $data['email']) ? 'email_already' :'';
        exit;
    }

    $query="INSERT INTO `employee`(`fname`,`mname`,`lname`, `gender`,`mail`, `contact`, `dob`, `pic`, `status`) VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'],$data['mname'],$data['lname'],$data['gender'],$data['email'],$data['phonenum'],$data['dob'],$data['profile'],1];

    insert($query,$values,'ssssssssi');
   
    $queryFetchEid = "SELECT LAST_INSERT_ID() AS eid";

    $result = $cn->query($queryFetchEid);

    // Check if the query was successful and if there is a row returned
    if ($result && $result->num_rows > 0) {
        // Fetch the result row as an associative array
        $row = $result->fetch_assoc();
        
        // Retrieve the eid from the associative array
        $eid = $row['eid'];

        // Free the result set
        $result->free();
    }

    
     $addressCount = 1;
    // Iterate through each address field
    for ($i = 1; $i < 5; $i++)
     {
        $addressField = isset($_POST['address_' . $i]) ? trim($_POST['address_' . $i]) : '';

        // Check if the address field is not empty
        if (!empty($addressField)) {
            $addressCount++;
        }    
     }

        if($addressCount==5)
        {
            $full_address = $_POST['address'] . ", " . $_POST['address_1'] . ", " . $_POST['address_2'] . ", " . $_POST['address_3'] . ", " . $_POST['address_4'];
        }
        else if($addressCount==4)
        {
            $full_address = $_POST['address'] . ", " . $_POST['address_1'] . ", " . $_POST['address_2'] . ", " . $_POST['address_3'];
        }
        else if($addressCount==3)
        {
            $full_address = $_POST['address'] . ", " . $_POST['address_1'] . ", " . $_POST['address_2'] ;
        }
        else if($addressCount==2)
        {
            $full_address = $_POST['address'] . ", " . $_POST['address_1'];
        }
        else
        {
            $full_address= $_POST['address'];
        }
    

      $query2="INSERT INTO `address`(`employee_id`,`address`, `country`, `state`, `pincode`) VALUES (?,?,?,?,?)";

      $values1 = [$eid,$full_address,$data['country'],$data['state'],$data['pincode']];
     
      if(insert($query2,$values1,'isssi'))
      {
          echo 'inserted';    
      }
      else {
        echo "ins_failed";
      }


};


if(isset($_POST['get_users']))
{
    $frm_data = filteration($_POST);

    $limit = 5;

    $page= $frm_data['page'];
    $start=($page-1)*$limit;

    $query="SELECT bo.*,bd.* FROM `employee` bo
    INNER JOIN `address` bd ON bo.eid = bd.employee_id
    WHERE (bo.status = ?)
    AND (bo.fname LIKE ? OR bo.mname LIKE ? OR bo.lname LIKE ? OR bo.contact LIKE ? OR bo.gender = ?) 
    ORDER BY bo.eid DESC";

 $res = select($query,[1,"%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","$frm_data[search]"],'isssss');

 $limit_query = $query." LIMIT $start,$limit";
 $limit_res = select($limit_query,[1,"%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","$frm_data[search]"],'isssss');

 $total_rows=mysqli_num_rows($res);

 if($total_rows==0)
 {   
  $output= json_encode(['table_data'=>"<br><b>No Data Found!</b>","pagination"=>'']);
  echo $output; 
  exit;
 }

 $i=$start+1;
 $table_data="";

  while($data= mysqli_fetch_assoc($limit_res))
  {

    $table_data .="
      <tr>
        <td>$i</td>
        <td>
          <span class='badge bg-primary'>
          Employee ID: $data[eid]
          </span>
          <br>
          <b>Name :</b> $data[fname]
          <br>
          <b>Middle Name :</b> $data[mname]
          <br>
          <b>Last Name:</b> $data[lname]
        </td>
        <td>
          <b>Gender :</b> $data[gender]
          <br>
          <b>Email :</b> $data[mail]
        </td>
        <td>
        <b>DOB :</b> $data[dob]
        <b>Contact: </b> $data[contact]
        <br>
        </td>
        <td>
        <b>Address:</b> $data[address]
        <br>
        <b>State:</b> $data[state]
        <br>
        <b>Pincode:</b> $data[pincode]
        </td>
        <td>
         <button type='button' onclick='edit_details($data[eid])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#editModel'>
         <i class='bi bi-pencil-square'></i>Edit
          </button>
        
          <button type='button' onclick='delete_user($data[eid])' class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
          <i class='bi bi-trash'></i> Delete
          </button>
        </td>

      </tr>
    ";

    $i++;
  }

  
  $pagination ="";

  if($total_rows>$limit)
  {
    $total_pages = ceil($total_rows/$limit);

    if($page!=1){
      $pagination .="<li class='page-item'>
          <button onclick='change_page(1)' class='page-link shadow-none'>First</button>
        </li>";
    }

    $disabled =($page==1) ? "disabled": "";
    $prev=$page-1;
    $pagination .="<li class='page-item $disabled'>
      <button onclick='change_page($prev)' class='page-link shadow-none'>Prev</button>
    </li>";

    $disabled =($page==$total_pages) ? "disabled": "";
    $next=$page+1;
    $pagination .="<li class='page-item $disabled'>
        <button onclick='change_page($next)' class='page-link shadow-none'>Next</button>
      </li>";

      if($page!=$total_pages){
        $pagination .="<li class='page-item $disabled'>
            <button onclick='change_page($total_pages)' class='page-link shadow-none'>Last</button>
        </li>";
    }
  }

   

  $output = json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);

    echo $output;
}


if(isset($_POST['get_user']))
{
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `employee` WHERE `eid`=?", [$frm_data['get_user']],'i');
    $res2 = select("SELECT * FROM `address` WHERE `employee_id`=?", [$frm_data['get_user']],'i');
   
    
    $userdata =mysqli_fetch_assoc($res1);
    
    $addata =mysqli_fetch_assoc($res2);

    $data = ["userdata"=> $userdata ,"addata"=> $addata];
 
    $data =json_encode($data);

    echo $data;

}


if(isset($_POST['edit']))
{
    $data = filteration($_POST);

    $q1="UPDATE `employee` SET `fname`=?,`mname`=?,`lname`=?,`gender`=?,`mail`=?,`contact`=?,`dob`=?,`pic`=? WHERE `eid`=?";
    
     $values = [$data['name'],$data['mname'],$data['lname'],$data['gender'],$data['email'],$data['phonenum'],$data['dob'],$data['profile'],$data['user_id']];

     $q2="UPDATE `address` SET `address`=?,`country`=?,`state`=?,`pincode`=? WHERE `employee_id`=?";

     $values1 = [$data['address'],$data['country'],$data['state'],$data['pincode'],$data['user_id']];

     if(update($q1,$values,'ssssssssi') || update($q2,$values1,'sssii'))
     {
        $flag=1;
        echo $flag;
     }
    
}


if(isset($_POST['del_user']))
{
 $data = filteration($_POST);
 
 $q1="UPDATE `employee` SET `status`=? WHERE `eid`=?";

 $values=[0,$data['del_user']];

 if(update($q1,$values,'ii') )
 {
    echo 1;
 }
}


?>


