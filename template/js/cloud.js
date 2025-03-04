document.addEventListener('DOMContentLoaded', () => {
    const cloud = document.querySelector('.cloud');

    const randomText = () => {
        const text = ("!@#$%^*()")
        return text[Math.floor(Math.random() * text.length)];
    };

    const rain = () => {
        const e = document.createElement('div');
        e.classList.add('drop');
        cloud.appendChild(e);

        const left = Math.floor(Math.random() * 300)
        const size = Math.random() * 1.5;
        const duration = Math.random() * 1;

        e.innerText = randomText();
        e.style.left = `${left}px`;
        e.style.fontSize = `${0.5 + size}em`;
        e.style.animationDuration = `${1 + duration}s`;

        setTimeout(
            () => cloud.removeChild(e),
            2000,
        );
    };

    setInterval(
        () => rain(),
        20,
    );
});