<?php
    global $id;
    $id = mysqli_connect("127.0.0.1:3307","root","") or die("error when entering the server");
    $id_db = mysqli_select_db($id,'ecole') or die("error when accessing to the table");
    $requ = "SELECT * FROM `parent`"; // data base request
    global $table; // a variable for the return of the request of the table from the database
    $table = mysqli_query($id,$requ);
    $rowcount = mysqli_num_rows( $table );
 
    $request_teacher = "SELECT * FROM `teacher`";

    global $tableteacher;
    $tableteacher = mysqli_query($id,$request_teacher);

    $request_student = "SELECT * FROM `student`";

    global $tablestudent;
    $tablestudent = mysqli_query($id,$request_student);

    function matricule_parent_array(){
        $id = $GLOBALS['id'];
        $rq = "SELECT DISTINCT matricule FROM `parent` ORDER BY matricule";
        $result = mysqli_query($id,$rq) or die("ERROR IN THE SELECTION");
        $res = $result->fetch_assoc();
        if($res == 0) return 0;
        else{
            $arr = array();
            $arr[] = $res['matricule'];
            while($res = $result->fetch_assoc()){
                $arr[] = $res['matricule'];
            }
            return $arr;
        }
    }

    function Random_Matricule_parent(){
        $matricule_test = 20240000;
        $arr = matricule_parent_array();
        if($arr == 0) return $matricule_test;
        for($i = 0 ; $i < count($arr) ; $i++){
            if($matricule_test == $arr[$i]) $matricule_test++;
            else return $matricule_test; 
        }
        return $matricule_test;

    }


    function is_exists_matricule($temp){
        $table1 = $GLOBALS['table'];
        while ($row = $table1->fetch_assoc()) {
            if($row['matricule'] == $temp){
                return true;
            }
        }
        return false;
    }
    function is_exists_email($temp){
        $table1 = $GLOBALS['table'];
        while ($row = $table1->fetch_assoc()) {
            if($row['email'] == $temp){
                return true;
            }
        }
        return false;
    }

    function check_password_matricule($temp,$pss){
        $table1 = $GLOBALS['table'];
        while ($row = $table1->fetch_assoc()) {
            if($row['matricule'] == $temp){
                if($row['password'] == $pss){
                    return true;
                }else{
                    return false;
                }
            }
        }
        return false;
    }
    
    function check_password_email($temp,$pss){
        $table1 = $GLOBALS['table'];
        while ($row = $table1->fetch_assoc()) {
            if($row['email'] == $temp){
                return $row['password'] == $pss;
            }
        }
        return false;
    }

 /*   function Random_Matricule_teacher(){
        $table1 = $GLOBALS['tableteacher'];
        $matricule_test = 20240000;
        $counter_table = mysqli_num_rows( $table1 );
        $conditions = true;
        $i = 0;
        while($conditions && $i <= $counter_table){
            $i++;
            $table1 = $GLOBALS['tableteacher'];
            while($row = $table1->fetch_assoc()){
                if($row['matricule'] == $matricule_test){
                    $matricule_test++;
                }
            }
        }
        return $matricule_test;
    }*/

    function is_exists_matricule_teacher($temp){
        $id = $GLOBALS['id'];
        $table1 = $GLOBALS['tableteacher'];
        while($row = $table1->fetch_assoc()){
            if($row['matricule'] == $temp) return true;
        }
        return false;
    }
    
    function Return_Teacher_Row($mattest){
        $id = $GLOBALS['id'];
        $qs = "SELECT * FROM `teacher` where matricule = $mattest";
        $result = mysqli_query($id,$qs);
        $row = $result->fetch_assoc();
        return $row;
    }
    function check_password_matricule_teacher($mattest,$pwd){
        $row = Return_Teacher_Row($mattest);
        return $row['password'] == $pwd;
    }

    function matricule_teacher_array(){
        $id = $GLOBALS['id'];
        $rq = "SELECT DISTINCT matricule FROM `teacher` ORDER BY matricule";
        $result = mysqli_query($id,$rq) or die("ERROR IN THE SELECTION");
        $res = $result->fetch_assoc();
        if($res == 0) return 0;
        else{
            $arr = array();
            $arr[] = $res['matricule'];
            while($res = $result->fetch_assoc()){
                $arr[] = $res['matricule'];
            }
            return $arr;
        }
    }

    function Random_Matricule_teacher(){
        $matricule_test = 20240000;
        $arr = matricule_teacher_array();
        if($arr == 0) return $matricule_test;

        for($i = 0 ; $i < count($arr) ; $i++){
            if($matricule_test == $arr[$i]) $matricule_test++;
            else return $matricule_test; 
        }
        return $matricule_test;

    }

    function matricule_student_array(){
        $id = $GLOBALS['id'];
        $rq = "SELECT DISTINCT matricule FROM `student` ORDER BY matricule";
        $result = mysqli_query($id,$rq) or die("ERROR IN THE SELECTION");
        $res = $result->fetch_assoc();
        if($res == 0) return 0;
        else{
            $arr = array();
            $arr[] = $res['matricule'];
            while($res = $result->fetch_assoc()){
                $arr[] = $res['matricule'];
            }
            return $arr;
        }
    }

    function Random_Matricule_student(){
        $matricule_test = 20240000;
        $arr = matricule_student_array();
        if($arr == 0) return $matricule_test;

        for($i = 0 ; $i < count($arr) ; $i++){
            if($matricule_test == $arr[$i]) $matricule_test++;
            else return $matricule_test; 
        }
        return $matricule_test;

    }

    function put_id_array(){
        $arr = array();
        $id = $GLOBALS['id'];
        $rq = "SELECT DISTINCT ID FROM `publier` ORDER BY ID";
        $result = mysqli_query($id,$rq) or die("ERROR IN THE REQUEST");
        while($res = $result->fetch_assoc()){
            $arr[] = $res['ID'];
        }
        return $arr;
    }
    function Random_identification_pub(){
        $arr = put_id_array();
        $identification = 0;
        if($arr == 0) return $matricule_test;

        for($i = 0 ; $i < count($arr) ; $i++){
            if($identification == $arr[$i]) $identification++;
            else return $identification; 
        }
        return $identification;
    }

?>