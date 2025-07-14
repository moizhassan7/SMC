<style>
.smc-numbers-section {
    background-color: #8B0000; 
    color: white;
    padding: 80px 0; 
}

.smc-numbers-title {
    font-size: 3.5em; /* Large title */
    font-weight: 900; /* Extra bold */
    text-transform: uppercase;
    color: white;
    margin-bottom: 50px; /* Space below title */
}

.number-item {
    padding: 20px 10px;
}

.number-value {
    font-size: 3.8em; /* Large numbers */
    font-weight: 700;
    color: #AD5207; /* Gold color for numbers */
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.number-value .plus-sign {
    font-size: 0.8em; /* Smaller size for the '+' */
    vertical-align: super; /* Position the plus sign slightly higher */
    margin-left: -5px; /* Adjust spacing for '+' */
}


.number-label {
    font-size: 1.1em; /* Label below number */
    font-weight: 500;
    text-transform: uppercase;
    opacity: 0.9;
    letter-spacing: 0.5px;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .smc-numbers-title {
        font-size: 2.5em;
        margin-bottom: 30px;
    }
    .number-value {
        font-size: 3em;
    }
    .number-label {
        font-size: 0.9em;
    }
}

@media (max-width: 576px) {
    .smc-numbers-section {
        padding: 50px 0;
    }
    .smc-numbers-title {
        font-size: 2em;
    }
    .number-value {
        font-size: 2.5em;
    }
    .number-label {
        font-size: 0.8em;
    }
    .col-6 { /* Ensure columns stack nicely */
        flex: 0 0 50%;
        max-width: 50%;
    }
}
</style>

<div class="smc-numbers-section py-6">
    <div class="container text-center">
        <h2 class="smc-numbers-title mb-5 mx-5">SMC IN NUMBERS</h2>
        <div class="row justify-content-center">
            <div class="col-6 col-md-3 mb-4">
                <div class="number-item">
                    <div class="number-value" data-target="600">0</div>
                    <div class="number-label">ENROLLED STUDENTS</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="number-item">
                    <div class="number-value" data-target="1500">0</div>
                    <div class="number-label">Alumni</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="number-item">
                    <div class="number-value" data-target="150">0<span class="plus-sign">+</span></div>
                    <div class="number-label">Faculty</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="number-item">
                    <div class="number-value" data-target="19">0</div>
                    <div class="number-label">Years of Experience</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const numbersSection = document.querySelector('.smc-numbers-section');
    const numberValues = document.querySelectorAll('.number-value');
    let hasAnimated = false; // Flag to ensure animation runs only once

    function animateNumbers() {
        if (hasAnimated) return; // Don't animate if already done

        const sectionTop = numbersSection.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        // Check if the section is in the viewport (or slightly above/below)
        if (sectionTop < windowHeight && sectionTop > -numbersSection.offsetHeight) {
            numberValues.forEach(valueElement => {
                const target = parseInt(valueElement.dataset.target);
                let current = 0;
                const increment = Math.ceil(target / 100); // Adjust speed based on target number

                // Check for '+' sign and handle it separately
                const hasPlus = valueElement.querySelector('.plus-sign');
                const initialText = valueElement.textContent.replace('+', ''); // Get original text without plus

                const timer = setInterval(() => {
                    current += increment;
                    if (current < target) {
                        valueElement.textContent = current;
                    } else {
                        valueElement.textContent = target;
                        if (hasPlus) {
                            valueElement.textContent += '+'; // Add plus back if it existed
                        }
                        clearInterval(timer);
                    }
                }, 20); // Interval speed
            });
            hasAnimated = true; // Set flag to true after animation starts
            window.removeEventListener('scroll', animateNumbers); // Remove listener after animation
        }
    }

    animateNumbers();

    // Add scroll event listener to trigger animation when section comes into view
    window.addEventListener('scroll', animateNumbers);
});
</script>