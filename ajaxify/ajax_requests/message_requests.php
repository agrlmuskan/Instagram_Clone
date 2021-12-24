<?php
  session_start();
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {

    include_once '../../config/class/needy_class.php';
    include '../../config/class/message.class.php';
    $message = new message;

    if (isset($_GET['getPeople'])) {
      $message->getPeople($_GET['getPeople']);
    }

    if (isset($_GET['mssgViaBtn'])) {
      $message->mssgViaBtn($_GET['mssgViaBtn'], $_GET['viaTo'], $_GET['cname']);
    }

    if (isset($_GET['selectC'])) {
      $message->getMessages($_GET['selectC'], $_GET['user']);
    }

    if (isset($_POST['messageText'])) {
      if ($_POST['mssgOf'] == "user") {
        $tmt = $_POST['mssgTo'];
      } else if($_POST['mssgOf'] == "group") {
        $tmt = "";
      }
      $message->sendMessageText($_POST['messageText'], $tmt, $_POST['mssgCon'], $_POST['mssgOf']);
    }

    if (isset($_FILES['mssgImage'])) {
      if ($_POST['conImgBy'] == "user") {
        $imt = $_POST['mIto'];
      } else if($_POST['conImgBy'] == "group") {
        $imt = "";
      }
      $m = $message->sendMessageImage($_FILES['mssgImage'], $imt, $_POST['conImg'], $_POST['conImgBy']);
      $m;
      $array = array("m" => $m);
      echo json_encode($array);
    }

    if (isset($_GET['sticker'])) {
      if ($_GET['stickerBy'] == "user") {
        $smt = $_GET['stickerTo'];
      } else if ($_GET['stickerBy'] == "group") {
        $smt = "";
      }
      $sticker = $message->sendMessageSticker($_GET['sticker'], $smt, $_GET['stickerCon'], $_GET['stickerBy']);
      $sticker;
      $array = array("sticker" => $sticker);
      echo json_encode($array);
    }

    if (isset($_GET['getAllUnreadMssg'])) {
      $c = $message->getAllUnreadMssg();
      $c;
      $array = array("count" => $c);
      echo json_encode($array);
    }

    if (isset($_GET['deleteAllMssg'])) {
      $message->deleteAllMssg($_GET['deleteAllMssg'], $_GET['dltAllBy']);
    }

    if (isset($_GET['dlt_con'])) {
      $message->deleteConversation($_GET['dlt_con'], $_GET['dlt_con_by']);
    }

    if (isset($_GET['editValue'])) {
      if ($_GET['editOf'] == "user") {
        $ecm = $_GET['editU'];
      } else if($_GET['editOf'] == "group") {
        $ecm = "";
      }
      $message->editConName($_GET['editValue'], $_GET['editCon'], $ecm, $_GET['editOf']);
    }

    if (isset($_GET['dltmssg'])) {
      $message->deleteMessage($_GET['dltmssg'], $_GET['dltconid'], $_GET['mssgType'], $_GET['dltmssgby']);
    }

    if (isset($_GET['editText'])) {
      $edit = $message->editMessage($_GET['editText'], $_GET['editMssg']);
      $edit;
      $array = array("return", trim($edit));
      echo json_encode($array);
    }

    if (isset($_GET['updateCon'])) {
      $c = $message->conUnreads($_GET['updateCon']);
      $c;
      $array = array("cons" => $c);
      echo json_encode($array);
    }

    if (isset($_GET['conUpdateCon'])) {
      $uc = $message->conUnreads($_GET['conUpdateCon']);
      $uc;
      $array = array("uC" => $uc);
      echo json_encode($array);
    }

    if (isset($_GET['conUpdateGrpCon'])) {
      $uc = $message->GrpConUnreads($_GET['conUpdateGrpCon']);
      $uc;
      $array = array("uC" => $uc);
      echo json_encode($array);
    }

    if (isset($_GET['conInfo'])) {
      $message->conInfo($_GET['conInfo']);
    }

    if (isset($_GET['cgcaUser'])) {
      $i = $message->changeGrpConAdmin($_GET['cgcaUser'], $_GET['cgcaGrp']);
      $i;
      $array = array("mssg" => $i);
      echo json_encode($array);
    }

  }
?>
