<?php
$result = [];

if (isset($_POST['dob'])) {

    $dob = new DateTime($_POST['dob']);
    $today = new DateTime();

    if ($dob > $today) {
        $error = "Date of birth cannot be in the future.";
    } else {
        $age = $dob->diff($today);

        // Next birthday
        $nextBirthday = new DateTime($today->format("Y") . "-" . $dob->format("m-d"));
        if ($nextBirthday < $today) {
            $nextBirthday->modify("+1 year");
        }
        $daysToBirthday = $today->diff($nextBirthday)->days;

        $result = [
            "years" => $age->y,
            "months" => $age->m,
            "days" => $age->d,
            "total_months" => ($age->y * 12) + $age->m,
            "total_weeks" => floor($age->days / 7),
            "total_days" => $age->days,
            "total_hours" => $age->days * 24,
            "total_minutes" => $age->days * 24 * 60,
            "birthday_weekday" => $dob->format("l"),
            "days_to_birthday" => $daysToBirthday
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Advanced Age Calculator</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">


<style>
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    background: #fff;
    width: 100%;
    max-width: 700px;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,.25);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

input[type="date"] {
    width: 100%;
    padding: 14px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
    cursor: pointer;
}

input[type="date"]:focus {
    outline: none;
    border-color: #667eea;
}

button {
    width: 100%;
    padding: 14px;
    font-size: 16px;
    background: #667eea;
    border: none;
    color: #fff;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #5a67d8;
}

.result {
    margin-top: 20px;
}

.result div {
    padding: 10px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
}

.error {
    margin-top: 15px;
    color: red;
    text-align: center;
}

.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group input {
    width: 100%;
    padding: 16px 45px 16px 15px;
    font-size: 16px;
    border-radius: 10px;
    border: 2px solid #e0e0e0;
    transition: 0.3s;
    width: 640px;
}

.input-group input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102,126,234,0.15);
    outline: none;
}

.input-group::after {
    content: "📅";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
    pointer-events: none;
}

.footer {
    position: fixed;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 13px;
    color: black;
    text-align: center;
}


</style>
</head>
<body>

<div class="card">
<h1>Age Calculator</h1>

<form method="post">
    <div class="input-group">
        <input type="text" id="dob" name="dob" placeholder="Select your date of birth" required>
    </div>
    <button type="submit">Calculate Age</button>
</form>

<?php if (!empty($error)) { ?>
    <div class="error"><?= $error ?></div>
<?php } ?>

<?php if (!empty($result)) { ?>
<div class="result">
    <div><strong>Age</strong><span><?= $result['years'] ?>y <?= $result['months'] ?>m <?= $result['days'] ?>d</span></div>
    <div><strong>Total Months</strong><span><?= $result['total_months'] ?></span></div>
    <div><strong>Total Weeks</strong><span><?= $result['total_weeks'] ?></span></div>
    <div><strong>Total Days</strong><span><?= $result['total_days'] ?></span></div>
    <div><strong>Total Hours</strong><span><?= $result['total_hours'] ?></span></div>
    <div><strong>Total Minutes</strong><span><?= $result['total_minutes'] ?></span></div>
    <div><strong>Birthday</strong><span><?= $result['birthday_weekday'] ?></span></div>
    <div><strong>Next Birthday In</strong><span><?= $result['days_to_birthday'] ?> days</span></div>
</div>
<?php } ?>

</div>


	<footer class="footer">
    	Developed by MD Shahidul Islam.
	</footer>

	

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
flatpickr("#dob", {
    dateFormat: "Y-m-d",
    maxDate: "today",
    altInput: true,
    altFormat: "F j, Y",
    animate: true
});
</script>

</body>
</html>
