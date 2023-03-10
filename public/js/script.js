let title = document.querySelector('h1');
title.addEventListener('click', () => {
    title.style.color = 'darkblue';
});

// Faire disparaitre le message flash
setTimeout(() => {
    document.querySelectorAll('.flash-messages').forEach(el => el.remove());
}, 5000);
