<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru','phpmailer/language/');
    $mail->IsHTML(true);

    // Від кого письмо
    $mail->setFrom('info@fls.guru', 'Фрілансер по життю');
    // Кому відправити
    $mail->addAddress('code@fls.guru');
    // Тема письма
    $mail->Subject = 'Привіт! Це фрілансер по життю';

    // Рука
    $hand = " Права";
    if($_POST['hand'] == "left") {
        $hand = "Ліва";
    }

    // Тіло письма
    $body = '<h1>Зустріяайте супер письмо!</h1>';

    if(trim(!empty($_POST['name']))) {
        $body.='<p><strong>Імʼя:</strong> '$_POST['name']. '</p>';
    }
    if(trim(!empty($_POST['email']))) {
        $body.='<p><strong>E-mail:</strong> '$_POST['email']. '</p>';
    }
    if(trim(!empty($_POST['hand']))) {
        $body.='<p><strong>Рука:</strong> '$_hand. '</p>';
    }
    if(trim(!empty($_POST['age']))) {
        $body.='<p><strong>Вік:</strong> '$_POST['message']. '</p>';
    }

    // Прикріпити файл
    if(!empty($_FILES['image']['tmp_name'])) {
        // Шлях завантаження файлу
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
        // загружаємо файл
        if (copy($_FILES ['image']['tmp_name'],$filePath)) {
            $fileAttach = $filePath;
            $body.='<p><strong>Фото в додатку</strong></p>';
            $mail->addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;

    // Відправляємо
    if(!$mail->send()) {
        $message = 'Помилка';
    } else {
        $message = 'Данні відправлені!';
    }

    $response = ['message'=> $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>
