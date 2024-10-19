// Display the construction notice after a delay
window.addEventListener('load', () => {
    setTimeout(() => {
        const notice = document.getElementById('construction-notice');
        notice.style.display = 'block';
    }, 3000); // 3 seconds delay before showing the notice
});
