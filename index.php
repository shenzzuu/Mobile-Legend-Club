<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mobile Legends Club</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

<header class="navbar">
  <div class="nav-left">
    <div class="logo">
      <img src="pictures/logo.png" alt="MLBB Logo">
    </div>
    <nav class="nav-links">
      <a href="index.php">Home</a>
      <a href="#">About</a>
      <a href="#">Members</a>
      <a href="#">E-Sport</a>
      <a href="#">Subscription</a>
      <a href="#">Merchandises</a>
    </nav>
  </div>
  <div class="nav-right">
  <input type="text" placeholder="Search..." />
  <?php if (isset($_SESSION['username']) && isset($_SESSION['role'])): ?>
  <div class="dropdown">
    <button class="login-btn dropdown-toggle">
      <?= htmlspecialchars($_SESSION['username'])?>
    </button>
    <div class="dropdown-menu">
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
<?php else: ?>
  <a href="login.php"><button class="login-btn">Login</button></a>
<?php endif; ?>
</div>
</header>

<section class="hero">
  <video autoplay muted loop playsinline class="hero-bg-video">
    <source src="videos/intro.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>
  <div class="hero-overlay">
    <p class="tagline">The ultimate MOBA experience</p>
    <h1>MOBILE LEGENDS CLUB</h1>
    <a href="login.php">
    <button class="join-btn">JOIN NOW</button>
    </a>
  </div>
</section>

<section class="latest">
  <h2>THE LATEST</h2>
  <div class="latest-grid">
    <div class="card">
      <img src="pictures/pic1.jpg" alt="Latest News 1">
      <h3>ONIC Crowned MPL ID Season 15 Champions</h3>
      <p>ONIC defeated longtime rivals RRQ Hoshi (RRQ) to secure the championship title at the Mobile Legends: Bang Bang
        Professional League (MPL) Indonesia Season 15 Grand Finals.</p>
    </div>

    <div class="card">
      <img src="pictures/pic2.png" alt="Latest News 2">
      <h3>Mobile Legends: Bang Bang Women's Invitational trailblazes women's esports</h3>
      <p>The Mobile Legends: Bang Bang (MLBB) Women's Invitational (MWI) is set to return at the 2025 Esports World Cup (EWC) as
      the largest women's tournament at the world's biggest multi-title esports event!</p>
    </div>

    <div class="card">
      <img src="pictures/pic3.jpg" alt="Featured Content">
      <h3>The Myth Reforged—The Phoenix Empress, Wu Zetian, Arrives to Mobile Legends: Bang Bang</h3>
      <p>Mobile Legends: Bang Bang (MLBB) unveils its newest hero: Wu Zetian, the reborn phoenix empress whose legend spans
      millennia. Launching on 18 June, Zetian brings a unique blend of high-impact spellcasting and utility to the Land of
      Dawn.</p>
    </div>
  </div>
</section>

<section class="season-countdown">
    <div class="season-container">
        <div class="season-image">
            <img src="pictures/season.png" alt="Season Image">
        </div>
        <div class="season-content">
            <h2>SEASON ENDS IN</h2>
            <div class="countdown-timer">
                <div><span id="days">90</span><small>Days</small></div>
                <div><span id="hours">00</span><small>Hours</small></div>
                <div><span id="minutes">00</span><small>Minutes</small></div>
                <div><span id="seconds">00</span><small>Seconds</small></div>
            </div>
        </div>
    </div>
</section>

<section class="tournaments">
  <div class="tournaments-container">

    <div class="tournaments-text">
      <h1>MLBB GAMEPLAY</h1>
      <h3>COMPETE AND CONQUER</h3>
      <p>
        Mobile Legends: Bang Bang is a multiplayer online battle arena (MOBA) game designed for mobile phones. The game is
        free-to-play and is only monetized through in-game purchases like characters and skins. Each player can control a
        selectable character, called a Hero, with unique abilities and traits.
      </p>
      <a href="https://play.google.com/store/apps/details?id=com.mobile.legends&referrer=adjust_reftag%3DcWLj61nZ0jSZl%26utm_source%3DReLandingButton"
        target="_blank">
        <button class="tournaments-button">SEE TOURNAMENTS</button>
      </a>      
    </div>

    <div class="tournaments-video">
      <video autoplay muted loop playsinline>
        <source src="videos/gameplay.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

  </div>
</section>

<section class="heroes">
  <h2>TOP PICK HEROES</h2>
  <div class="heroes-grid">
    <div class="hero-card"><img src="pictures/ling.jpg" alt="Hero 1"><p>Ling</p></div>
    <div class="hero-card"><img src="pictures/fanny.jpg" alt="Hero 2"><p>Fanny</p></div>
    <div class="hero-card"><img src="pictures/lukas.jpg" alt="Hero 3"><p>Lukas</p></div>
  </div>
</section>

<footer>
    <h3>MLBB</h3>
    <p>FOOTER + COPYRIGHT @ 2025</p>
    <p><a href="policy.html" style="color: #ff4655; text-decoration: none;">Website Policy</a></p>
</footer>

<script>
  const countdown = () => {
    const endDate = new Date("2025-09-01T00:00:00");
    const now = new Date();
    const diff = endDate - now;

    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
    const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
    const m = Math.floor((diff / (1000 * 60)) % 60);
    const s = Math.floor((diff / 1000) % 60);

    document.getElementById("days").textContent = d;
    document.getElementById("hours").textContent = h.toString().padStart(2, "0");
    document.getElementById("minutes").textContent = m.toString().padStart(2, "0");
    document.getElementById("seconds").textContent = s.toString().padStart(2, "0");
  };

  setInterval(countdown, 1000);
</script>

</body>
</html>