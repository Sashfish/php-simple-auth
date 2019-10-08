function revealPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {x.type = "text";}
  else {x.type = "password";}
}

function checkPasswordInputAndEmailFormat() { //inspired by  https://www.w3schools.com/jsref/prop_text_value.asp
  var pass=document.getElementById('pass').value;
  var passSpecCharsCheck = pass.search(/[\'^£$%&*()}{@#~!?><>,|=_+¬-]/g);
  var passNumbersCheck = pass.search(/[0-9]/g);
  var passUppercaseCheck = pass.search(/[A-Z]/g);
  submitOK = "TRUE";

  if (pass.length<8) {
      document.getElementById("pwlengtherror").style.display = "block";
      submitOK = "FALSE";}
       else {
    document.getElementById("pwlengtherror").style.display = "none";
    submitOK="TRUE";}

  if (passSpecCharsCheck==-1) {
    document.getElementById("pwspeccharserror").style.display = "block";
    submitOK = "FALSE";}
     else {
    document.getElementById("pwspeccharserror").style.display = "none";
    submitOK="TRUE";}

  if (passNumbersCheck==-1) {
    document.getElementById("pwnumberserror").style.display = "block";
    submitOK = "FALSE";}
     else {
    document.getElementById("pwnumberserror").style.display = "none";
    submitOK="TRUE";}

  if (passUppercaseCheck==-1) {
    document.getElementById("pwuppercaseerror").style.display = "block";
    submitOK = "FALSE";}
     else {
    document.getElementById("pwuppercaseerror").style.display = "none";
    submitOK="TRUE";}

var email=document.getElementById('email').value;
var emailFormatCheck = email.search(/.+@.+\.\w{2,}/g);
submitOK2='TRUE';
if (emailFormatCheck==-1) {
  document.getElementById("emailformaterror").style.display = "block";
  submitOK2="FALSE";}
   else {
  document.getElementById("emailformaterror").style.diplay = "none";
  submitOK2="TRUE";}

if (submitOK2=="FALSE" || submitOK=="FALSE") {return false;}
}

//Capslock detection script for password input
var input = document.getElementById('password');
var text = document.getElementById('capslockwarning');
input.addEventListener("keyup", function (event) {
	if (event.getModifierState("CapsLock")) {
	text.style.display = "block";}
	else {text.style.display="none";}
});

//Show what's required for a password input when the field is clicked, hide when focus lost
function passwordConditionReminder() {
  if (document.getElementById("passreminder").style.display = "none") {
  document.getElementById('passreminder').style.display = "block";}
}
function passwordConditionReminderHide() {
  if (document.getElementById("passreminder").style.display = "block") {
  document.getElementById('passreminder').style.display = "none";}
}


//Collapsible on the index page       https://www.w3schools.com/howto/howto_js_collapsible.asp
/*var coll = document.getElementById("collapsible");
var i;

for (i=0; i < coll.length; i++) {
  coll[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
*/
