<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Created account</title>
</head>
<body style="width: 600px;align-self: center">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width: 100%; font-family: Arial, sans-serif; background-color: #ffffff">
    <tr style="background: #ffffff;" align="center">
        <td>
            <img src="{{$message->embed(public_path() . '/emailImages/logo.png')}}" alt="logo" border="0" width="178" style="display:block; padding-top: 46px; padding-bottom: 40px">
        </td>
    </tr>
    <tr align="center">
        <td>
            <img src="{{$message->embed(public_path() . '/emailImages/codeBg.png')}}" alt="background">
        </td>
    </tr>

    <tr align="center">
        <td>
            <p style="font-weight: normal;font-size: 24px;color: #3A3335;">Hi, {{$name}}</p>
            <p style="font-weight: bold;font-size: 24px;text-align: center;color: #3A3335;">You have successfully created on
                <br> account <a href="#" style="text-decoration: none; color:#783dc3;">Doorstack.com</a>
            </p>
            <hr style="width: 536px"/>
            <p style="font-weight: bold;font-size: 28px;color: #3A3335;padding-bottom: 52px;">The traditional way can't offer you...</p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 56px;">
            <img src="{{$message->embed(public_path() . '/emailImages/collections.png')}}" alt="collections">
            <p style="padding-top: 18px;padding-bottom: 5px;font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin: 0;">Collections</p>
            <p style="margin: 0;font-weight: normal;font-size: 18px;line-height: 28px;text-align: center;color: #3A3335;width: 371px;">
                You can quickly save your favorite properties.
                DoorStack helps you quickly and easily organize and create
                sets in a stack.
            </p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 56px;">
            <img src="{{$message->embed(public_path() . '/emailImages/property.png')}}" alt="collections">
            <p style="padding-top: 18px;padding-bottom: 5px;font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin: 0;">Compare properties</p>
            <p style="margin: 0;font-weight: normal;font-size: 18px;line-height: 28px;text-align: center;color: #3A3335;width: 371px;">
                In the collected stacks, you can quickly see and compare properties and also you can add your ideal criteria and compare with them.
            </p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 56px;">
            <img src="{{$message->embed(public_path() . '/emailImages/comment.png')}}" alt="collections">
            <p style="padding-top: 18px;padding-bottom: 5px;font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin: 0;">Share and comment</p>
            <p style="margin: 0;font-weight: normal;font-size: 18px;line-height: 28px;text-align: center;color: #3A3335;width: 371px;">
                And also you can share the collected stacks with your friends and discuss them.
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
