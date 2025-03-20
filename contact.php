<?php include 'includes/header.php'; ?>

<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        color: #333;
        text-align: center;
    }

    /* Hero Section */
    .contact-hero {
        background: url('https://images.tmcnet.com/tmc/misc/articles/image/2018-nov/bigstock--contact-center-support-supersize.jpg') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        object-fit:"cover"
        justify-content: center;
        color: white;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .contact-hero h1 {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .contact-hero p {
        font-size: 20px;
        max-width: 700px;
    }

    /* Contact Form Section */
    .contact-container {
        background: white;
        padding: 40px;
        max-width: 600px;
        margin: 30px auto;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .contact-container h2 {
        color: #ff6b6b;
        margin-bottom: 20px;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .contact-form textarea {
        height: 120px;
        resize: none;
    }

    .contact-form button {
        background: #ff6b6b;
        color: white;
        padding: 12px 20px;
        font-size: 18px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }

    .contact-form button:hover {
        background: #ff4040;
    }

    /* Google Map */
    .map-container {
        margin: 30px auto;
        max-width: 100%;
    }

    iframe {
        width: 100%;
        height: 500px;
        border: none;
        border-radius: 10px;
    }
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you! Get in touch with us today.</p>
</section>

<!-- Contact Form Section -->
<div class="contact-container">
    <h2>Get in Touch</h2>
    <form class="contact-form" action="process_form.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send</button>
    </form>
</div>

<!-- Google Map (Optional) -->
<div class="map-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13049.37914982321!2d37.31622208055907!3d-0.572566990749242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182629b5a37f6381%3A0x859cebe37dc37639!2sKirinyaga%20University!5e1!3m2!1sen!2sus!4v1742471947308!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php include 'includes/footer.php'; ?>
