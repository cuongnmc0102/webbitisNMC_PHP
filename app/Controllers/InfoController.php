<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class InfoController extends Controller
{
    protected $infoModel;
    
    public function __construct()
    {
        $this->infoModel = $this->loadModel('InfoModel');
    }

    public function show(int $id)
    {
        $data['title'] = 'Nhập thông tin ứng tuyển';
        $data['template'] = 'info/staff';
        $data['recruitments'] = $this->infoModel->getRecruitment($id);

        return $this->loadView('main', $data);
    }

    public function addStaff()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            #Lấy toàn bộ dữ liệu từ form input
            $name = isset($_POST['name']) ? Helper::makeSafe($_POST['name']) : '';
            $recruitment = isset($_POST['recruitment_id']) ? intval($_POST['recruitment_id']) : 0;
            $phone = isset($_POST['phone']) ? Helper::makeSafe($_POST['phone']) : '';
            //$address = isset($_POST['address']) ? Helper::makeSafe($_POST['address']) : '';
            $email = isset($_POST['email']) ? Helper::makeSafe($_POST['email']) : '';
            $content = isset($_POST['content']) ? Helper::makeSafe($_POST['content']) : '';


            #kiểm tra một số trường bắt buộc
            if ($name == '' || $phone == '' ) {
                Helper::flash('errors', 'Vui lòng nhập vào Tên, Số ĐT');
                return Helper::redirect('/nop-don-tuyen-dung/');
            }

            if (!isset($_FILES['fileinfo']['name']) || $_FILES['fileinfo']['name'] == '') {
                Helper::flash('errors', 'Vui lòng chọn 1 tấm ảnh ');
                return Helper::redirect("/nop-don-tuyen-dung/");
            }

            if (!isset($_FILES['filecv']['name']) || $_FILES['filecv']['name'] == '') {
                Helper::flash('errors', 'Vui lòng chọn 1 CV ');
                return Helper::redirect('/nop-don-tuyen-dung/');
            }

            $pathImg = getPathFolder('info') . basename($_FILES["fileinfo"]["name"]);
            move_uploaded_file($_FILES['fileinfo']['tmp_name'], $pathImg);

            $pathCv = getPathFolder('cv') . basename($_FILES["filecv"]["name"]);
            move_uploaded_file($_FILES['filecv']['tmp_name'], $pathCv);

            $dataInsert = [
                'name' => $name,
                'recruitment_id' => $recruitment,
                'phone' => $phone,
                'address' => $address,
                //'email' => $email,
                'content' => $content,
                'thumb' => '/'. $pathImg,
                'cv' => '/'. $pathCv,
                'time_create' => time(),
                'is_view' => '0'
            ];

            #Lưu thông tin khách hàng
            $lastId = $this->infoModel->addRecruitment($dataInsert);

            if ($lastId) { #Kiểm tra xem có ID người ứng tuyển 
        
                #Send Mail
                #mail('cuongnmc1998@gmail.com', 'My Subject', 'Test Email');

                $mail = new PHPMailer(true);
                try {

                 // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'cuongnmc1998@gmail.com';                     // SMTP username
                    $mail->Password   = 'muahiqqphwnktaeo';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('cuongnmc1998@gmail.com', 'Mailer');
                    $mail->addAddress('cuongnmc1998@gmail.com', 'Joe User');     // Add a recipient
                    $mail->addAddress('cuongnmc1998@gmail.com');               // Name is optional
                    $mail->addReplyTo('info@example.com', 'Information');
                    #$mail->addCC('cc@example.com');
                    #$mail->addBCC('bcc@example.com');

                    // Attachments
                    #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Staff';
                    $mail->Body    = 'Có một người ứng tuyển';
                    $mail->AltBody = 'Nhân viên mới';

                    $mail->send();
   
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                

                Helper::flash('success', 'Gừi hồ sơ Thành Công');
                return Helper::redirect('tuyen-dung.html');
            }
        }

        return Helper::redirect('tuyen-dung.html');
    }

}