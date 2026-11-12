<?php
$submitted = false;
$errors = [];

$data = [
    "name" => "",
    "email" => "",
    "phone" => "",
    "dob" => "",
    "gender" => "",
    "course" => "",
    "address" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($data as $key => $value) {
        $data[$key] = trim($_POST[$key] ?? "");
    }

    if ($data["name"] == "") {
        $errors[] = "Name is required.";
    }

    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email address.";
    }

    if (!preg_match("/^[0-9]{10}$/", $data["phone"])) {
        $errors[] = "Enter a valid 10-digit phone number.";
    }

    if ($data["dob"] == "") {
        $errors[] = "Date of birth is required.";
    }

    if ($data["gender"] == "" || $data["course"] == "") {
        $errors[] = "Please select gender and course.";
    }

    if ($data["address"] == "") {
        $errors[] = "Address is required.";
    }

    if (empty($errors)) {
        $submitted = true;
    }
}

function clean($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Registration Form</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>

@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'DM Sans', sans-serif;
    background: linear-gradient(
        135deg,
        #14251e,
        #203c30,
        #304b3b
    );
    min-height: 100vh;
    padding: 45px 20px;
    color: #263b32;
}

.container {
    max-width: 650px;
    margin: auto;
    background: #fffdf8;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(39, 69, 52, 0.12);
    border-top: 6px solid #527960;
}

h1 {
    text-align: center;
    color: #315b43;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 8px;
}

.subtitle {
    text-align: center;
    color: #87958a;
    font-size: 14px;
    margin-bottom: 32px;
}

.form-group {
    margin-bottom: 21px;
}

label {
    display: block;
    color: #354d3e;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

input,
select,
textarea {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid #d5dfd3;
    border-radius: 8px;
    background: #f8faf6;
    color: #263b32;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    transition: 0.3s ease;
}

input::placeholder,
textarea::placeholder {
    color: #a0aca1;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #527960;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(82, 121, 96, 0.12);
}

select {
    cursor: pointer;
}

textarea {
    min-height: 100px;
    resize: vertical;
}

.button-group {
    display: flex;
    gap: 14px;
    margin-top: 28px;
}

button {
    flex: 1;
    padding: 14px;
    border: none;
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.3s ease;
}

.submit-btn {
    background: #315b43;
    color: #ffffff;
    box-shadow: 0 5px 12px rgba(49, 91, 67, 0.18);
}

.submit-btn:hover {
    background: #244632;
    transform: translateY(-2px);
}

.reset-btn {
    background: #e8eee5;
    color: #45664e;
}

.reset-btn:hover {
    background: #d9e4d7;
}

.success {
    background: #e4f2e6;
    color: #28613a;
    padding: 16px;
    border: 1px solid #c7e1cb;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
}

.error {
    background: #fff0e9;
    color: #a34c32;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.result {
    margin-top: 25px;
    padding: 25px;
    background: #f5f8f1;
    border: 1px solid #dce7d8;
    border-radius: 12px;
}

.result h2 {
    text-align: center;
    color: #315b43;
    font-size: 22px;
    margin-bottom: 18px;
}

.result p {
    padding: 13px 5px;
    border-bottom: 1px solid #dfe8dc;
    color: #526557;
    font-size: 14px;
    line-height: 1.6;
    overflow-wrap: anywhere;
}

.result p:last-child {
    border-bottom: none;
}

.result strong {
    display: inline-block;
    width: 125px;
    color: #315b43;
}

@media (max-width: 600px) {
    body {
        padding: 20px 12px;
    }

    .container {
        padding: 25px 20px;
    }

    h1 {
        font-size: 25px;
    }

    .button-group {
        flex-direction: column;
    }

    .result strong {
        width: 100%;
    }
}

</style>
</head>

<body>
<div class="container">
    <h1>Online Registration</h1>
    <p class="subtitle">Student Application Form</p>

    <?php if ($submitted): ?>
        <div class="success">Registration submitted successfully!</div>
        <div class="result">
            <h2>Application Details</h2>
            <p><strong>Name:</strong> <?= clean($data["name"]) ?></p>
            <p><strong>Email:</strong> <?= clean($data["email"]) ?></p>
            <p><strong>Phone:</strong> <?= clean($data["phone"]) ?></p>
            <p><strong>Date of Birth:</strong> <?= clean($data["dob"]) ?></p>
            <p><strong>Gender:</strong> <?= clean($data["gender"]) ?></p>
            <p><strong>Course:</strong> <?= clean($data["course"]) ?></p>
            <p><strong>Address:</strong> <?= nl2br(clean($data["address"])) ?></p>
        </div>
        <div class="button-group">
            <button class="submit-btn" onclick="window.location.href='index.php'">
                New Registration
            </button>
        </div>
    <?php else: ?>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= clean($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" id="registrationForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name"
                       placeholder="Enter your full name"
                       value="<?= clean($data["name"]) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email"
                       placeholder="Enter your email"
                       value="<?= clean($data["email"]) ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone"
                       placeholder="Enter 10-digit phone number"
                       maxlength="10"
                       value="<?= clean($data["phone"]) ?>" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob"
                       value="<?= clean($data["dob"]) ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?= $data["gender"] == "Male" ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= $data["gender"] == "Female" ? "selected" : "" ?>>Female</option>
                    <option value="Other" <?= $data["gender"] == "Other" ? "selected" : "" ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="course">Select Course</label>
                <select name="course" id="course" required>
                    <option value="">Select Course</option>
                    <option value="Computer Science" <?= $data["course"] == "Computer Science" ? "selected" : "" ?>>Computer Science</option>
                    <option value="Information Science" <?= $data["course"] == "Information Science" ? "selected" : "" ?>>Information Science</option>
                    <option value="Electronics" <?= $data["course"] == "Electronics" ? "selected" : "" ?>>Electronics</option>
                    <option value="Mechanical Engineering" <?= $data["course"] == "Mechanical Engineering" ? "selected" : "" ?>>Mechanical Engineering</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address"
                          placeholder="Enter your address" required><?= clean($data["address"]) ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="submit-btn">Submit Application</button>
                <button type="reset" class="reset-btn">Reset</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    $("#registrationForm").on("submit", function(event) {
        let name = $("#name").val().trim();
        let email = $("#email").val().trim();
        let phone = $("#phone").val().trim();

        if (name === "") {
            alert("Please enter your name.");
            event.preventDefault();
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert("Please enter a valid email address.");
            event.preventDefault();
            return;
        }

        if (!/^[0-9]{10}$/.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            event.preventDefault();
            return;
        }

        alert("Submitting your application...");
    });

    $("#phone").on("input", function() {
        this.value = this.value.replace(/[^0-9]/g, "");
    });
});
</script>
</body>
</html>
