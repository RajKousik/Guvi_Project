const form = document.querySelector(".right form");
const continueBtn = form.querySelector(".button input");

const email = form.querySelector(".email input");
const name = form.querySelector(".email input");


form.onsubmit = (e) =>
{
    e.preventDefault();           
}

continueBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php",  true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status == 200)
        {
            let data = xhr.response;

            let compare = data.substr(0,7);
            let name = data.substr(7);

            if(compare == "success")
            {
                location.href = "profile.html";
                console.log(data);
                localStorage.setItem("mailId", email.value);
                localStorage.setItem("name", name);
            }else
            {
                alert(data);
                console.log(data);
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
