
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
            <button type="button" class="submit-btn" onclick="window.print()">
                Print Application
            </button>
            <button type="button" class="reset-btn" onclick="window.location.href='index.php'">
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
