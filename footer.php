<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css ">

<style>
    footer {
        background: linear-gradient(120deg, rgba(34, 34, 34, 0.95) 60%, rgba(139, 0, 0, 0.85)), url("./images/smcbuliding.png") center/cover no-repeat fixed;
        color: #f5f5f5;
        padding: 48px 0 0;
        font-family: 'Poppins', Arial, sans-serif;
        text-align: left;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
        position: relative;
        font-size: 18px;
        line-height: 1.7;
        width: 100%;
        margin-top: 48px;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 32px;
        position: relative;
        z-index: 1;
    }

    .footer-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 40px 32px;
        border-bottom: 1.5px solid #222c;
        padding-bottom: 32px;
        margin-bottom: 24px;
    }

    .footer-col {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .footer-col:not(:last-child) {
        border-right: 1px solid #23232355;
        padding-right: 24px;
    }

    @media (max-width: 900px) {
        .footer-row {
            grid-template-columns: 1fr;
            gap: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .footer-col {
            border-right: none;
            border-bottom: 1px solid #23232355;
        }
    }

    .footer-logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: #FFD700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .footer-desc {
        color: #e0e0e0;
        font-size: 0.95rem;
    }

    .footer-title {
        font-size: 1rem;
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }
    .footer-links li{
    margin: 0 0 10px;
}
    .footer-links a {
        font-family: 'Poppins', Arial, sans-serif;
        color: #f5f5f5;
        text-decoration: none;
        transition: color 0.2s ease;
        font-size: 1rem;
    }

    .footer-links a:hover {
        color: #FFD700;
    }

    .footer-contact p {
        margin-bottom: 8px;
        color: #e0e0e0;
        font-size: 0.95rem;
    }

    .footer-form input,
    .footer-form textarea {
        width: 100%;
        background: #23232397;
        color: #fff;
        border: 1px solid #444;
        border-radius: 6px;
        padding: 10px 12px;
        margin-bottom: 12px;
        font-size: 1rem;
        transition: border-color 0.2s ease;
    }

    .footer-form input:focus,
    .footer-form textarea:focus {
        border-color: #FFD700;
        outline: none;
    }

    .footer-form button {
        width: 100%;
        background: linear-gradient(90deg, #8B0000 60%, #FFD700 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 0;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .footer-form button:hover {
        background: linear-gradient(90deg, #8B0000 40%, #FFD700 100%);
    }

    .form-message {
        display: none;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .footer-bottom {
        width: 100%;
        padding: 18px 0 12px;
        text-align: center;
        color: #bdbdbd;
        font-size: 0.95rem;
    }

    .social-icons a {
        color: #FFD700;
        margin-right: 12px;
        font-size: 1.1rem;
        transition: color 0.2s ease;
    }

    .social-icons a:hover {
        color: #fff;
    }
    .copyright a {
        color: #FFD700;
        text-decoration: none;
        transition: color 0.2s ease;
    }
</style>

    <footer role="contentinfo">
        <div class="footer-content">
            <div class="footer-row">
                <!-- Vision & Mission -->
                <div class="footer-col">
                    <div class="footer-logo">
                        <i class="fas fa-eye"></i> Our Vision & Mission
                    </div>
                    <p class="footer-desc">
                        To transform healthcare through excellence in education, research, and clinical practice. We're dedicated to training compassionate professionals who will lead innovation in medical science and community health.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div class="footer-col">
                    <div class="footer-title">Quick Links</div>
                    <ul class="footer-links">
                        <li><a href="./index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="./aboutus.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="admisions.php"><i class="fas fa-chevron-right"></i> Admissions</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Campus Life</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="footer-col">
                    <div class="footer-title">Contact Information</div>
                    <div class="footer-contact">
                        <p><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> (048) 923-2004</p>
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> contact@smc.edu.pk</p>
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> Faisalbad Road, Sargodha, Pakistan</p>
                        
                        <div class="social-icons">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Linkedin"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="footer-col">
                    <div class="footer-title">Send a Message</div>
                    <div class="form-message" id="formMessage"></div>
                    <form class="footer-form" id="footerForm" method="post" action="#">
                        <input type="text" name="name" placeholder="Your Name" aria-label="Full Name" required>
                        <input type="email" name="email" placeholder="Your Email" aria-label="Email Address" required>
                        <textarea name="message" rows="3" placeholder="Your Message" aria-label="Message" required></textarea>
                        <button type="submit"><i class="fas fa-paper-plane"></i> Send Message</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    © <span id="currentYear"></span> Sargodha Medical College. Developed by <a href="https://hassanmoizportfolio.netlify.app/" target="_blank"> Moiz Hassan</a>.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
        
        // Form validation and success message
        document.getElementById('footerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.querySelector('[name="name"]').value.trim();
            const email = document.querySelector('[name="email"]').value.trim();
            const message = document.querySelector('[name="message"]').value.trim();
            const messageBox = document.getElementById('formMessage');
            
            // Clear previous messages
            messageBox.textContent = '';
            messageBox.style.display = 'none';
            messageBox.classList.remove('animate-fade');
            
            if (!name || !email || !message) {
                messageBox.style.display = 'block';
                messageBox.style.background = 'rgba(255, 107, 107, 0.15)';
                messageBox.style.color = '#ff6b6b';
                messageBox.textContent = 'Please fill out all fields.';
                messageBox.classList.add('animate-fade');
                return;
            }
            
            // Simulate form submission
            setTimeout(() => {
                messageBox.style.display = 'block';
                messageBox.style.background = 'rgba(124, 252, 0, 0.15)';
                messageBox.style.color = '#7CFC00';
                messageBox.textContent = 'Message sent successfully!';
                messageBox.classList.add('animate-fade');
                
                // Reset form
                this.reset();
                
                // Clear message after 5 seconds
                setTimeout(() => {
                    messageBox.classList.remove('animate-fade');
                    setTimeout(() => {
                        messageBox.style.display = 'none';
                    }, 400);
                }, 5000);
            }, 800);
        });
        
        // Add hover effects to all links
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('mouseenter', () => {
                link.style.transition = 'color 0.3s ease';
            });
        });
    </script>

    <!--//model-form-->
    <!-- js -->
    <!--/slider-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/jquery.zoomslider.min.js"></script>
    <!--//slider-->
    <!--search jQuery-->
    <script src="js/classie-search.js"></script>
    <script src="js/demo1-search.js"></script>
    <!--//search jQuery-->

    <script>
        $(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- stats -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.js"></script>
    <script>
        $('.counter').countUp();
    </script>
    <!-- //stats -->

    <!-- //js -->
    <script src="js/bootstrap.js"></script>
    <!--/ start-smoth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
        <!--// end-smoth-scrolling -->
</body>

</html>