<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <tr><td>Dear {{ $name }}!</td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Your Vendor Email is confirmed. Please login and add you personal, business and bank details to approved your account.</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Your Vendor Account details are below :-<br></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Name: {{ $name }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Mobile: {{ $mobile }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email: {{ $email }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: ***** (as chosen by you) </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Sincerly,</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Wavepad Management</td></tr>
</body>
</html>