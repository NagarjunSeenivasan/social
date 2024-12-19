
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <title>Cadibel</title>
</head>
<body>
  
  <main class="main flow">
    <h1 class="main__heading">Payment Options</h1>
    <div class="main__cards cards">
      <div class="cards__inner">
        <div class="cards__card card">
          <h2 class="card__heading">Single Payment Method</h2>
          <p class="card__price">₹1200</p>
          <ul role="list" class="card__bullets flow">
            <li>users pay once and gain complete access to the selected content without any additional fees or hidden charges.</li>
            <li> This means a single, upfront payment with no recurring costs.</li>
            <li>offering a simple and transparent way to access learning materials.</li>
          </ul>
          <a href="href="upi://pay?pa=${snagarjun512@okhdfcbank}&am=${1000}&cu=INR" class="card__cta cta">Get Started</a>
        </div>
  
        <div class="cards__card card">
          <h2 class="card__heading">Dual Payment Method </h2>
          <p class="card__price">₹1100</p>
          <ul role="list" class="card__bullets flow">
            <li>users can split the total cost into two payments. The first payment is made upfront, and the second payment is scheduled for a later date.</li>
            <li> there may be a slight increase in the total amount due to an additional fee for breaking the payment into installments, similar to an EMI plan.</li>
          </ul>
          <a href="#pro" class="card__cta cta">Get Started</a>
        </div>
  
        <div class="cards__card card">
          <h2 class="card__heading">Triple Payment Method</h2>
          <p class="card__price">₹1200</p>
          <ul role="list" class="card__bullets flow">
            <li> the triple payment option, users can divide the total cost into three installments.</li>
            <li> The first payment is made upfront, with the remaining two payments scheduled at specified intervals.</li>
            <li> there is typically a small additional charge for opting to pay in installments, similar to an EMI plan.</li>
           
          </ul>
          <a href="#ultimate" class="card__cta cta">Get Started</a>
        </div>
      </div>
  
      <div class="overlay cards__inner"></div>
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="../img/logo.png" alt="" width="70" height="65">
            <small class="d-block mb-3">&copy; 2017–2021</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small ">
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Cool stuff</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Random feature</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Team feature</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Stuff for developers</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Another one</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Resource</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Resource name</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Another resource</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Team</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Locations</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Privacy</a></li>
              <li class="mb-1"><a class="link-secondary text-decoration-none text-white" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <script src="script.js"></script>

</body>
</html>