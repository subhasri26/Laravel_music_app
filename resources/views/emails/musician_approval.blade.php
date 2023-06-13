<!DOCTYPE html>
<html>
<head>
    <title>Welcome Musician</title>
</head>
<body>
    <h2>Welcome Musician!</h2>
    <p>Thank you for joining our platform. We are delighted to have you as part of our community.</p>
    
    <h3>Your Account Details:</h3>
    <p>Username: {{ $username }}</p>
    <p>Password: {{ $password }}</p>
    
    <p>Please keep your account credentials confidential and secure.</p>
    <p>To log in to your account, please click the following link:</p>
    <p><a href="{{ url('/musician/login') }}?token={{ $token }}">Login Link</a></p>
    
    <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
    
    <p>Thank you again for joining us!</p>
    
    <p>Best regards,</p>
    <p>Your Organization</p>
</body>
</html>