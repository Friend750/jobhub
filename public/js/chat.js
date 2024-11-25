
function showChatScreen() {
    document.querySelector('.chat-list').classList.add('d-none');
    document.querySelector('.chat-messages').classList.remove('d-none');
}

function showChatList() {
    document.querySelector('.chat-messages').classList.add('d-none');
    document.querySelector('.chat-list').classList.remove('d-none');
}
