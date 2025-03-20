<style>
    footer {
    background: white;
    color: #222;
    padding: 40px 20px;
    text-align: center;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: auto;
}

.footer-section {
    width: 250px;
    margin-bottom: 20px;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #ff6b6b;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 5px 0;
}

.footer-section ul li a {
    text-decoration: none;
    color: #222;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #ff6b6b;
}

.social img {
    width: 30px;
    margin: 5px;
    transition: transform 0.3s ease-in-out;
}

.social img:hover {
    transform: scale(1.1);
}

.copyright {
    margin-top: 20px;
    font-size: 14px;
    border-top: 1px solid #444;
    padding-top: 10px;
}

</style>
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>We provide cutting-edge technology solutions, AI innovations, and secure cloud computing.</p>
        </div>

        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: support@techhub.com</p>
            <p>Phone: 254748143442</p>
            <p>Location: Kutus, Kenya, CA</p>
        </div>

        <div class="footer-section social">
            <h3>Follow Us</h3>
            <a href="#"><img src="assets/icons/facebook.svg" alt="Facebook"></a>
            <a href="#"><img src="assets/icons/twitter.svg" alt="Twitter"></a>
            <a href="#"><img src="assets/icons/linkedin.svg" alt="LinkedIn"></a>
            <a href="#"><img src="assets/icons/youtube.svg" alt="YouTube"></a>
        </div>
    </div>
    <p class="copyright">© 2025 Tech Hub Website | All Rights Reserved.</p>
</footer>
</body>
</html>
