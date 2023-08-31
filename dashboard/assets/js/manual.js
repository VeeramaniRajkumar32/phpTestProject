window.addEventListener('load', (event) => {
    const queryString = new URLSearchParams(window.location.search)
    let msg = queryString.get('msg')
    if(msg != null){
        Snackbar.show({
            text: msg,
            pos: 'bottom-right',
            actionText: 'Success',
            actionTextColor: '#8dbf42',
            duration: 5000
        });
    }
    let login = localStorage.getItem('login_id')
    console.log({login});
    if(login == null){
        let thisURl = window.location.href
        console.log(window.location.pathname);
        if(thisURl != 'http://localhost/projects/test/dashboard/signUp.php'){
            if(thisURl.charAt(thisURl.length-1) != '/'){
                location.replace('./')
            }
        }
    } else{
        $.ajax({
            type: "POST",
            url: "ajax/sessionSet.php",
            data:{'login':login},
            success: function(data){
                if(window.location.href.charAt(window.location.href.length-1) == '/'){
                    location.replace('dashboard.php')
                } else{
                    if(data == 'false'){
                        location.reload()
                    }
                }
            }
        });
    }
});
function loginCheck(e){
    e.preventDefault()
    let user = document.getElementById('username').value
    let pass = document.getElementById('password').value
    console.log({user,pass});
    if(user.value == ''){
        user.style.border = '1px solid red'
    } else{
        user.style.border = '1px solid #bfc9d4'
        if(pass.value == ''){
            pass.style.border = '1px solid red'
        } else{
            pass.style.border = '1px solid #bfc9d4'
            $.ajax({
                type: "POST",
                url: "http://localhost/projects/test/api/login.php",
                data:{'userName':user,'password': pass},
                success: function(data){
                    console.log({data});
                    if(data == 'Invalid Username!'){
                        document.getElementById('Message').innerHTML = data
                        user.style.border = '1px solid red'
                        pass.style.border = '1px solid #bfc9d4'
                    } else{
                        if(data.me == 'Incorrect Password!'){
                            document.getElementById('Message').innerHTML = data
                            user.style.border = '1px solid #bfc9d4'
                            pass.style.border = '1px solid red'
                        } else{
                            localStorage.setItem('login_id', data)
                            $.ajax({
                                type: "POST",
                                url: "ajax/sessionSet.php",
                                data:{'login':data},
                                success: function(data){
                                    location.replace('dashboard.php')
                                }
                            });
                        }
                    }
                }
            });
        }
    }
}
function ChangePassword(e){
    e.preventDefault()

    let password = document.getElementById('password')
    let newPassword = document.getElementById('newPassword')
    let retypeNewPassword = document.getElementById('retypeNewPassword')

    if(password.value == ''){
        password.style.border = '1px solid red'
    } else{
        password.style.border = '1px solid #bfc9d4'
        if(newPassword.value == ''){
            newPassword.style.border = '1px solid red'
        } else{
            newPassword.style.border = '1px solid #bfc9d4'
            if(retypeNewPassword.value == ''){
                retypeNewPassword.style.border = '1px solid red'
            } else{
                retypeNewPassword.style.border = '1px solid #bfc9d4'
                if(newPassword.value == retypeNewPassword.value){
                    $.ajax({
                        type: "POST",
                        url: "ajax/changePassword.php",
                        data:{'password':password.value,'newPassword': newPassword.value},
                        success: function(data){
                            if(data == 'Incorrect Old Password!'){
                                document.getElementById('Message').innerHTML = data
                                password.style.border = '1px solid red'
                            } else{
                                location.replace('dashboard.php?msg=Password Changed!')
                            }
                        }
                    });
                } else{
                    document.getElementById('Message').innerHTML = 'Password Mismatch!'
                    newPassword.style.border = '1px solid red'
                    retypeNewPassword.style.border = '1px solid red'
                }
            }
        }
    }
}

function logOut(){
    $.ajax({
        type: "POST",
        url: "ajax/logoutCheck.php",
        data:{'username':1,},
        success: function(data){
            if(data == 'success'){
                localStorage.removeItem('login_id')
                location.replace('./')
            }
        }
    });
}

function categoryStatus(id){
    $.ajax({
        type: "POST",
        url: "ajax/categoryStatus.php",
        data:{'category_id':id},
        success: function(data){
            if(data == 'true'){
                Snackbar.show({
                    text: 'Category status updated',
                    pos: 'bottom-right',
                    actionText: 'Success',
                    actionTextColor: '#A1D433',
                    duration: 5000
                });
                return true
            } else{
                Snackbar.show({
                    text: 'Status updation failed',
                    pos: 'bottom-right',
                    actionText: 'Error',
                    actionTextColor: '#8dbf42',
                    duration: 5000
                });
                if(document.getElementById('S' + id).checked){
                    document.getElementById('S' + id).checked = false
                } else{
                    document.getElementById('S' + id).checked = true
                }
            }
        }
    });
}
