<?php
/*
Template name: Page - child contacts
*/
get_header(); ?>

<?php do_action('flatsome_before_page'); ?>

<section class=" contacts-page">

    <div class="row ">
        <div class="col medium-6 small-12">
            <h1>Contact us</h1>
            <h3 class="contacts-subtitle">We are always availble to address your queries!</h3>
        </div>
    </div>

    <div class="row  items-baseline ">
        <div class="col medium-4 small-12">
            <?php
            echo DEBUG_MODE ? do_shortcode('[contact-form-7 id="345"]') : do_shortcode('[contact-form-7 id="351"]'); ?>
        </div>
        <div class="col medium-2 small-12">
        </div>
        <div class="col medium-6 small-12">
            <div class="contacts-social">
                <p><a href="tel:+971 58 980 4355">+971 58 980 4355</a></p>
                <p><a href="mailto:ceo@fusionsmokedxb.com">ceo@fusionsmokedxb.com</a> </p>
                <p>Follow us:</p>
                <ul class="row row-start ">
                    <li class="mr-3">
                        <a href="#">
                            <svg class="contacts-social-icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#0B0C0E"/>
                                <g clip-path="url(#clip0)">
                                    <rect width="21" height="21" transform="translate(9 9)" fill="#0B0C0E"/>
                                    <path d="M19.5 10.8926C22.3035 10.8926 22.636 10.9031 23.7438 10.9539C26.5893 11.0834 27.9184 12.4335 28.0479 15.258C28.0986 16.3649 28.1082 16.6974 28.1082 19.5009C28.1082 22.3053 28.0977 22.6369 28.0479 23.7438C27.9175 26.5656 26.5919 27.9184 23.7438 28.0479C22.636 28.0986 22.3053 28.1091 19.5 28.1091C16.6965 28.1091 16.364 28.0986 15.2571 28.0479C12.4046 27.9175 11.0825 26.5613 10.953 23.7429C10.9023 22.636 10.8917 22.3044 10.8917 19.5C10.8917 16.6965 10.9031 16.3649 10.953 15.2571C11.0834 12.4335 12.409 11.0825 15.2571 10.953C16.3649 10.9031 16.6965 10.8926 19.5 10.8926ZM19.5 9C16.6484 9 16.2914 9.01225 15.1714 9.063C11.3581 9.238 9.23888 11.3537 9.06387 15.1705C9.01225 16.2914 9 16.6484 9 19.5C9 22.3516 9.01225 22.7095 9.063 23.8295C9.238 27.6427 11.3537 29.762 15.1705 29.937C16.2914 29.9877 16.6484 30 19.5 30C22.3516 30 22.7095 29.9877 23.8295 29.937C27.6392 29.762 29.7638 27.6462 29.9361 23.8295C29.9877 22.7095 30 22.3516 30 19.5C30 16.6484 29.9877 16.2914 29.937 15.1714C29.7655 11.3616 27.6471 9.23888 23.8304 9.06387C22.7095 9.01225 22.3516 9 19.5 9V9ZM19.5 14.1082C16.5224 14.1082 14.1082 16.5224 14.1082 19.5C14.1082 22.4776 16.5224 24.8926 19.5 24.8926C22.4776 24.8926 24.8918 22.4785 24.8918 19.5C24.8918 16.5224 22.4776 14.1082 19.5 14.1082ZM19.5 23C17.5671 23 16 21.4338 16 19.5C16 17.5671 17.5671 16 19.5 16C21.4329 16 23 17.5671 23 19.5C23 21.4338 21.4329 23 19.5 23ZM25.1052 12.6356C24.4088 12.6356 23.8444 13.2 23.8444 13.8956C23.8444 14.5912 24.4088 15.1556 25.1052 15.1556C25.8009 15.1556 26.3644 14.5912 26.3644 13.8956C26.3644 13.2 25.8009 12.6356 25.1052 12.6356Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="21" height="21" fill="white" transform="translate(9 9)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li class="mr-3">
                        <a href="#">
                            <svg class="contacts-social-icon"  width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#0B0C0E"/>
                                <path d="M18 16.3333H16V19H18V27H21.3333V19H23.7613L24 16.3333H21.3333V15.222C21.3333 14.5853 21.4613 14.3333 22.0767 14.3333H24V11H21.4613C19.064 11 18 12.0553 18 14.0767V16.3333Z" fill="white"/>
                            </svg>

                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <svg class="contacts-social-icon"  width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#0B0C0E"/>
                                <path d="M16.32 12.6304C16.32 13.5311 15.58 14.2609 14.6667 14.2609C13.7533 14.2609 13.0133 13.5311 13.0133 12.6304C13.0133 11.7304 13.7533 11 14.6667 11C15.58 11 16.32 11.7304 16.32 12.6304ZM16.3333 15.5652H13V26H16.3333V15.5652ZM21.6547 15.5652H18.3427V26H21.6553V20.5224C21.6553 17.4767 25.6747 17.2276 25.6747 20.5224V26H29V19.3928C29 14.2537 23.052 14.4409 21.6547 16.9707V15.5652Z" fill="white"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <img src="/wp-content/themes/fusion-smoke/images/contacts-bg.jpg" class="contacts-bg" alt="">
        </div>
    </div>
</section>
<?php do_action('flatsome_after_page'); ?>

<?php get_footer(); ?>



