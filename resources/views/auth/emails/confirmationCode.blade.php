
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Code confirm</title>
</head>
<body style="width: 600px;align-self: center">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0 16px; width: 100%; font-family: Arial, sans-serif; background-color: #ffffff">
    <tr style="background: #ffffff;" align="center">
        <td>
            <img src="{{$message->embed(public_path() . '/emailImages/logo.png')}}" alt="logo" border="0" width="178" style="display:block; padding-top: 46px; padding-bottom: 40px">
            <hr />
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin: 0;width: 460px;font-weight: normal;font-size: 18px;line-height: 24px;color: #3A3335;padding-bottom: 24px;">Please enter this confirmation code</p>
        </td>
    </tr>
    <tr align="center" valign="center">
        <td>
            <div style="background-color: #F7F7F7;height: 170px;vertical-align: middle; padding-bottom: 24px;">
                <p style="margin: 0;padding-top: 60px;font-weight: bold;font-size: 48px;color: #3A3335;">{{$code}}</p>
            </div>
            <p style="font-style: normal;font-weight: normal;font-size: 18px;line-height: 24px;color: #3A3335;text-align: left">
                You can simply ignore this message if you have not requested a password reset
            </p>
        </td>
    </tr>

    <tr align="center">
        <td style="padding-top: 45px;padding-bottom: 32px;">
            <img style="margin-right: 32px;width: 28px;height: 28px;" src="{{$message->embed(public_path() . '/emailImages/instagram.png')}}" alt="instagram">
            <img style="margin-right: 32px;width: 28px;height: 28px;" src="{{$message->embed(public_path() . '/emailImages/facebook.png')}}" alt="facebook">
            <img style="margin-right: 32px;width: 28px;height: 28px;" src="{{$message->embed(public_path() . '/emailImages/linkedin.png')}}" alt="linkedin">
            <img style="width: 28px;height: 28px;" src="{{$message->embed(public_path() . '/emailImages/twitter.png')}}" alt="twitter">
        </td>
    </tr>


    <tr align="center">
        <td style="padding-bottom: 39px;">
            <p style="font-weight: normal;font-size: 15px;text-align: center;color: #ADB6CA;padding-bottom: 24px;">Company name (company.name)<br>
                1860 El Camino Real #401 Burlingame, CA 95010</p>
            <p style="font-weight: normal;font-size: 15px;text-align: center;color: #ADB6CA;">
                Manage email preferences or <br>
                <a href="#" style="color: #8890A1">unsubscribe</a></p>
        </td>
    </tr>
</table>
</body>
</html>
