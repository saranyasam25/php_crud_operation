<?php
$action = $_REQUEST['action'];

if (!empty($action)) {
    require_once 'supports/User.php';
    $obj = new User();
}

if ($action == 'adduser' && !empty($_POST)) {
    $pname = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo'];

    $playerId = (!empty($_POST['userId'])) ? $_POST['userId'] : "";

    $imagesName = "";
    if (!empty($photo['name'])) {
        $imagesName = $obj->uploadPhoto($photo);
    }
    $playerData = [
        'name' => $pname,
        'email' => $email,
        'mobile' => $mobile,
        'photo' => $imagesName,
    ];

    if($playerId){
        $obj->update($playerData,$playerId);
    }else{
        $playerId = $obj->add($playerData);
    }

    if (!empty($playerId)) {
        $player = $obj->getRow('id', $playerId);
        echo json_encode($player);
        exit();
    }
}elseif ($action == 'getallusers') {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;

    $start = ($page - 1) * $limit;
    $users = $obj->getRows($start, $limit);
    if (!empty($users)) {
        $userlist = $users;
    } else {
        $userlist = [];
    }
    $total = $obj->getCount();
    $userArr = ['count' => $total, 'players' => $userlist];
    echo json_encode($userArr);
    exit();
}elseif ($action == 'editusersdata') {
    $editId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($editId)) {
        $userData = $obj->getRow('id', $editId);
        echo json_encode($userData);
        exit();
    }
}elseif($action == 'deleteuser'){
    $deleteId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if(!empty($deleteId)){
        $isdeleted = $obj->deleteRow($deleteId);
        if($isdeleted){
            $displaymessage = ['delete'=>1];
        }else{
            $displaymessage = ['delete'=>0];
        }
        echo json_encode($displaymessage);
        exit();
    }
}elseif($action == 'searchuser'){
    $queryStarting = (!empty($_GET['searchQuery'])) ?trim( $_GET['searchQuery']) : '';
    $results = $obj->search($queryStarting);
    echo json_encode($results);
    exit();
}


