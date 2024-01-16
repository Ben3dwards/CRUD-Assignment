//Wasn't used in the final submitted asignment.
class user {
  constructor(Status, userEmail){
    this.Status = Status;
    this.email=userEmail;
  }
}

function test() {//just testing
  console.log(testList); 
  console.log(testuser);
}

function userSignIn() {// this function collects the username and password from the sign in page.
  var signInEmail = document.getElementById("email_signin").value;
  console.log(signInEmail);
  var SignInPass = document.getElementById("password_signin").value;
  console.log(SignInPass);
  window.location.href = "index.html"//moves back to main page
}

function getSignUp() {//this is for the sign up page
  var passwordFirstInput = document.getElementById('password');
  var passwordSecondInput = document.getElementById("passwordConfirm") 
  var emailInput = document.getElementById('email');//collect elements
  var password1val = passwordFirstInput.value;
  var password2val = passwordSecondInput.value
  var emailValue = emailInput.value;  //gets the value of  attributes
  var errorText = document.getElementById('errorText');
  console.log('Email:', emailValue);
  
  if (password1val != password2val) {
    errorText.style.display = 'block';
  }else if (password1val == password2val){
    //can create user classes here
    window.location.href = "index.html"
  }
}
// unique number
//need place to store data such as email password and sign in details
