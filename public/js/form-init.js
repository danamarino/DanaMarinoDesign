(function () {
    var config = {
        authDomain: "danamarinodesign-c7e1d.firebaseapp.com",
        databaseURL: 'https://danamarinodesign-c7e1d.firebaseio.com/'
    };

    firebase.initializeApp(config);

    var database = firebase.database();
    var emailsRef = database.ref('emails');

    var form = document.getElementById('contact-form');
    var formTemplate = document.getElementById('form-template');
    var successTemplate = document.getElementById('success-template');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(form);

        if (formData.get('noRobots') === '') {
            var email = {
                name: formData.get('first_name'),
                email: formData.get('email'),
                comments: formData.get('comments')
            };

            emailsRef.push(email, function () {
                requestAnimationFrame(function () {
                    formTemplate.classList.add('hide');
                    successTemplate.classList.remove('hide');
                });
            });
        }
    });
}());
