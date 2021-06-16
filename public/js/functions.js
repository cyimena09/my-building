function animateNotification(message, cssClass) {
    const containerInfo = document.getElementById('js-quick-info');
    // on reset l'element en retirant ses classes
    containerInfo.classList.remove('bg-success');
    containerInfo.classList.remove('bg-error');

    // animation de la notification en bas à droite
    containerInfo.innerText = message;
    containerInfo.classList.add(cssClass);
    containerInfo.style.display = 'block';
    // lorsque la notification apparait
    setTimeout(
        () => {
            containerInfo.style.opacity = '1';
            containerInfo.style.bottom = '0';
        });

    // lorsqu'elle disparait
    setTimeout(
        () => {
            containerInfo.style.opacity = '0';
            containerInfo.style.bottom = '-20px';
        }, 2000);

    // lorsqu'elle disparait (lanimation dure 4 secondes donc le 'display: none' doit attendre au moins ce délai
    setTimeout(
        () => {
            containerInfo.style.display = 'none';
        }, 2600);
}

function errorMessage(message) {
    const cssClass = 'bg-error';
    animateNotification(message, cssClass)
}