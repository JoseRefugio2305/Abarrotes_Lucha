$(()=>{
    document.getElementById("login-form").addEventListener('submit',(e)=>{
        e.preventDefault()
        let data = document.getElementById("login-form")
        data = new FormData(data)
        
        const params = {
            body: data,
            method: "POST"
        }
        fetch('php/login.php',params)
            .then(response => response.json())
            .then( data => {
                console.log(data.message)
                if (data.response == "Ok") {
                    Swal.fire(
                        'Exito',
                        data.message,
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = data.url
                    },2000)
                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
        })
    })

    
})