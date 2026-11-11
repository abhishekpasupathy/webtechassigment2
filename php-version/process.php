<?php
// Receives the registration form, validates the input, and displays the submitted details.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

function clean_input(string $key): string {
    return trim((string)($_POST[$key] ?? ''));
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$fields = [
    'Full name' => clean_input('fullName'),
    'Email address' => clean_input('email'),
    'Phone number' => clean_input('phone'),
    'Date of birth' => clean_input('dob'),
    'Gender' => clean_input('gender'),
    'Course / programme' => clean_input('course'),
    'Year of study' => clean_input('year'),
    'Address' => clean_input('address')
];

$errors = [];
foreach ($fields as $label => $value) {
    if ($value === '') {
        $errors[] = $label . ' is required.';
    }
}

if (!filter_var($fields['Email address'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}
if (!preg_match('/^\+?[0-9\s()\-]{7,20}$/', $fields['Phone number'])) {
    $errors[] = 'Please enter a valid phone number.';
}
$date = DateTime::createFromFormat('Y-m-d', $fields['Date of birth']);
if (!$date || $date->format('Y-m-d') !== $fields['Date of birth'] || $date > new DateTime('today')) {
    $errors[] = 'Please enter a valid date of birth.';
}
$allowedGenders = ['Male', 'Female', 'Other', 'Prefer not to say'];
$allowedCourses = ['Computer Science & Engineering', 'Information Science & Engineering', 'Electronics & Communication Engineering', 'Artificial Intelligence & Machine Learning', 'Other'];
$allowedYears = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
if (!in_array($fields['Gender'], $allowedGenders, true)) $errors[] = 'Please select a valid gender.';
if (!in_array($fields['Course / programme'], $allowedCourses, true)) $errors[] = 'Please select a valid course.';
if (!in_array($fields['Year of study'], $allowedYears, true)) $errors[] = 'Please select a valid year of study.';
if (clean_input('consent') !== 'yes') $errors[] = 'Please confirm that the information is accurate.';

if ($errors) {
    http_response_code(400);
}
$applicationId = 'RV-' . date('ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Result | RVITM</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <main class="page-shell">
    <nav class="topbar"><a class="brand" href="index.php"><span class="brand-mark">R</span><span><strong>RVITM</strong><small>STUDENT PORTAL</small></span></a><span class="secure-label">REGISTRATION RESULT</span></nav>
    <section class="hero"><div class="eyebrow"><span></span> APPLICATION RESPONSE</div><h1>Your submission<br><span>status.</span></h1></section>
    <section class="result-card">
      <?php if ($errors): ?>
        <div class="success-icon" style="background:#fff0ed;color:#c34343">!</div>
        <div class="section-kicker">PLEASE REVIEW</div><h2>Submission unsuccessful</h2>
        <p class="result-intro">Please correct the following details and submit the form again.</p>
        <ul style="text-align:left;color:#c34343;font-size:13px;line-height:1.9"><?php foreach ($errors as $error): ?><li><?php echo e($error); ?></li><?php endforeach; ?></ul>
        <div class="result-actions"><a class="secondary-button" href="index.php" style="text-decoration:none">Back to form</a></div>
      <?php else: ?>
        <div class="success-icon">✓</div>
        <div class="section-kicker">SUBMISSION COMPLETE</div><h2>You're all set.</h2>
        <p class="result-intro">Your registration details have been received and processed successfully.</p>
        <div class="receipt-heading"><span>APPLICATION SUMMARY</span><span><?php echo e($applicationId); ?></span></div>
        <div class="result-details">
          <?php foreach ($fields as $label => $value): ?>
            <div class="detail-item<?php echo $label === 'Address' ? ' wide' : ''; ?>">
              <span class="detail-label"><?php echo e($label); ?></span>
              <span class="detail-value"><?php echo nl2br(e($value)); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="result-actions"><button class="secondary-button" type="button" onclick="window.print()">Print summary ↗</button><a class="text-button" href="index.php" style="text-decoration:none">Submit another response</a></div>
      <?php endif; ?>
    </section>
    <footer><span>© 2026 RVITM · STUDENT REGISTRATION</span><span>PROCESSED WITH PHP</span></footer>
  </main>
</body>
</html>