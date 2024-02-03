const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm_password");
const showPasswordCheckbox = document.getElementById("show_password");

const inputPassword = [passwordInput, confirmPasswordInput];

showPasswordCheckbox.addEventListener("change", function() {
    if (this.checked) {
        for (let i = 0; i < inputPassword.length; i++) {
            inputPassword[i].type = "text";
        }
    } else {
        for (let i = 0; i < inputPassword.length; i++) {
            inputPassword[i].type = "password";
        }
    }
});

passwordInput.addEventListener("input", function() {
    showPasswordCheckbox.checked = false;
});




    const displayprof  = document.getElementById('display-prof');
    const buttonprof = document.getElementById('prof');

    const displayhome  = document.getElementById('display-home');
    const buttonhome = document.getElementById('home');

    const displaysetappoint  = document.getElementById('display-set-appoint');
    const buttonsetappoint = document.getElementById('set-appoint');

    const displayviewappoint  = document.getElementById('display-view-appoint');
    const buttonviewappoint = document.getElementById('view-appoint');

    const displayschedules  = document.getElementById('display-schedules');
    const buttonschedules = document.getElementById('schedule');

    const displayaccounts = document.getElementById('display-accounts');
    const buttonaccounts = document.getElementById('accounts');


    buttonprof.addEventListener("click", function(){
        displayprof.style.display = 'block';
        displayhome.style.display = 'none';
        displaysetappoint.style.display = 'none';
        displayviewappoint.style.display = 'none';
        displayschedules.style.display = 'none';
        displayaccounts.style.display = 'none';
        
        buttonaccounts.classList.remove('bg');
        buttonhome.classList.remove('bg');
        buttonprof.classList.add('bg');
        buttonsetappoint.classList.remove('bg');
        buttonviewappoint.classList.remove('bg');
        buttonschedules.classList.remove('bg');
       

    })
    
    buttonhome.addEventListener("click", function(){
        displayprof.style.display = 'none';
        displayhome.style.display = 'block';
        displaysetappoint.style.display = 'none';
        displayviewappoint.style.display = 'none';
        displayschedules.style.display = 'none';
        displayaccounts.style.display = 'none';
        
        
        buttonhome.classList.add('bg');
        buttonprof.classList.remove('bg');
        buttonsetappoint.classList.remove('bg');
        buttonviewappoint.classList.remove('bg');
        buttonschedules.classList.remove('bg');
        buttonaccounts.classList.remove('bg');
    })


    buttonsetappoint.addEventListener("click", function(){
        displayprof.style.display = 'none';
        displayhome.style.display = 'none';
        displaysetappoint.style.display = 'block';
        displayviewappoint.style.display = 'none';
        displayschedules.style.display = 'none';
        displayaccounts.style.display = 'none';

        buttonaccounts.classList.remove('bg');
        buttonhome.classList.remove('bg');
        buttonprof.classList.remove('bg');
        buttonsetappoint.classList.add('bg');
        buttonviewappoint.classList.remove('bg');
        buttonschedules.classList.remove('bg');

    })


    buttonviewappoint.addEventListener("click", function(){
        displayprof.style.display = 'none';
        displayhome.style.display = 'none';
        displaysetappoint.style.display = 'none';
        displayviewappoint.style.display = 'block';
        displayschedules.style.display = 'none';
        displayaccounts.style.display = 'none';

        buttonhome.classList.remove('bg');
        buttonprof.classList.remove('bg');
        buttonsetappoint.classList.remove('bg');
        buttonviewappoint.classList.add('bg');
        buttonschedules.classList.remove('bg');
        buttonaccounts.classList.remove('bg');
    })



    buttonschedules.addEventListener("click", function(){
        displayprof.style.display = 'none';
        displayhome.style.display = 'none';
        displaysetappoint.style.display = 'none';
        displayviewappoint.style.display = 'none';
        displayschedules.style.display = 'block';
        displayaccounts.style.display = 'none';


        buttonhome.classList.remove('bg');
        buttonprof.classList.remove('bg');
        buttonsetappoint.classList.remove('bg');
        buttonviewappoint.classList.remove('bg');
        buttonaccounts.classList.remove('bg');
        buttonschedules.classList.add('bg');

    })

    buttonaccounts.addEventListener("click", function(){
        displayprof.style.display = 'none';
        displayhome.style.display = 'none';
        displaysetappoint.style.display = 'none';
        displayviewappoint.style.display = 'none';
        displayschedules.style.display = 'none';
        displayaccounts.style.display = 'block';
        

        buttonhome.classList.remove('bg');
        buttonprof.classList.remove('bg');
        buttonsetappoint.classList.remove('bg');
        buttonviewappoint.classList.remove('bg');
        buttonschedules.classList.remove('bg');
        buttonaccounts.classList.add('bg');
    })

    
 