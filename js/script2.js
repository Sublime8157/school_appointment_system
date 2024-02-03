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

        const displaypendingaccounts = document.getElementById('display_pending_appointments');
        const buttonpendingaccounts = document.getElementById('pendingaccounts');

        const changepass = document.getElementById('changepass');
        const changepassbtn = document.getElementById('changepassbtn');

        const displaydashboard  = document.getElementById('display-dashboard');
        const buttondashboard = document.getElementById('dashboard');

        const viewaccounts = document.getElementById('display-accounts');
        const viewaccountbutton = document.getElementById('viewaccounts')

        const appointments = document.getElementById('display-schedules');
        const appointmentsbutton = document.getElementById('viewschedules');


        changepassbtn.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            displaypendingaccounts.style.display = 'none';
            changepass.style.display = 'block';

            changepassbtn.classList.add('bg');
            buttonpendingaccounts.classList.remove('bg');
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });

        buttondashboard.addEventListener("click", function(){
            displaydashboard.style.display = 'block';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            displaypendingaccounts.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            buttonpendingaccounts.classList.remove('bg');
            buttondashboard.classList.add('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });

      



        viewaccountbutton.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'block';
            appointments.style.display = 'none';
            displaypendingaccounts.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            buttonpendingaccounts.classList.remove('bg');
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.add('bg');
            appointmentsbutton.classList.remove('bg');
        });

        appointmentsbutton.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'block';
            displaypendingaccounts.style.display = 'none';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            buttonpendingaccounts.classList.remove('bg');
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.add('bg');
        });

        buttonpendingaccounts.addEventListener("click", function(){
            displaydashboard.style.display = 'none';  
            viewaccounts.style.display  = 'none';
            appointments.style.display = 'none';
            changepass.style.display = 'none';
            displaypendingaccounts.style.display = 'block';
            changepass.style.display = 'none';

            changepassbtn.classList.remove('bg');
            buttonpendingaccounts.classList.add('bg');
            buttondashboard.classList.remove('bg');
            viewaccountbutton.classList.remove('bg');
            appointmentsbutton.classList.remove('bg');
        });