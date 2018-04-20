<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #wrapper {
        margin: 0 auto;
        background-color: #343a40;
        padding: 25px;
        text-align: center;
        color: white;
        max-width: 670px;
    }

    #wrapper #logo {
        width: 190px;
        margin-top: 5px;
        margin-bottom: 15px;
    }

    #wrapper #inner {
        background-color: white;
        border-radius: 3px;
        padding: 30px 30px 20px;
        text-align: left;
        color: black;
        margin-bottom: 5px;
    }

    #wrapper #inner h1 {
        margin-top: 0;
        text-align: center;
    }

    #wrapper #inner a {
        text-decoration: none;
    }

    #wrapper #inner #btnActivate {
        text-align: center;
    }

    #wrapper #inner #btnActivate a {
        background-color: #77b55a;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: 1px solid #4b8f29;
        display: inline-block;
        cursor: pointer;
        color: #fff;
        font-size: 1em;
        padding: 10px 15px;
        text-decoration: none;
    }
</style>

<body>
    <div id="wrapper">
        <img src="https://ninjavan.herokuapp.com/img/logo/logo-text.png" alt="Food Rico Logo" id="logo">

        <div id="inner">
            <h1>
                The FoodRico {{ $user->group->name }}
                <br />
                <sup>Welcome Onboard!</sup>
            </h1>

            <h4>Hi {{ $user->name }},</h4>

            <p>
                Thanks for creating FoodRico account.
                <br /> To continue, please confirm your email by clicking the button below:
            </p>

            <div id="btnActivate">
                <a href="#">Activate My E-Mail</a>
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