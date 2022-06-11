# PRACTICE API
## LOGIN AND SIGNUP API FOR PRACTICE PURPOSES 

<br/>

## API EndPoints
```
Login: https://practiceapii.herokuapp.com/login.php
Signup: https://practiceapii.herokuapp.com/signup.php
```

<br/>

## Practice API as a Public API <hr>
Practice API is a login and signup system API that is totally open source and free to use (or call or burn). <br/>
It can be used in your practice frontend application for beginners and can also be used by probably the amazing 
professional reading this right now (just in-case you need to pass time!). <br/>
Practice API is free and does not need any authentication to be used at all!! <br/>
You can literally copy the endpoints, run straight to postman and test it out right now! <br/>

## How It Works <hr>
Practice API just as previously stated is basically targetted at the beginner mases, those looking to find their way 
around frontend developement with the use of APIs. <br/>
You can use Practice API with a frontend application that requires a login and signup system and in your JavaScript code, burn the API and let it handle all validation for you!! 

<br/>

## EXAMPLE! <hr>
For the case of understanding how Practice API works and how to use it, we're going to take a very simple example. <br/>
- First We Create Two Simple HTML Forms For Handling Both The Signup And Login

``` HTML
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice API</title>
    </head>

    <body>
        <!--Login Form-->
        <form class="loginForm">
            <input name="username" id="username" class="Username" placeholder="Enter Your Username" type="text">
            <input name="Userpassword" id="Userpassword" class="UserPassword" placeholder="Enter Your Password" type="password">
            <button type="submit"></button>
        </form>

        <!--Signup Form-->
        <form class="signupForm">
            <input name="fullname" id="fullname" class="Fullname" placeholder="Enter Your Fullname" type="text">
            <input name="username" id="usernameSignup" class="UsernameSignUp" placeholder="Choose Your Username" type="text">
            <input name="Userpassword" id="UserpasswordSignup" class="UserPasswordSignup" placeholder="Choose Your Password" type="password">
            <input name="confirm_password" id="confirm_password" class="Confirm_password" placeholder="Enter Your Password Again" type="password">
            <button type="submit"></button>
        </form>
    </body>
</html>
```

<br/>

Now in our JavaScript where all the API magic is done, we put in the following code for the login form to work:

``` javascript
const loginForm = document.querySelector(".loginForm");
const usernameLogin = document.querySelector(".username");
const UserpasswordLogin = document.querySelector(".Userpassword");

loginForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    let userLoginDetails = {
        "username": usernameLogin.value,
        "password": UserpasswordLogin.value
    }

    fetch("https://practiceapii.herokuapp.com/login.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(userLoginDetails)
    })
    .then(res=>res.json())
    .then((data)=>{
        console.log(data);
    })
    .catch((error)=>{
        console.log(error);
    })
});
```
### POSSIBLE MESSAGES API ENDPOINT WILL RETURNS <hr>
1. ["SUCCESS"] :- This shows that all went well!!
2. ["NO SUCH USER FOUND"] :- This error is only going to occur when the specified user does not exist on the database!
3. ["PASSWORD MISMATCH"] :- This error will only occur when the specified user exists on the database, but the password provided to access the account is not corresponding to what was initially given at signup.
4. ["FATAL ERROR, PLEASE CONTACT THE SERVER SIDE ENGINEER!"] :- When you experience this kind of error, please contact me to fix it up!

<br/>

Now over to the JavaScript for the signup API Endpoint we have:
```javascript
const signupForm = document.querySelector(".signupForm");
const Fullname = document.querySelector(".Fullname");
const Usernamesignup = document.querySelector(".UsernameSignup");
const UserPasswordSignup = document.querySelector(".UserPasswordSignup");
const confirm_password = document.querySelector(".Confirm_password");

signupForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    let userDetails = {
        "fullname": Fullname.value,
        "username": Usernamesignup.value,
        "password": UserPasswordSignup.value,
        "confirm_password": confirm_password.value
    }

    fetch("https://practiceapii.herokuapp.com/signup.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(userDetails)
    })
    .then(res=>res.json())
    .then((data)=>{
        console.log(data);
    })
    .catch((error)=>{
        console.log(error);
    })
})
```

### POSSIBLE MESSAGES API ENDPOINT WILL RETURN:
1. ["THIS USERNAME IS ALREADY IN USE"] :- This occurs when the person trying to signup is about using the same username as someone who has already signed up.
2. ["SUCCESS"] :- This shows that all went well!!
3. ["A PROBLEM HAS OCCURED PLEASE CONTACT SERVER SIDE ENGINEER"] :- When you experience this kind of error, please contact me to fix it up!
4. ["PASSWORDS DO NOT MATCH"] :- This occurs when the password entered in choose password and confirm password fields are not the same!
5. ["FATAL ERROR WHILE CHECKING FOR USERNAME AVAILABILITY, PLEASE CONTACT SERVER SIDE ENGINEER"] :- When you experience this kind of error, please contact me to fix it up!

# PLEASE NOTE:
Do not use your real passwords on this API as it is not encrypted neither is it hashed!