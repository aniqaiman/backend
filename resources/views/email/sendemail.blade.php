<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    h1 {
        margin-top: 0;
    }

    a {
        text-decoration: none;
    }

    .btnActivate {
        -moz-box-shadow: 0px 10px 14px -7px #3e7327;
        -webkit-box-shadow: 0px 10px 14px -7px #3e7327;
        box-shadow: 0px 10px 14px -7px #3e7327;
		background-color: #77b55a;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #77b55a), color-stop(1, #72b352));
        background: -moz-linear-gradient(top, #77b55a 5%, #72b352 100%);
        background: -webkit-linear-gradient(top, #77b55a 5%, #72b352 100%);
        background: -o-linear-gradient(top, #77b55a 5%, #72b352 100%);
        background: -ms-linear-gradient(top, #77b55a 5%, #72b352 100%);
        background: linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#77b55a', endColorstr='#72b352', GradientType=0);
        background-color: #77b55a;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        border: 1px solid #4b8f29;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-size: 1em;
        padding: 10px 15px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #5b8a3c;
    }

    .btnActivate:hover {
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #72b352), color-stop(1, #77b55a));
        background: -moz-linear-gradient(top, #72b352 5%, #77b55a 100%);
        background: -webkit-linear-gradient(top, #72b352 5%, #77b55a 100%);
        background: -o-linear-gradient(top, #72b352 5%, #77b55a 100%);
        background: -ms-linear-gradient(top, #72b352 5%, #77b55a 100%);
        background: linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#72b352', endColorstr='#77b55a', GradientType=0);
        background-color: #72b352;
    }

    .btnActivate:active {
        position: relative;
        top: 1px;
    }
</style>

<body>
    <div style="margin: 0 auto; background-color: #343a40; padding: 25px; text-align: center; color: white; max-width: 670px;">
        <img src="https://ninjavan.herokuapp.com/img/logo/logo-text.png" alt="Food Rico Logo" style="width: 190px; margin-top: 5px; margin-bottom: 15px;">

        <div style="background-color: white; border-radius: 3px; padding: 30px 30px 20px; text-align: left; color: black; margin-bottom: 5px;">
            <h1 style="text-align: center;">
                The FoodRico {{ $user->group->name }}
                <br />
                <sup>Welcome Onboard!</sup>
            </h1>

            <h4>Hi {{ $user->name }},</h4>

            <p>
                Thanks for creating FoodRico account.
                <br /> To continue, please confirm your email by clicking the button below:
            </p>

            <div style="text-align: center;">
                <a href="#" class="btnActivate">Activate My E-Mail</a>
            </div>

            <p>
                Thanks,
                <br />
                <strong>FoodRico Team</strong>
            </p>

            <hr />

            <a href="#">
                <img src="https://ninjavan.herokuapp.com/img/icon/facebook.png" alt="FoodRico Facebook">
            </a>
            <a href="#">
                <img src="https://ninjavan.herokuapp.com/img/icon/whatsapp.png" alt="FoodRico WhatsApp">
            </a>
        </div>

        <small>
            &copy; FoodRico {{ Carbon\Carbon::now()->format('Y') }}
            <br /> Address
        </small>
    </div>
</body>