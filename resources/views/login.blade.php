<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css"
  rel="stylesheet"
/>
   <style>
    .gradient-custom-2 {
    background: rgb(49 175 17);
    }

    .color-green {
       color: rgb(49 175 17);
    }

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
.square-container {
    width: 100%;  
    height: 100%;  
    position: relative;
    background-color: #e0e0e0; 
}

.square-content {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    bottom: 0;
}

.square-content::before,
.square-content::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px; 
    background-color: #ccc; 
}

.square-content::before {
    transform: rotate(-45deg);
}

.square-content::after { 
    transform: rotate(45deg);
}
.form-control.border-bot {
    border-bottom: 1px solid black; 
    border-radius: 0; 
}
.b-right::before {
    content: '';
    position: absolute;
    top: 25px;
    bottom: 25px;
    right: 0;
    width: 2px;
    background-color: #9981813d; 
}
   </style>
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6 b-right position-relative" style="background: #e0e0e0">
                    <div class="card-body card-body w-75 ps-5 pe-0 w-75">
      
                      <div class="text-start">
                        <h4 class="mt-1 mb-5 pb-1">Hotel Booking</h4>
                      </div>
      
                      <form>
                        <p class="fw-bold fs-2">Login</p>
                        <div class="d-flex align-items-center justify-content-start pb-4">
                            <p class="mb-0 me-2">Don't have an account?</p>
                            <a type="button" class="color-green">Request account</a>
                          </div>
      
                        <div class="form-outline mb-4">
                          <input type="email" id="email" class="form-control border-bot"/>
                          <label class="form-label" for="email">Email</label>
                        </div>
      
                        <div class="form-outline mb-3">
                          <input type="password" id="password" class="form-control border-bot" />
                          <label class="form-label" for="password">Password</label>
                        </div>

                        <div class="text-end mb-4 pb-1">
                            <a class="color-green" href="#!">Forgot password?</a>
                        </div>
      
                        <div class="text-center pt-1 mb-1 pb-1">
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 fs-5" type="button">Log
                            in</button>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="square-container">
                        <div class="square-content"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>