<?php
require "header.php";
?>

	<main class="main-contact">
		<section class="contact-section">
			<div class="contact-banner">
				<div class="contact-box" >
					<h2>Contact Us</h2>
					<p class="contact-paragraph">If you are lost, try to contact us. Please let us know your thoughts! We will try to respond you as soon as possible.</p>
				</div>
			</div>
			<form class="contact-form" action="includes/contactform.inc.php" method="POST">
				<h1>Sent us your message</h1>
				<?php
					if (@$_GET['error'] == "emptyfields") {
						echo '<p class="error">Fill in all fields!</p>';
						$name = $_GET['fullname'];
						$mailFrom = $_GET['mail'];
						$subject = $_GET['subject'];
						$message = $_GET['message'];
					}
					elseif (@$_GET['error'] == "invalidmail") {
						echo '<p class="error">You entered an invalid e-mail!</p>';
						$name = $_GET['fullname'];
						$subject = $_GET['subject'];
						$message = $_GET['message'];
					}
					elseif (@$_GET['error'] == "invalidchar") {
						echo '<p class="error">You entered invalid characters!</p>';
						$mailFrom = $_GET['mail'];
					}
					elseif (@$_GET['error'] == "invalidname") {
						echo '<p class="error">You entered invalid name!</p>';
						$mailFrom = $_GET['mail'];
						$subject = $_GET['subject'];
						$message = $_GET['message'];
					}
					elseif (@$_GET['error'] == "invalidsubject") {
						echo '<p class="error">You entered invalid subject!</p>';
						$mailFrom = $_GET['mail'];
						$name = $_GET['fullname'];
						$message = $_GET['message'];
					}
					elseif (@$_GET['error'] == "invalidmessage") {
						echo '<p class="error">You entered invalid message!</p>';
						$mailFrom = $_GET['mail'];
						$name = $_GET['fullname'];
						$subject = $_GET['subject'];
					}
					elseif (@$_GET['error'] == "mailnotsent") {
						echo '<p class="error">Your message was not sent. Try again later.</p>';
						$name = $_GET['fullname'];
						$mailFrom = $_GET['mail'];
						$subject = $_GET['subject'];
						$message = $_GET['message'];
					}
					elseif (@$_GET['success'] == "mailsent") {
						echo '<p class="success">Your message was sent successfully!</p>';
					}
				?>
				<label for="fullname">Full name: </label>
				<input type="text" name="fullname" placeholder="Enter your full name" value="<?php echo isset($_GET['fullname']) ? $name : ''; ?>">
				<label for="mail">E-mail: </label>
				<input type="text" name="mail" placeholder="Enter your email" value="<?php echo isset($_GET['mail']) ? $mailFrom : ''; ?>">
				<label for="subject">Subject: </label>
				<input type="text" name="subject" placeholder="Enter a subject" value="<?php echo isset($_GET['subject']) ? $subject : ''; ?>">
				<label for="message">Message: </label>
				<textarea name="message" placeholder="Type your message"><?php echo isset($_GET['message']) ? $message : ''; ?></textarea>
				<button type="submit" name="submit">Send Mail</button>
			</form>
		</section>
	</main>
	
<?php
require "footer.php";
?>