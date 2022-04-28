<?php
   require('../libs/session.php');

   $site_func = '<li class="breadcrumb-item">Manage</li><li class="breadcrumb-item">Website preference</li>';
   $xpt_home->assign('function', $site_func);
   $user_type = $_SESSION['user_type'];

   if ($user_type != 1)
      $function->destroy_Session($baseUrl, "You have no permission on this site.");
   else
   {
      // define('ICON', 0);
      // define('LOGO', 1);

      // $path = $_SERVER["DOCUMENT_ROOT"]."/eProject/images/";
      $site = 'PREFERENCE'; $content='INFO';

      $xpt = new XTemplate('views/manage/preference.html');

      $result = $db->fetchAll("SELECT * FROM tbl_siteinf WHERE 1=1");
      foreach ($result as $row)
      {
         htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content=> $row)));
      }

      if(isset($_REQUEST['SiteInf']))
      {
         $condition = "1";
         // ***************************************************************
         // FIXME: I LOST MY uploadImg() FUNCTION :(, HAVE NO TIME TO WRITE AGAIN.
         // ***************************************************************
         // in short, this function will copy your image (basic format PNG, JPG, ICO - not includes the advanced format like TGA)
         // to the 'images' folder then rename it, and delete the old file if necessary
         // ***************************************************************

         /*
         if (is_uploaded_file($_FILES['icon']['tmp_name']) && $_FILES['icon']['error']==UPLOAD_ERR_OK)
         {
            foreach ($result as $row)
            {
               unlink($path.substr($row['icon_path'], -8));
            }
            $function-> FIXME: uploadImg($_FILES['icon'], $path, ICON);
            $file = basename($_FILES['icon']['name']);
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $db->tblUpdate_EditInfo('tbl_siteinf', 'icon_path', '{baseUrl}/images/icon.'.$extension, $condition);
         }

         if (is_uploaded_file($_FILES['logo']['tmp_name']) && $_FILES['logo']['error']==UPLOAD_ERR_OK)
         {
            foreach ($result as $row)
            {
               unlink($path.substr($row['logo_path'], -8));
            }
            $function-> FIXME: uploadImg($_FILES['logo'], $path, LOGO);
            $file=basename($_FILES['logo']['name']);
            $extension=strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $db->tblUpdate_EditInfo('tbl_siteinf', 'logo_path', '{baseUrl}/images/logo.'.$extension, $condition);
         }
         */

         $info=array();

         if (strlen($_POST['name']))
            $info=array_merge($info, array('name' => $_POST['name']));
         if (strlen($_POST['phone']))
            $info=array_merge($info, array('phone' => $_POST['phone']));
         if (strlen($_POST['phone_itnl']))
            $info=array_merge($info, array('phone_international' => $_POST['phone_itnl']));
         if (strlen($_POST['mail']))
            $info=array_merge($info, array('mail' => $_POST['mail']));
         if (strlen($_POST['address']))
            $info=array_merge($info, array('address_api' => $_POST['address']));
         if (strlen($_POST['icon_path']))
            $info=array_merge($info, array('icon_path' => $_POST['icon_path']));
         if (strlen($_POST['logo_path']))
            $info=array_merge($info, array('logo_path' => $_POST['logo_path']));
            
         if (sizeof($info)>0) foreach ($info as $col => $val)
            $db->tblUpdate_EditInfo('tbl_siteinf', $col, $val, $condition);
         $function->pageRefresh();
      }

      $xpt->assign('baseUrl', $baseUrl);
      $xpt->parse($site);
      $admin_content=$xpt->text($site);
   }
?>