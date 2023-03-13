const form = document.querySelector(".myLeftCtn form");
const continueBtn = form.querySelector(".button input");
const print = document.querySelector(".myRightCtn .box header");

const name = localStorage.getItem("name");
const email = localStorage.getItem("mailId");
const hiddenInput = form.querySelector(".hidden input");

var dots = document.getElementById("dots");
var moreText = document.getElementById("more");
var learnmore = document.getElementById("learnmore");
var info = document.getElementById("basicinfo");

if(localStorage.getItem('mailId') === null)
{
    location.href = "login.html";
}
else{
    hiddenInput.value = email;
    // console.log(hiddenInput.value);
}


function logout()
{
    localStorage.clear();
    location.href = "index.html";
}

function preventBack() { 
    window.history.forward(); 
}  
setTimeout("preventBack()", 0); 
window.onunload = function () 
{ 
    null 
};

learnmore.onclick = () =>
{
    if (dots.style.display === "none") {
        dots.style.display = "inline";
        learnmore.value = "Read more";
        moreText.style.display = "none";
        info.style.display="inline";
    } else {
        dots.style.display = "none";
        learnmore.value = "Read less";
        moreText.style.display = "inline";
        info.style.display="none";
    }
}

if(name != null)
{
    print.innerHTML = "Hello " + name;
}
else if(email != null)
{
    const emailname = email.split('@')[0];
    print.innerHTML = "Hello " + emailname;
}
else{
    print.innerHTML = "Hello " + "User";
}

form.onsubmit = (e) =>
{ 
    e.preventDefault();           
}   

continueBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/profile.php",  true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status == 200){
            let data = xhr.response;
            if(data == "success")
            {
                console.log(data + email);
                alert("Information Successfully Updated!");
            }else{
                alert(data);
                console.log(data);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


