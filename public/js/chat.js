function showChatScreen() {
    if (window.innerWidth <= 768) {

        document.querySelector('#chat-list').classList.add("d-none");

        document.querySelector('#chat-messages').classList.add("d-block");
    }
}





function handleResponsive() {
    const chatList = document.querySelector('.chat-list');
    const chatMessages = document.querySelector('.chat-messages');

    if (window.innerWidth <= 768) {
        chatList.style.display = 'block';
        chatMessages.style.display = 'none';
    } else {
        if (chatList && chatMessages) {
            chatList.style.display = 'none';
            chatMessages.style.display = 'block';
        } else {
            console.error('chatList or chatMessages is missing from the DOM.');
        }
    }
}

// Event Listeners
window.addEventListener('load', handleResponsive);
