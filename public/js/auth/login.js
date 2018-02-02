class login
{
	constructor(apiUrl, isLoggedInUrl)
	{
		this.apiUrl = apiUrl;
		this.isLoggedInUrl = isLoggedInUrl;
		this.csrf = domId('_csrf').value;
	}

	listen()
	{
		var that = this;
		domId('form').addEventListener('submit', function () {
			that.doLogin();
		});
		setInterval(function () {
			that.isLoggedIn();
		}, 3000);
	}

	isLoggedIn()
	{
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try {
						var q = JSON.parse(this.responseText);
						if (q[0] === true) {
							toastr.error("Anda sudah login");
							// alert("You have been logged in!");
							window.location = "/";
						}
					} catch (e) {
						toastr.info(e.message);
						// alert(e.message);
					}
				}
			}
			ch.open("GET", this.isLoggedInUrl);
			ch.send(null);
	}

	doLogin()
	{
		var context = this.buildContext(), that = this;
		if (context !== false) {
			var ch = new XMLHttpRequest();
				domId('email').disabled = 1;
				domId('password').disabled = 1;
				ch.onreadystatechange = function () {
					if (this.readyState === 4) {
						domId('email').disabled = 0;
						domId('password').disabled = 0;
						try {
							var response = JSON.parse(this.responseText);
							if (response['message'] == "Wrong username or password") {
								toastr.error(response['message']);
							}
							// if (response['message'] !== null) {
							if (response['message'] == "Login success!") {
								toastr.success(response['message']);
								// alert(response['message']);
							}
							if (response['redirect'] !== null) {
								window.location = response['redirect'];
							}
						} catch (e) {
							toastr.info(this.responseText);
							// alert(this.responseText);
						}
					}
				};
				ch.withCredentials = true;
				ch.open("POST", this.apiUrl);
				ch.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ch.send(context);
		}
	}

	buildContext()
	{
		return "request=" + encodeURIComponent(JSON.stringify({
			"username": domId('email').value,
			"password": domId('password').value
		})) + "&_token=" + domId('_csrf').value;
	}
}
