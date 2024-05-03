<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    
    <div class="wrapper">
        <h1>Login</h1>
        <form action="dashboard.html">
            <input type="email" name="email" required="email" placeholder="Email">
            <input type="password" name="password" required="password" placeholder="Password">
            <div class="recover">
                <a href="">Forgot Password?</a>
            </div>
            <button href="">Login</button>
        </form>
        <div class="member">
            Don't have an account? <a href="#">Register Now</a>
        </div>
    </div>

    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins" sans-serif;
}

body {
    background: #dfe9f5;
}

.wrapper {
    width: 330px;
    padding: 2rem 1rem;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2rem;
    color: #07001f;
    margin-bottom: 1.2rem;
}

form input {
    width: 92%;
    outline: none;
    border: 1px solid #fff;
    padding: 12px 20px;
    margin-bottom: 10px;
    border-radius: 20px;
    background: #e4e4e4;
}

button {
    font-size: 1rem;
    margin-top: 1.8rem;
    padding: 10px 0;
    border-radius: 20px;
    outline: none;
    border: none;
    width: 90%;
    color: #fff;
    cursor: pointer;
    background: rgb(17, 107, 143);
}

button:hover {
    background: rgba(17, 107, 143, 0.877);
}

input:focus {
    border: 1px solid rgb(192, 192, 192);
}

.terms {
    margin-top: 0.2rem;
}

.terms input {
    height: 1em;
    width: 1em;
    vertical-align: middle;
    cursor: pointer;
}

.terms label {
    font-size: 0.7rem;
}

.terms a{
    color: rgb(17, 107, 143);
    text-decoration: none;
}

.member {
    font-size: 0.8rem;
    margin-top: 1.4rem;
    color: #636363;
}

.member a{
    color: rgb(17, 107, 143);
    text-decoration: none;
}

.recover {
    text-align: right;
    font-size: 0.7rem;
    margin: 0.3rem 1.4rem 0 0;
}

.recover a{
    text-decoration: none;
    color: #464647;
}
    </style>

    <script>
    document.getElementById('loginform').addEventListener('submit', function(event){
            event.preventDefault();
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            var datum = {
                email: email,
                password: password,
            }

            fetch("/api/login", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                     Accept: 'application/json',
                     Authorization: 'Bearer' + localStorage.getItem('tokens')
                },
                body:JSON.stringify(datum),
            }).then((res)=> {
                return res.json();
            }).then(data => {
                console.log(data);
                if(data.access_token) {
                    localStorage.setItem('tokens', data.access_token);
                    window.location.href = '/home';
                }else{
                    document.getElementById('message').innerText = data.message;
                    document.getElementById('message').style.color = 'red';
                }
            }).catch(error => {
                console.error("Something went wrong!!", error);
            });
        });
    </script>

</body>
</html>