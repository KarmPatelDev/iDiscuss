<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>

    <?php include 'partials/_header.php'; ?>

    <section class="mb-4" style="width: 100%; display:flex; justify-content:center; align-items: center; flex-direction: column;">
    <!--Section heading-->
    <div class="text-bg-danger text-center mb-4 " style="width: 100%;height: 15rem;display:flex;align-items:center;justify-content:center;flex-direction: column;">
      <h1 class="card-title my-3" style="width:80%">About Us</h1>
      <p class="card-text" style="width:70%">iDiscuss is a place to seek help and ask questions relating to coding and programming languages.</p>
    </div>

    <h2>Our Core Values</h2>
    </section>

    <section class="px-5" style="width: 100%; display:flex; flex-direction: column;">

      <h3 class="text-primary mt-2">Adopt a customer-first mindset</h3>
      <p>Authentically serve our customers by empowering, listening, and collaborating with our fellow Stackers.</p>

      <h3 class="text-primary mt-2">Be flexible and inclusive</h3>
      <p>We do our best work when a diverse group of people collaborate in an environment of respect and trust. Create space for different voices to be heard, and allow flexibility in how people work.</p>

      <h3 class="text-primary mt-2">Be transparent</h3>
      <p>Communicate openly and honestly, both inside and outside the company. Encourage transparency from others by being empathetic, reliable, and acting with integrity.</p>

      <h3 class="text-primary mt-2">Empower people to deliver outstanding results</h3>
      <p>Give people space to get their job done, support them when they need it, and practice blameless accountability.</p>

      <h3 class="text-primary mt-2">Keep community at our center</h3>
      <p>Community is at the heart of everything we do. Nurture healthy communities where everyone is encouraged to learn and give back.</p>

      <h3 class="text-primary mt-2">Learn, share, grow</h3>
      <p>Adopt a Growth Mindset. Be curious and eager to learn. Aim for ethical, sustainable, long-term growth, both personally and in the company.</p>

    </section>

    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
  </body>
</html>