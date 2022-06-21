<?php
if (isset($_POST['userName']) && isset($_POST['userMail']) && isset($_POST['userBudget']) && isset($_POST['userDescripe'])) {
    //забираем данные из формы по значению name
    $userName = $_POST['userName'];
    $userMail = $_POST['userMail'];
    $userBudget = $_POST['userBudget'];
    $userDescripe = $_POST['userDescripe'];


    //дать некоторые данные для подключения к БД
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_base = "user";
    $db_table = "login_info";
}
    try {
        //подключаемся к БД
        $db = new PDO ("mysql:host=$db_host; dbname=$db_base", $db_user, $db_password);
        //собрать данные для запроса
        $data = array('userName' => $userName, 'userMail' => $userMail, 'userBudget' => $userBudget, 'userDescripe' => $userDescripe);
        //подготовка sql запроса
        $query = $db -> prepare("INSERT INTO $db_table (userName, userMail, userBudget, userDescripe) values (:userName, :userMail, :userBudget, :userDescripe)");
        //выполнить запрос к БД вместе с новыми данными из формы
        $query->execute($data);
        $result = true;
    } catch (PDOException $e) {
        //Если есть ошибка соединения или выполнения запроса, то выводим ошибку на экран
        print "Ошибка: " . $e -> getMessage() . "</br>";
    }
        if ($result) {
        echo "Успех. Информация занесена в базу данных";
    }

?>