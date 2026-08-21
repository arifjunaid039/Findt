// ==========================================
//        FINDIT CHATBOT
// ==========================================

// Elements
const chatbot = document.getElementById("chatbot");
const chatbotToggle = document.getElementById("chatbot-toggle");
const closeChat = document.getElementById("close-chat");
const sendBtn = document.getElementById("send-btn");
const userInput = document.getElementById("user-input");
const chatBody = document.getElementById("chat-body");
const quickButtons = document.querySelectorAll(".quick-btn");

// ===============================
// Open Chat
// ===============================

chatbotToggle.addEventListener("click", () => {
    chatbot.style.display = "flex";
    chatbotToggle.style.display = "none";
});

// ===============================
// Close Chat
// ===============================

closeChat.addEventListener("click", () => {
    chatbot.style.display = "none";
    chatbotToggle.style.display = "flex";
});

// ===============================
// Add User Message
// ===============================

function addUserMessage(text){

    chatBody.innerHTML += `
        <div class="user-msg">
            <div class="msg">${text}</div>
        </div>
    `;

    chatBody.scrollTop = chatBody.scrollHeight;
}

// ===============================
// Add Bot Message
// ===============================

function addBotMessage(text){

    chatBody.innerHTML += `
        <div class="bot-msg">
            <div class="msg">${text}</div>
        </div>
    `;

    chatBody.scrollTop = chatBody.scrollHeight;
}
// ===============================
// Smart Auto Reply
// ===============================

function botReply(message){

    let msg = message.toLowerCase();
    let reply = "";

    if(msg.includes("hi") || msg.includes("hello") || msg.includes("assalam") || msg.includes("salam")){
        reply = "👋 Assalam-o-Alaikum! Welcome to FindIT. Main aapki kis tarah madad kar sakta hoon?";
    }

    else if(msg.includes("lost")){
        reply = "🔍 Lost Item Report karne ke liye 'Report Lost Item' page par jayein, form fill karein aur Submit par click karein.";
    }

    else if(msg.includes("found")){
        reply = "📦 Found Item submit karne ke liye 'Found Items' page par jayein, item details aur image upload karke Submit karein.";
    }

    else if(msg.includes("login")){
        reply = "🔑 Login page par apna Email aur Password enter karke Login button par click karein.";
    }

    else if(msg.includes("register") || msg.includes("signup")){
        reply = "📝 Register page par apni details fill karein aur account create karein.";
    }

    else if(msg.includes("contact")){
        reply = "📞 Contact page par ja kar humein message bhej sakte hain ya email ke through rabta kar sakte hain.";
    }

    else if(msg.includes("faq") || msg.includes("help")){
        reply = "❓ Main Lost Items, Found Items, Login, Register aur Contact ke baare mein madad kar sakta hoon.";
    }

    else if(msg.includes("thanks") || msg.includes("thank you")){
        reply = "😊 You're welcome! Agar aur koi sawal ho to zaroor poochiye.";
    }

    else{
        reply = "🤖 Maaf kijiye, main is sawal ko nahi samajh saka. Aap Lost Item, Found Item, Login, Register ya Contact ke baare mein pooch sakte hain.";
    }

    setTimeout(() => {
        addBotMessage(reply);
    }, 700);
}

// ===============================
// Send Message
// ===============================

function sendMessage(){

    let text = userInput.value.trim();

    if(text === ""){
        return;
    }

    addUserMessage(text);

    userInput.value = "";

    botReply(text);

}

// ===============================
// Send Button
// ===============================

sendBtn.addEventListener("click", sendMessage);

// ===============================
// Enter Key
// ===============================

userInput.addEventListener("keypress", function(e){

    if(e.key === "Enter"){
        sendMessage();
    }

});

// ===============================
// Quick Reply Buttons
// ===============================

quickButtons.forEach(button => {

    button.addEventListener("click", function(){

        let text = this.innerText;

        addUserMessage(text);

        botReply(text);

    });

});