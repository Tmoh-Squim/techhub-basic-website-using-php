<?php
include 'db_config.php';

// Create the team_members table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL
)");

// Predefined team members data
$team_members = [
    ['Timothy Kibunja', 'CEO & Founder', 'team1.jpg'],
    ['John Kamau', 'Lead Developer', 'team2.jpg'],
    ['Lizz Kariuki', 'Marketing Head', 'team3.jpg']
];

// Insert default team members if they don't exist
$stmt = $conn->prepare("INSERT INTO team_members (name, role, image_url) SELECT ?, ?, ? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM team_members WHERE name = ?)");

foreach ($team_members as $member) {
    $stmt->bind_param("ssss", $member[0], $member[1], $member[2], $member[0]);
    $stmt->execute();
}

$stmt->close();

function fetchTeam() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM team_members");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<div class='team-member'>
                <img src='assets/images/{$row['image_url']}' alt='{$row['name']}'>
                <h3>{$row['name']}</h3>
                <p>{$row['role']}</p>
              </div>";
    }

    $stmt->close();
}
?>

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
    .about-hero {
        background: url('https://wallpaperaccess.com/full/1567666.png') no-repeat center center/cover;
        height: 70vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .about-hero h1 {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .about-hero p {
        font-size: 20px;
        max-width: 700px;
    }

    /* About Section */
    .about-content {
        padding: 50px 20px;
        background: white;
        max-width: 900px;
        margin: 30px auto;
        text-align: left;
        line-height: 1.6;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 40px;
    }

    .about-content h2 {
        color: #ff6b6b;
        margin-bottom: 20px;
    }

    /* Team Section */
    .team {
        padding: 50px 20px;
        background: #f9f9f9;
    }

    .team h2 {
        font-size: 36px;
        margin-bottom: 30px;
    }

    .team-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .team-member {
        background: white;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 250px;
        text-align: center;
    }

    .team-member img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .team-member h3 {
        margin-bottom: 5px;
        color: #ff6b6b;
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <h1>About Us</h1>
    <p>We are passionate about technology, innovation, and building the future with cutting-edge solutions.</p>
</section>

<!-- About Content -->
<section class="about-content">
    <h2>Our Mission</h2>
    <p>At Tech Hub, our mission is to revolutionize the way people interact with technology. We strive to create innovative solutions that empower businesses and individuals in the digital world.</p>

    <h2>Our Vision</h2>
    <p>We envision a future where technology seamlessly integrates into everyday life, making work and play more efficient and enjoyable.</p>
</section>

<!-- Team Section -->
<section class="team">
    <h2>Meet Our Team</h2>
    <div class="team-container">
        <?php fetchTeam(); ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
