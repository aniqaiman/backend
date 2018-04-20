<body>
	<div style="margin: 0 auto; background-color: #343a40; padding: 25px; text-align: center; color: white; max-width: 670px;">
		<img src="https://ninjavan.herokuapp.com/img/logo/logo-text.png" alt="Food Rico Logo" style="width: 190px; margin-top: 5px; margin-bottom: 15px;">

		<div style="background-color: white; border-radius: 3px; padding: 30px 30px 20px; text-align: left; color: black; margin-bottom: 5px;">
			<h1 style="margin-top: 0; text-align: center;">
				FoodRico {{ $user->group->name }}
				<br />
				<sup>Welcome Onboard!</sup>
			</h1>

			<h4>Hi {{ $user->name }},</h4>

			<p>
				Thanks for creating FoodRico account.
				<br /> To continue, please confirm your email by clicking the button below:
			</p>

			<div style="text-align: center;">
				<a href="#" style="background-color: #77b55a; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid #4b8f29; display: inline-block; cursor: pointer; color: #fff; font-size: 1em; padding: 10px 15px; text-decoration: none;">
					Activate My E-Mail
				</a>
			</div>

			<p>
				Thanks,
				<br />
				<strong>FoodRico Team</strong>
			</p>

			<hr />

			<a href="#" style="text-decoration: none;">
				<img src="https://ninjavan.herokuapp.com/img/icon/facebook.png" alt="FoodRico Facebook">
			</a>
			<a href="#" style="text-decoration: none;">
				<img src="https://ninjavan.herokuapp.com/img/icon/whatsapp.png" alt="FoodRico WhatsApp">
			</a>
		</div>

		<small>
			&copy; FoodRico {{ Carbon\Carbon::now()->format('Y') }}
			<br /> Address
		</small>
	</div>
</body>