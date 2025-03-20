<style>
  nav {
    background-color: #222;
    padding: 10px 0;
    text-align: center;
  }

  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  nav ul li {
    margin: 0 15px;
  }

  nav ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background 0.3s;
  }

  nav ul li a:hover {
    background-color: #555;
  }

  /* Responsive Navigation */
  @media (max-width: 768px) {
    nav ul {
      flex-direction: column;
      align-items: center;
    }
    nav ul li {
      margin: 10px 0;
    }
  }
</style>

<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="services.php">Services</a></li>
    <li><a href="blog.php">Blogs</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
</nav>
