var a;
function pass()
{
if (a==1)
{
document.getElementById('password') .type='password';
document.getElementById('passIcon').src='hidden.png';
a=0;
}
else
{
document.getElementById('password').type='text';
document.getElementById('passIcon' ).src='visible.png';
a=1;
}
}

function showDiv() {
    // Select the div element
    const div = document.getElementById("invalidCreds");
  
    // Hide the div
    div.style.display = "block";
  }

function hideDiv() {
    // Select the div element
    const div = document.getElementById("invalidCreds");
  
    // Hide the div
    div.style.display = "none";
  }