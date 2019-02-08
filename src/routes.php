<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args)
{
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view

    return $this->renderer->render($response, 'index.phtml', $args);
});

/*
// ลองสร้าง Routes หน้า users
// Route แบบ GET
$app->get('/api/user/[{id}]', function (Request $request, Response $response, array $args) {
// การทำงาน
echo "Hello SmartX API ".$args['id'];
});

// Route แบบ POST
$app->post('/api/user/post', function (Request $request, Response $response, array $args) {
// การทำงาน
echo "Post data to user complete";
});

// Route แบบ PUT
$app->put('/api/user/put', function (Request $request, Response $response, array $args) {
// การทำงาน
echo "Update data to user complete";
});

// Route แบบ PUT
$app->delete('/api/user/delete', function (Request $request, Response $response, array $args) {
// การทำงาน
echo "Delete data to user complete";
});

 */

// ลองทดสอบดึงข้อมูลจากตาราง users
$app->get('/api/user', function (Request $request, Response $response, array $args)
{
    // การทำงาน
    $sql = $this->db->prepare("SELECT * FROM users");
    $sql->execute();
    $result = $sql->fetchAll();

    return $this->response->withJson($result);
});

// เพิ่มข้อมูลเข้าตาราง users
$app->post('/api/user', function (Request $request, Response $response, array $args)
{
    // รับค่าจากฟอร์ม
    $body = $this->request->getParsedBody();
    $sql  = "INSERT INTO users(fullname,username,password,type)
                VALUES(:fullname,:username,:password,:type)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("fullname", $body['fullname']);
    $sth->bindParam("username", $body['username']);
    $sth->bindParam("password", $body['password']);
    $sth->bindParam("type", $body['type']);
    $sth->execute();

    $data = $this->db->lastInsertId();

    return $this->response->withJson($data);
});

// แก้ไขข้อมูลในตาราง users
$app->put('/api/user/[{id}]', function (Request $request, Response $response, array $args)
{
    // รับค่าจากฟอร์ม
    $body = $this->request->getBody();
    $data = json_decode($body, true);

    $sql = "UPDATE users
                SET fullname=:fullname,
                        username=:username,
                        password=:password,
                        type=:type
                        WHERE id=:id";

    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("fullname", $data['fullname']);
    $sth->bindParam("username", $data['username']);
    $sth->bindParam("password", $data['password']);
    $sth->bindParam("type", $data['type']);

    if ($sth->execute())
    {
        $input = [
            'id'     => $args['id'],
            'status' => 'success',
        ];
    }
    else
    {
        $input = [
            'id'     => $args['id'],
            'status' => 'fail',
        ];
    }

    return $this->response->withJson($input);
});

// ลบข้อมูลในตาราง users
$app->delete('/api/user/[{id}]', function (Request $request, Response $response, array $args)
{
    $sth = $this->db->prepare("DELETE FROM users WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    if ($sth->execute())
    {
        $input = [
            'id'     => $args['id'],
            'status' => 'success',
        ];
    }
    else
    {
        $input = [
            'id'     => $args['id'],
            'status' => 'fail',
        ];
    }

    return $this->response->withJson($input);
});

// User Login
$app->post('/api/user/login', function (Request $request, Response $response, array $args)
{
    $body = $this->request->getParsedBody();
    $sql  = $this->db->prepare("SELECT id,username,password FROM users
                                                WHERE username=:username and password=:password");
    $sql->bindParam("username", $body['username']);
    $sql->bindParam("password", $body['password']);
    $sql->execute();
    // นับจำนวนรายที่พบ
    $count  = $sql->rowCount();
    $result = $sql->fetchAll();

    if ($count >= 1)
    {
        $input = [
            'user_id' => $result[0]['id'],
            'status'  => 'success',
        ];
    }
    else
    {
        $input = [
            'user_id' => '',
            'status'  => 'fail',
        ];
    }

    return $this->response->withJson($input);
});

//-----------------------------------------------------------------------------------------
//  ส่วนของการทำเพิ่มลบแก้ไขตาราง jobs
// -----------------------------------------------------------------------------------------
// ส่วนของการเพิ่มข้อมูลเข้าตาราง jobs
$app->post('/api/job', function (Request $request, Response $response, array $args)
{
    // ส่วนของการอัพโหลดไฟล์เข้า folder images
    $path = "images/";
    // ตรวจว่าผู้ใช้เลือกไฟล์มาหรือไม่
    if (isset($_FILES["file"]))
    {
        @$random_name = time()."_".strtolower($_FILES['file']['name']);
        $file_name = $path.basename($random_name);
        // อัพโหลดเข้า folder images
        if(move_uploaded_file($_FILES['file']['tmp_name'],$file_name)){
            $input = [
                'status'     => 'success'
            ];
        }else{
            $input = [
                'status'     => 'fail'
            ];
        }
    }else{
        // ถ้าไม่มีไฟล์เข้ามา
        $random_name = "nopic.jpg";
        $input = [
            'status'     => 'not select images'
        ];
    }

    // รับค่าจากฟอร์ม
    $current_data = date('Y-m-d H:i:s', time());
    $body         = $this->request->getParsedBody();
    $sql          = "INSERT INTO jobs(eqnum,description,status,picture1,gps_lat,gps_long, light,userid,create_at)
                VALUES(:eqnum,:description,:status,:picture1,:gps_lat,:gps_long,:light,:userid,:create_at)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("eqnum", $body['eqnum']);
    $sth->bindParam("description", $body['description']);
    $sth->bindParam("status", $body['status']);
    $sth->bindParam("picture1", $random_name);
    $sth->bindParam("gps_lat", $body['gps_lat']);
    $sth->bindParam("gps_long", $body['gps_long']);
    $sth->bindParam("light", $body['light']);
    $sth->bindParam("userid", $body['userid']);
    $sth->bindParam("create_at", $current_data);

    if ($sth->execute())
    {
        $data  = $this->db->lastInsertId();
        $input = [
            'id'     => $data,
            'status' => 'success',
        ];
    }
    else
    {
        $input = [
            'id'     => '',
            'status' => 'fail',
        ];
    }

    return $this->response->withJson($input);
});
