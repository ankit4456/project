document.addEventListener('mousemove', (event) => {
    const tile = document.getElementById('tile');
    const { clientX: mouseX, clientY: mouseY } = event;

    const tileRect = tile.getBoundingClientRect();
    const tileX = tileRect.left + tileRect.width / 2;
    const tileY = tileRect.top + tileRect.height / 2;

    const deltaX = (mouseX - tileX) / tileRect.width;
    const deltaY = (mouseY - tileY) / tileRect.height;

    const rotateX = deltaY * 9; // Adjust the values for more/less rotation
    const rotateY = deltaX * -9;
    const scale = 1 + Math.abs(deltaX) * 0.04; // Scale up based on cursor position

    tile.style.transition = 'transform 0.4s ease-out'; // Smooth transition
    tile.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${scale})`;
});
