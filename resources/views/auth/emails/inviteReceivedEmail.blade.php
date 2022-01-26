<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invite received email</title>
</head>
<body style="width: 600px;align-self: center">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width: 100%; font-family: Arial, sans-serif; background-color: #ffffff">
    <tr style="background: #ffffff;" align="center">
        <td><img src="{{$message->embed(public_path() . '/emailImages/logo.png')}}" alt="logo" border="0" width="178" style="display:block; padding-top: 46px; padding-bottom: 40px"></td>
    </tr>
    <tr align="center">
        <td>
            <img src="{{$message->embed(public_path() . '/emailImages/background.png')}}" alt="background">
        </td>
    </tr>
    <tr>
        <td style="padding: 0 32px 0 32px">
            <p style="font-weight: normal;font-size: 20px;color: #3A3335;padding-bottom: 64px;">
                {{$name}} has invited you to use Doorstack.com Use the button below to set up your account and get started:
            </p>
        </td>
    </tr>
    <tr align="center" style="height: 130px;background-color: #F5F6F7;">
        <td>
            <a href="{{$invitation}}" style="color: #ffffff;text-decoration: none;padding: 13px 69px;background-color: #783DC3;border-radius: 9px">Register now</a>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 32px;padding-top: 64px;padding-bottom: 32px;">
            <p style="font-weight: bold;font-size: 16px;line-height: 28px;color: #783DC3;">Here's how it works</p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 50px;">
            <img src="{{$message->embed(public_path() . '/emailImages/search.png')}}" alt="search">
            <p style="font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin-bottom: 0;padding-bottom: 2px;">Explore Property</p>
            <p style="font-weight: normal;font-size: 18px;text-align: center;color: #3A3335;width: 371px;">
                Explore all properties because we have a detailed property page
            </p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 50px;">
            <img src="{{$message->embed(public_path() . '/emailImages/choose.png')}}" alt="choose">
            <p style="font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin-bottom: 0;padding-bottom: 2px;">Choose Property</p>
            <p style="font-weight: normal;font-size: 18px;text-align: center;color: #3A3335;width: 371px;">
                Select the property, make sure you have checked the property overview
            </p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 50px;">
            <img src="{{$message->embed(public_path() . '/emailImages/add.png')}}" alt="add">
            <p style="font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin-bottom: 0;padding-bottom: 2px;">Add to Stack</p>
            <p style="font-weight: normal;font-size: 18px;text-align: center;color: #3A3335;width: 371px;">
                Create or add to an existing stack your ideal property criteria
            </p>
        </td>
    </tr>
    <tr align="center">
        <td style="padding-bottom: 50px;">
            <img src="{{$message->embed(public_path() . '/emailImages/start.png')}}" alt="start">
            <p style="font-weight: bold;font-size: 20px;text-align: center;color: #3A3335;margin-bottom: 0;padding-bottom: 2px;">Start Compare</p>
            <p style="font-weight: normal;font-size: 18px;text-align: center;color: #3A3335;width: 371px;">
                You can share a link, including full comparison data between each property.
            </p>
        </td>
    </tr>

    <tr style="background-color: #FAF4FF">
        <td style="padding-left: 32px;padding-bottom: 43px;">
            <p style="margin: 0;padding-bottom: 32px;padding-top: 44px;font-weight: bold;font-size: 24px;color: #3A3335;">
                We can offer you all this and more
            </p>
            <p style="font-weight: normal;font-size: 18px;letter-spacing: 0.02em;color: #3A3335;padding-bottom: 32px;">Sign up and find your perfect home.</p>
            <a href="{{$invitation}}" style="color:#ffffff;padding: 13px 50px;background-color: #783DC3;border-radius: 9px; text-decoration: none">Get started</a>
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







