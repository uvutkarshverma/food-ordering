
if (document.getElementById("message-close")) {
    document.getElementById("message-close").addEventListener("click",function(){
    let value = document.querySelectorAll("#message");
    for (let i = 0; i < value.length; i++) {
        const element = value[i];
        element.classList.add("hide");
    }
    
})
}


document.getElementById("burger").addEventListener("click",function(){
    
    document.getElementById("right-bin").classList.toggle("hide");

    document.getElementById("nav-bin").classList.toggle("h-nav");
})




if (document.querySelector(".del_item")) {
    document.querySelectorAll(".del_item").forEach(btn1=>btn1.addEventListener("click", function(){
        confirm("Are You Sure Want to Delete?")
        
    }))
}
if (document.querySelector(".cancel-order")) {
    document.querySelectorAll(".cancel-order").forEach(btn1=>btn1.addEventListener("click", function(){
        
        if (confirm("Are You Sure to cancel order?")) {
            
        }
        else{
            return none;
        }
    }))
}

if (document.querySelector(".checkout-btn")) {
    document.querySelector(".checkout-btn").addEventListener("click", function(){
        
        if (confirm("Are You Sure to Confirm Your Order?")) {
            window.location.href = 'confirm.php';
        }
        else{
            return false;
        }
    })
}
