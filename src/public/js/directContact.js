let goToContacts = (target) => {
    let subject = target.getAttribute('data-subject');
    let message_space = document.getElementById('message');
    message_space.innerText = subject;
    let modaCloseId = target.getAttribute('data-modalCloseId');
    let modalCloseBtn = document.getElementById(modaCloseId);
    modalCloseBtn.click();
    let element = document.getElementById('contact-link');
    element.click();
}
