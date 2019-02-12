<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="contact-wrapper">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
        <div>
            <label for="name"><strong>Имя:</strong></label>
            <input type="text" size="50" name="contactname" id="contactname" value=""/>
        </div>
        <div>
            <label for="email"><strong>Email:</strong></label>
            <input type="text" size="50" name="email" id="email" value=""/>
        </div>
        <div>
            <label for="subject"><strong>Отрасль:</strong></label>
            <input type="text" size="50" name="subject" id="subject" value=""/>
        </div>
        <div>
            <label for="message"><strong>Дополнительная информация:</strong></label>
            <textarea rows="5" cols="50" name="message" id="message"></textarea>
        </div>

        <input type="submit" value="Отправить заявку" name="submit"/>
    </form>
</div>
</body>
</html>

<?php
//Если форма отправлена
if(isset($_POST['submit'])) {
    //Проверка Поля ИМЯ
    if(trim($_POST['contactname']) == '') {
        $hasError = true;
    } else {
        $name = trim($_POST['contactname']);
    }
    //Проверка поля ТЕМА
    if(trim($_POST['subject']) == '') {
        $hasError = true;
    } else {
        $subject = trim($_POST['subject']);
    }
    //Проверка правильности ввода EMAIL
    if(trim($_POST['email']) == '')  {
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
    //Проверка наличия ТЕКСТА сообщения
    if(trim($_POST['message']) == '') {
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['message']));
        } else {
            $comments = trim($_POST['message']);
        }
    }
    //Если ошибок нет, отправить email
    if(!isset($hasError)) {
        $emailTo = 'name@yourdomain.com'; //Сюда введите Ваш email
        $body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
        $headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }
}









?>